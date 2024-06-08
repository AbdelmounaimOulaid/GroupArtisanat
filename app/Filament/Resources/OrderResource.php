<?php
namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\Widgets\OrderRessource; // Import your widget here
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required(),
                Forms\Components\DatePicker::make('deadline')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'New Order' => 'New Order',
                        'Arrivé' => 'Arrivé',
                        'Refuser' => 'Refuser',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deadline')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
            ])
            ->filters([]) 
            ->headerActions([
                Tables\Actions\CreateAction::make(), 
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
