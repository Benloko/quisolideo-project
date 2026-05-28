<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = (string) $request->query('status', '');

        $orders = Order::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('order_number', 'like', '%' . $q . '%')
                        ->orWhere('customer_name', 'like', '%' . $q . '%')
                        ->orWhere('customer_email', 'like', '%' . $q . '%');
                });
            })
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|string|in:pending,confirmed,shipped,cancelled',
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', 'Statut mis à jour');
    }
}
