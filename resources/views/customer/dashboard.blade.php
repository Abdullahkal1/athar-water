<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم العميل</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
        }
        .dashboard {
            margin-top: 20px;
        }
        .card {
            background-color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-top: 0;
            color: #333;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .orders-table th, .orders-table td {
            padding: 10px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }
        .orders-table th {
            background-color: #f2f2f2;
            color: #333;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .btn-danger {
            background-color: #f44336;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- العنوان -->
        <div class="header">
            <h1>لوحة تحكم العميل</h1>
            <p>مرحباً، {{ auth()->user()->name }}!</p>
        </div>

        <!-- الرسائل -->
        @if (session('success'))
            <div class="card" style="background-color: #dff0d8; color: #3c763d;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="card" style="background-color: #f2dede; color: #a94442;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- الـ Dashboard -->
        <div class="dashboard">
            <!-- ملخص الطلبات -->
            <div class="card">
                <h3>طلباتي</h3>
                @if ($orders->isEmpty())
                    <p>لا توجد طلبات حالياً.</p>
                @else
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>رقم الطلب</th>
                                <th>نوع المياه</th>
                                <th>الكمية</th>
                                <th>الحالة</th>
                                <th>التاريخ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->product->name ?? 'غير متوفر' }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <!-- خيارات إدارة الحساب -->
            <div class="card">
                <h3>إدارة الحساب</h3>
                <a href="{{ route('customer.edit', auth()->id()) }}" class="btn">تعديل الملف الشخصي</a>
                <form action="{{ route('customer.destroy', auth()->id()) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من حذف حسابك؟')">حذف الحساب</button>
                </form>
                <a href="{{ route('products.index') }}" class="btn">تصفح المنتجات</a>
            </div>
        </div>
    </div>
</body>
</html>