<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\TextSize;

class ViewTransaction extends ViewRecord
{
    protected static string $resource = TransactionResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('General Information')
                    ->schema([
                        TextEntry::make('invoice')
                            ->label('Invoice'),

                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'success' => 'success',
                                'expired' => 'gray',
                                'failed'  => 'danger',
                                default   => 'gray',
                            }),

                        TextEntry::make('created_at')
                            ->label('Created at')
                            ->dateTime('d M Y H:i'),
                    ])
                    ->columns(3),

                Section::make('Customer Information')
                    ->schema([
                        TextEntry::make('customer.name')
                            ->label('Customer Name'),

                        TextEntry::make('customer.email')
                            ->label('Email Address'),

                        TextEntry::make('full_address')
                            ->label('Address'),
                    ])
                    ->columns(3),

                Section::make('Ongkos Kirim')
                    ->schema([
                        TextEntry::make('shipping.shipping_courier')
                            ->label('Jasa Kirim'),

                        TextEntry::make('shipping.shipping_service')
                            ->label('Layanan Kirim'),

                        TextEntry::make('shipping.shipping_cost')
                            ->label('Ongkos Kirim')
                            ->numeric(decimalPlaces: 0)
                            ->money('IDR', locale: 'id'),
                    ])
                    ->columns(3),

                Section::make('Transaction Details')
                    ->schema([
                        RepeatableEntry::make('transactionDetails')
                            ->label('Item Details')
                            ->schema([
                                ImageEntry::make('product.image')
                                    ->label('Product Image')
                                    ->circular()
                                    ->width(100)
                                    ->height(100),

                                TextEntry::make('product.title')
                                    ->label('Product Name'),

                                TextEntry::make('qty')
                                    ->label('Quantity'),

                                TextEntry::make('price')
                                    ->label('Price')
                                    ->numeric(decimalPlaces: 0)
                                    ->money('IDR', locale: 'id'),
                            ])
                            ->columns(4),
                    ]),

                Section::make()
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('total')
                                    ->label('Grand Total')
                                    ->numeric(decimalPlaces: 0)
                                    ->money('IDR', locale: 'id')
                                    ->size(TextSize::Large)
                                    ->color('primary')
                                    ->alignEnd(),
                            ]),
                    ]),
            ]);
    }
}