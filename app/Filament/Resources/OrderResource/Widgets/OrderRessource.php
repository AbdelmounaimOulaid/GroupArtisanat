<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\Order;
class OrderRessource extends Widget
{
    protected static string $view = 'filament.resources.order-resource.widgets.order-ressource';
    protected int | string | array $columnSpan = [
        'md' => 2,
        'lg' => 1,
        'xl' => 2,
    ];
    public $orders = array();
    public function __construct(){
        $this->orders = Order::all();
    }
}
