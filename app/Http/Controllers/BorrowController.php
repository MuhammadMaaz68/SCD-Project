<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'due_date' => 'nullable|date|after:today',
        ]);

        \App\Models\Borrow::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'borrowed_at' => now(),
            'due_date' => $request->due_date ?? now()->addDays(14),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Borrow request submitted successfully!');
    }

    public function updateStatus(\Illuminate\Http\Request $request, $id)
    {
        $borrow = \App\Models\Borrow::findOrFail($id);
        
        if ($request->status === 'returned') {
            $borrow->update(['status' => 'returned', 'returned_at' => now()]);
            // Logic to increase book quantity could go here
        } else {
            $borrow->update(['status' => $request->status]);
        }

        $message = 'Borrow status updated.';
        if ($request->status === 'approved') {
            $message = 'Borrow request approved successfully.';
        } elseif ($request->status === 'rejected') {
            $message = 'Borrow request rejected.';
        } elseif ($request->status === 'returned') {
            $message = 'Book marked as returned.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function returnBook($id)
    {
        $borrow = \App\Models\Borrow::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        
        if ($borrow->status !== 'approved') {
            return redirect()->back()->with('error', 'You can only return approved books.');
        }

        $borrow->update(['status' => 'returned', 'returned_at' => now()]);
        // Ideally, we'd also increment the book quantity here.

        return redirect()->back()->with('success', 'Book returned successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
