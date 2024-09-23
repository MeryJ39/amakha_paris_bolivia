<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class DashboardOverview extends Widget
{
    protected static string $view = 'filament.widgets.dashboard-overview';

    public function getUsersCount(): int
    {
        return User::count();
    }

    public function getProductsCount(): int
    {
        return Product::count();
    }

    public function getOrdersCount(): int
    {
        return Order::count();
    }

    public function getTotalSales(): float
    {
        return Order::sum('total');
    }
}
