@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-4" style="direction: rtl;">منتجات شركات المياه</h2>
        @if (session('success'))
    <div class="alert alert-success text-center" style="direction: rtl;">
        {{ session('success') }}
    </div>
@endif
 <div class="row">
            @forelse($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image" style="height: 200px; object-fit: cover;">
                        @endif
                        <div class="card-body text-center" style="direction: rtl;">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description ?? 'لا يوجد وصف', 50) }}</p>
                            <p class="card-text"><strong>{{ $product->price }} ريال</strong></p>
                            <p class="card-text text-muted">الكمية المتوفرة: {{ $product->quantity }}</p>
                            <form action="{{ route('customer.order', $product->id) }}" method="POST">
                            @csrf    
                            <button type="submit" class="btn btn-success w-100">اطلب الآن</button>
                             </form>           
                             <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary w-100 mb-2">عرض التفاصيل</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted" style="direction: rtl;">لا توجد منتجات متاحة حالياً.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection