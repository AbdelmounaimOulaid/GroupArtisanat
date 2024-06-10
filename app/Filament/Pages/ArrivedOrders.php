<?php

namespace App\Filament\Pages;

use App\Models\Order;
use Filament\Pages\Page;

class ArrivedOrders extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.arrived-orders';

    protected int | string | array $columnSpan = [
        'md' => 3,
        'lg' => 3,
        'xl' => 3,
    ];
    public $orders = array();
    public function __construct(){
        $this->orders = Order::where('status','arriver')->orderBy('deadline', 'asc')->get();
    }
}
