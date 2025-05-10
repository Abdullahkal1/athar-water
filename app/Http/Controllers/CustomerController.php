<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Product;

class CustomerController extends Controller
{
    // دالة لعرض المنتجات
    public function products()
    {
        $products = Product::all();
        return view('customer.products', compact('products'));
    }

    // دالة لإضافة طلب جديد
    public function order($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        \App\Models\Order::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => 1, // يمكنك جعلها ديناميكية لاحقًا
            'status' => 'pending',
        ]);
    
        return redirect()->back()->with('success', 'تم الطلب بنجاح!');
    }

    // دالة لعرض طلبات العميل
    public function dashboard()
{
    $orders = auth()->user()->orders()->with('product')->get();
    return view('customer.dashboard', compact('orders'));
}

    // دالة لعرض صفحة تعديل الطلب
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('customer.edit', compact('order'));
    }

    // دالة لتحديث الطلب
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $order->update([
            'water_type' => $request->water_type,
            'quantity' => $request->quantity,
        ]);
        return redirect()->route('customer.dashboard')->with('success', 'تم تعديل الطلب بنجاح!');
    }

    // دالة لحذف الطلب
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $order->delete();
        return redirect()->route('customer.dashboard')->with('success', 'تم حذف الطلب بنجاح!');
    }
}