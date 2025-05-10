<!DOCTYPE html>
<html>
<head>
    <title>تعديل الطلب</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>تعديل الطلب</h1>

        <form action="{{ route('customer.update', $order->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="water_type">نوع المياه</label>
                <select name="water_type" id="water_type" class="form-control">
                    <option value="mineral" {{ $order->water_type == 'mineral' ? 'selected' : '' }}>معدنية</option>
                    <option value="filtered" {{ $order->water_type == 'filtered' ? 'selected' : '' }}>مفلترة</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quantity">الكمية</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $order->quantity }}" min="1">
            </div>

            <button type="submit" class="btn btn-success">حفظ التعديلات</button>
            <a href="{{ route('customer.dashboard') }}" class="btn btn-secondary">رجوع</a>
        </form>
    </div>
</body>
</html>