@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">لوحة التحكم</div>

                <div class="card-body">
                    <h4>مرحبًا، {{ Auth::user()->name }}!</h4>
                    <p>أنت مسجل الدخول بنجاح.</p>
                    <a href="{{ route('donations.create') }}" class="btn btn-primary">إضافة تبرع جديد</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection