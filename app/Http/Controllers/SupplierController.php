<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class SupplierController extends Controller
{
    public function dashboard()
    {
        $orders = \App\Models\Order::where('status', 'pending')->with('user')->get();
        return view('supplier.dashboard', compact('orders'));
    }

    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'delivered';
        $order->save();

        return redirect()->route('supplier.dashboard')->with('success', 'تم تحديث حالة الطلب!');
    }
}