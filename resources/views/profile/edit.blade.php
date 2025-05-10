@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')
            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" required>
            </div>
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection