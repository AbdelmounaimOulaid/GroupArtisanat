<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;

use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class ShowOrder extends Page
{
    use InteractsWithRecord;

    protected static string $resource = OrderResource::class;

    protected static string $view = 'filament.resources.order-resource.pages.show-order';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

}
