<?php

namespace App\Filament\Resources\Carts;

use App\Filament\Resources\Carts\Pages\ListCarts;
use App\Filament\Resources\Carts\Schemas\CartForm;
use App\Filament\Resources\Carts\Schemas\CartInfolist;
use App\Models\Cart;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedShoppingCart;

    protected static string|UnitEnum|null $navigationGroup =
        'Carts & Orders';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return CartForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CartInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.title')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('customer.name')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('qty')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('total')
                    ->hidden(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCarts::route('/'),
        ];
    }
}