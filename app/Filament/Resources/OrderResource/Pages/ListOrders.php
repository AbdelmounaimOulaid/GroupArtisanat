<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource;

class ListOrders extends ListRecords
{
    // protected static string $view = 'filament.components.order-card';

    protected static string $resource = OrderResource::class;
}
