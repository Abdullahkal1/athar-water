<!DOCTYPE html>
<html>
<head>
    <title>منتجات المياه</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>منتجات المياه</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>اسم المنتج</th>
                    <th>نوع المياه</th>
                    <th>السعر</th>
                    <th>الإجراء</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->water_type }}</td>
                        <td>{{ $product->price }} ريال</td>
                        <td>
                            <form action="{{ route('customer.order', $product->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="quantity">الكمية:</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control d-inline-block" style="width: 100px;" min="1" value="1">
                                </div>
                                <button type="submit" class="btn btn-success">طلب</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>