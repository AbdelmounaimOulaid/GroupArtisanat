<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->columnSpan(1),
                Forms\Components\Select::make('role')
                ->options([
                    'admin' => 'Admin',
                    'manager' => 'Manager',
                    'fournisseur' => 'Fournisseur',
                ])
                ->required(),
                Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->columnSpan(1),
                Forms\Components\TextInput::make('password')
                ->password()
                ->revealable()
                ->required(function($record){
                    if($record){
                        return false;
                    }
                    return true;
                })
                ->columnSpan(1),
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('role')->sortable()->searchable()->badge()
                ->color(fn (string $state): string => match ($state) {
                    'admin' => 'secondary',
                    'fournisseur' => 'tertiary',
                    'manager' => 'primary',
                }),
                Tables\Columns\TextColumn::make('email')->sortable()->searchable(),
                Tables\Columns\ToggleColumn::make('status')
                ->visible(fn ($record) => $record?->role !== 'admin')
                ->disabled(fn ($record) => $record?->role === 'admin'),            ])
            ->filters([
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->visible(fn ($record) => $record->role !== 'admin'),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function canAccess(array $parameters = []): bool
    {        
        return auth()->user()->role == 'admin';
        
    }
}
