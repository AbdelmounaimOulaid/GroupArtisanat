<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\OrderResource;
use Filament\Actions;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
