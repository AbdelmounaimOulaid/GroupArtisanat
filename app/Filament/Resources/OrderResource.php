<?php
namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Log;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpan(1),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\DatePicker::make('deadline')
                            ->required()
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('status')
                            ->required()
                            ->columnSpan(1),
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->disk('public')
                            ->directory('/storage/orders')
                            ->required()
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\ImageColumn::make('images')
                ->circular()
                ->stacked(),
                Tables\Columns\TextColumn::make('description')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('deadline')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
            ])
            ->filters([])
            ->defaultSort('id', 'desc') 
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);;
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
