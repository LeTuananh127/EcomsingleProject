<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // View pending orders
    public function index()
    {
        $pending_orders = Order::where('status', 'pending')->latest()->get();
        return view('admin.pendingorders', compact('pending_orders'));
    }

    // Confirm a specific order
    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Confirmed';
        $order->save();

        return redirect()->route('pendingorders')->with('success', 'Order confirmed successfully!');
    }

    // Cancel a specific order
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Canceled';
        $order->save();

        return redirect()->route('pendingorders')->with('success', 'Order canceled successfully!');
    }

    // View all confirmed orders
    public function confirmedOrders()
    {
        $confirmed_orders = Order::where('status', 'Confirmed')->latest()->get();
        return view('admin.confirmed', compact('confirmed_orders'));
    }

    // View all canceled orders
    public function canceledOrders()
    {
        $canceled_orders = Order::where('status', 'Canceled')->latest()->get();
        return view('admin.canceled', compact('canceled_orders'));
    }
}
