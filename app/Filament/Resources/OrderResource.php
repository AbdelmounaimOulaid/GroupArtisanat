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
                            ->columnSpan(2),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpan(2),
                        Forms\Components\DatePicker::make('deadline')
                            ->required()
                            ->columnSpan(1),
                        Forms\Components\TextInput::make('taille')
                            ->required()
                            ->columnSpan(1),
                        Forms\Components\Select::make('status')
                            ->options([
                                'New Order' => 'New Order',
                                'Arrivé' => 'Arrivé',
                                'Refuser' => 'Refuser',
                            ])
                            ->required(),
                        Forms\Components\FileUpload::make('images')
                            ->multiple()
                            ->disk('public')
                            ->directory('/storage/orders')
                            ->required()
                            ->columnSpan(1)
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
            ->headerActions([
                Tables\Actions\CreateAction::make(), 
            ])
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
            'view' => Pages\ViewOrder::route('/{record}'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),

        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->name == 'admin';
        
    
    }


}
