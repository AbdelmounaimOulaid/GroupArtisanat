<?php

namespace App\Filament\Pages;

use App\Models\Order;
use Filament\Pages\Page;

class NewOrders extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-folder-plus';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.new-orders';

    protected int | string | array $columnSpan = [
        'md' => 3,
        'lg' => 3,
        'xl' => 3,
    ];
    public $orders = array();
    public function __construct(){
        $this->orders = Order::where('status','new')->orderBy('deadline', 'asc')->get();
    }
}
