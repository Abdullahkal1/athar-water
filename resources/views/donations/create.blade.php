<!DOCTYPE html>
<html>
<head>
    <title>إضافة تبرع</title>
</head>
<body>
    <h1>إضافة تبرع جديد</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('donations.store') }}">
        @csrf
        <label for="amount">المبلغ:</label>
        <input type="number" name="amount" id="amount" step="0.01" required>
        <br><br>
        <button type="submit">تبرع الآن</button>
    </form>
</body>
</html>