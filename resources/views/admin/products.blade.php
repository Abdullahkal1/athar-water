@extends('admin.layouts.app')

@section('content')
    <h2>Manage Products</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h5>Add New Product</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price (SAR)</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>All Products</h5>
        </div>
        <div class="card-body">
            @forelse($products as $product)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}" class="img-fluid rounded" alt="{{ $product->name }}" style="max-height: 100px; object-fit: cover;">
                            </div>
                            <div class="col-md-9">
                                <h5>{{ $product->name }}</h5>
                                <p class="text-muted">{{ $product->description }}</p>
                                <p><strong>Price:</strong> {{ $product->price }} SAR</p>
                                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No products yet.</p>
            @endforelse
        </div>
    </div>
@endsection