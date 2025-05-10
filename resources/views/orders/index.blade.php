@extends('layouts.app')

@section('content')
    <h2 class="text-center mb-4">My Orders</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @forelse($orders as $order)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ $order->product ? asset('storage/' . $order->product->image) : 'https://via.placeholder.com/100' }}" class="img-fluid rounded" alt="{{ $order->product ? $order->product->name : 'Product Not Found' }}" style="max-height: 100px; object-fit: cover;">
                    </div>
                    <div class="col-md-9">
                        <h5>{{ $order->product ? $order->product->name : 'Product Not Found' }}</h5>
                        <p class="text-muted">Quantity: {{ $order->quantity }}</p>
                        <p><strong>Total Price:</strong> {{ $order->total_price }} SAR</p>
                        <p><strong>Status:</strong> <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : 'success' }}">{{ $order->status }}</span></p>
                        <p class="text-muted">Ordered on: {{ $order->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center">
            <p class="text-muted">You have no orders yet.</p>
        </div>
    @endforelse
@endsection