<!DOCTYPE html>
<html>
<head>
    <title>Supplier Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Supplier Dashboard</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>العميل</th>
                    <th>نوع المياه</th>
                    <th>الكمية</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                    <td>{{ $order->user ? $order->user->name : 'غير معروف' }}</td>
                        <td>{{ $order->water_type }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            @if ($order->status == 'pending')
                                <form action="{{ route('supplier.markAsDelivered', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success">تم التسليم</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>