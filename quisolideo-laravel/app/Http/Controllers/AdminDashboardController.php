<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Training;
use App\Models\TrainingRegistration;

class AdminDashboardController extends Controller
{
    public function entreprenariat()
    {
        $kpis = [
            'trainings' => Training::count(),
            'partners' => Partner::count(),
            'messages_total' => ContactMessage::count(),
            'messages_unread' => ContactMessage::where('read_flag', false)->count(),
            'registrations_total' => TrainingRegistration::count(),
            'registrations_today' => TrainingRegistration::whereDate('created_at', now()->toDateString())->count(),
        ];

        return view('admin.dashboard_entreprenariat', compact('kpis'));
    }

    public function boutique()
    {
        $kpis = [
            'categories' => ProductCategory::count(),
            'products' => Product::count(),
            'products_active' => Product::where('is_active', true)->count(),
            'orders_total' => Order::count(),
            'orders_pending' => Order::where('status', 'pending')->count(),
            'orders_today' => Order::whereDate('created_at', now()->toDateString())->count(),
        ];

        return view('admin.dashboard_boutique', compact('kpis'));
    }
}
