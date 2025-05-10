@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">طلب مياه</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="water_type" class="form-label">نوع المياه</label>
                            <select name="water_type" class="form-select">
                                <option value="mineral">صحي</option>
                                <option value="chilled">مبرد</option>
                                <option value="glass">زجاجي</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">الكمية</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="delivery_date" class="form-label">تاريخ التوصيل</label>
                            <input type="date" name="delivery_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                        <div class="mb-3">
    <label for="payment_method" class="form-label">طريقة الدفع</label>
    <select name="payment_method" class="form-select">
        <option value="cash">الدفع عند الاستلام</option>
        <option value="stcpay">STCPay</option>
    </select>
</div>
                            <label for="location" class="form-label">الموقع</label>
                            <!-- حقل الخريطة -->
                            <div id="map" style="height: 400px; width: 100%;"></div>
                            <!-- حقول مخفية للإحداثيات -->
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="text" name="location" id="location" class="form-control mt-2" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">اطلب الآن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript لتحميل الخريطة -->
<script>
    let map, marker;

    function initMap() {
        // الإحداثيات الافتراضية (مثلاً: الرياض)
        const defaultLocation = { lat: 24.7136, lng: 46.6753 };

        // إنشاء الخريطة
        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 12,
        });

        // إضافة علامة (Marker) قابلة للسحب
        marker = new google.maps.Marker({
            position: defaultLocation,
            map: map,
            draggable: true,
        });

        // تحديث الإحداثيات عند تحريك العلامة
        marker.addListener("dragend", function () {
            const position = marker.getPosition();
            document.getElementById("latitude").value = position.lat();
            document.getElementById("longitude").value = position.lng();

            // الحصول على العنوان باستخدام Geocoder
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: position }, function (results, status) {
                if (status === "OK" && results[0]) {
                    document.getElementById("location").value = results[0].formatted_address;
                }
            });
        });

        // تحديد الموقع الافتراضي
        document.getElementById("latitude").value = defaultLocation.lat;
        document.getElementById("longitude").value = defaultLocation.lng;

        // محاولة تحديد الموقع الحالي للمستخدم
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(userLocation);
                marker.setPosition(userLocation);
                document.getElementById("latitude").value = userLocation.lat;
                document.getElementById("longitude").value = userLocation.lng;

                // الحصول على العنوان
                const geocoder = new google.maps.Geocoder();
                geocoder.geocode({ location: userLocation }, function (results, status) {
                    if (status === "OK" && results[0]) {
                        document.getElementById("location").value = results[0].formatted_address;
                    }
                });
            });
        }
    }

    // استدعاء الدالة عند تحميل الصفحة
    window.onload = initMap;
</script>
@endsection