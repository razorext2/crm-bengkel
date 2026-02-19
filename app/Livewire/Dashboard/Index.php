<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public function getTotalRevenue()
    {
        $totalRevenue = \App\Models\Transaction::where('order_status', 3)
            ->where('is_completed', 1)
            ->sum('total_amount');

        return $totalRevenue;
    }

    public function getRevenueComparison()
    {
        $currentMonthRevenue = \App\Models\Transaction::whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfMonth(),
        ])
            ->where('order_status', 3)
            ->where('is_completed', 1)
            ->sum('total_amount');

        $lastMonthRevenue = \App\Models\Transaction::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(),
            now()->subMonth()->endOfMonth(),
        ])
            ->where('order_status', 3)
            ->where('is_completed', 1)
            ->sum('total_amount');

        // Hitung persentase perubahan
        if ($lastMonthRevenue > 0) {
            $percentage = (($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100;
        } else {
            $percentage = $currentMonthRevenue > 0 ? 100 : 0;
        }

        return [
            'current' => $currentMonthRevenue,
            'last' => $lastMonthRevenue,
            'percentage' => round($percentage, 1),
        ];
    }

    public function getTotalOrder()
    {
        $totalOrder = \App\Models\Transaction::whereIn('order_status', [0, 1, 2, 3])->count();

        return $totalOrder;
    }

    public function getOrderComparison()
    {
        $now = Carbon::now();

        $currentMonth = [
            $now->copy()->startOfMonth(),
            $now->copy()->endOfMonth(),
        ];

        $lastMonth = [
            $now->copy()->subMonth()->startOfMonth(),
            $now->copy()->subMonth()->endOfMonth(),
        ];

        $current = \App\Models\Transaction::whereIn('order_status', [0, 1, 2, 3])
            ->whereBetween('created_at', $currentMonth)
            ->count();

        $last = \App\Models\Transaction::whereIn('order_status', [0, 1, 2, 3])
            ->whereBetween('created_at', $lastMonth)
            ->count();

        $percentage = $last > 0
            ? (($current - $last) / $last) * 100
            : ($current > 0 ? 100 : 0);

        return [
            'current' => $current,
            'last' => $last,
            'percentage' => round($percentage, 1),
        ];
    }

    public function getTotalCustomer()
    {
        return \App\Models\User::where('is_admin', false)->count();
    }

    public function getCustomerComparison()
    {
        $now = Carbon::now();

        $currentMonth = [
            $now->copy()->startOfMonth(),
            $now->copy()->endOfMonth(),
        ];

        $lastMonth = [
            $now->copy()->subMonth()->startOfMonth(),
            $now->copy()->subMonth()->endOfMonth(),
        ];

        $current = User::where('is_admin', false)
            ->whereBetween('created_at', $currentMonth)
            ->count();

        $last = User::where('is_admin', false)
            ->whereBetween('created_at', $lastMonth)
            ->count();

        $percentage = $last > 0
            ? (($current - $last) / $last) * 100
            : ($current > 0 ? 100 : 0);

        return [
            'current' => $current,
            'last' => $last,
            'percentage' => round($percentage, 1),
        ];
    }

    public function getRevenueDataProperty()
    {
        return $this->getRevenueComparison();
    }

    public function getOrderDataProperty()
    {
        return $this->getOrderComparison();
    }

    public function getCustomerDataProperty()
    {
        return $this->getCustomerComparison();
    }

    public function fiveLastOrders()
    {
        return \App\Models\Transaction::take(5)->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
