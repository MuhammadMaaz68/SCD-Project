<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @php($route = isset($book) ? route('admin.books.update', $book->id) : route('admin.books.store'))
                    <form method="POST" action="{{$route}}">
                     @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Book Title</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" 
                            @error ('title') is-invalid @enderror id="title" placeholder="Enter book title"
                            name="title" value= "@isset($book->title) {{$book->title}} @endisset>">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Author</label>
                            <input type="text" class="form-control bg-secondary text-light border-0" 
                            @error ('author') is-invalid @enderror id="author" placeholder="Enter author name"
                            name="author" value= "@isset($book->title) {{$book->author}} @endisset>">
                            @error('author')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Cover Image</label>
                           <input type="file" class="form-control bg-secondary text-light border-0" 
                            @error ('image') is-invalid @enderror id="image" placeholder="Enter image path"
                            name="image" value= "@isset($book->image) {{$book->image}} @endisset>">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <textarea rows="3" class="form-control bg-secondary text-light border-0" 
                            id ="description" name="description"
                            placeholder="Book description...">@isset($book->description) {{$book->description}} @endisset</textarea>
                        </div>
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-glow"><i class="bi bi-cloud-upload"></i> Add Book</button>
                    </div>
                </form>
                </div>
            </div>
        </div>  
    </div>
</x-app-layout>