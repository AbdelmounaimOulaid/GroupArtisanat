<?php

namespace App\Filament\Pages;

use App\Models\Order;
use Filament\Pages\Page;

class RefusedOrders extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-minus';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.refused-orders';

    protected int | string | array $columnSpan = [
        'md' => 3,
        'lg' => 3,
        'xl' => 3,
    ];
    public $orders = array();
    public function __construct(){
        $this->orders = Order::where('status','refuser')->orderBy('deadline', 'asc')->get();
    }
}
