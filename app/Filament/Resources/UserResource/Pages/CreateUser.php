<?php

namespace App\Filament\Resources\UserResource\Pages;
use AymanAlhattami\FilamentPageWithSidebar\Traits\HasPageSidebar;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    use HasPageSidebar;

    protected static string $resource = UserResource::class;
}
