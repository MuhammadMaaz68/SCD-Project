<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items.product')->where('user_id', $request->user()->id)->get();
        return response()->json(['orders' => $orders], 200);
    }

    public function indexWeb(Request $request) {
        $orders = Order::with('items.product')->where('user_id', $request->user()->id)->get();
        return view('orders.index', compact('orders'));
    }

    public function showWeb($id) {
        $order = Order::with('items.product')->where('user_id', request()->user()->id)->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        // Expecting { items: [{product_id: 1, quantity: 2}, ...] }
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $totalPrice = 0;
            $orderItemsData = [];

            foreach ($request->items as $item) {
                $product = Product::lockForUpdate()->find($item['product_id']);
                
                if ($product->stock_quantity < $item['quantity']) {
                    throw new \Exception("Product {$product->name} is out of stock");
                }

                $product->stock_quantity -= $item['quantity'];
                $product->save();

                $price = $product->price * $item['quantity'];
                $totalPrice += $price;

                $orderItemsData[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price, // Snapshot price
                ];
            }

            $order = Order::create([
                'user_id' => $request->user()->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            foreach ($orderItemsData as $data) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $data['product_id'],
                    'quantity' => $data['quantity'],
                    'price' => $data['price'],
                ]);
            }

            DB::commit();

            return response()->json(['order' => $order->load('items.product')], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        $order = Order::with('items.product')->where('user_id', auth()->id())->findOrFail($id);
        return response()->json(['order' => $order], 200);
    }
}
