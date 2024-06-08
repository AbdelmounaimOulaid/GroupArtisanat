<?php

namespace App\Filament\Resources\OrderResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\OrderResource;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
