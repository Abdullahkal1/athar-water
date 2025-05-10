<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    public function create()
    {
        return view('donations.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1',
    ]);

    // تسجيل التبرع
    $donation = Donation::create([
        'user_id' => Auth::id(),
        'amount' => $request->amount,
        'quantity' => 1, // قيمة افتراضية لـ quantity
        'order_id' => null, // لو مش مطلوب، اجعله NULL
        'recipient' => 'Default Recipient', // قيمة افتراضية
        'status' => 'pending', // قيمة افتراضية
    ]);

    // إضافة نقاط خيرية
    $point = Point::create([
        'user_id' => Auth::id(),
        'points' => $request->amount * 10,
    ]);

    return redirect()->route('supplier.dashboard')->with('success', 'تم التبرع بنجاح!');
}
}