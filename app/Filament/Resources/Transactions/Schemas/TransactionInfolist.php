<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class TransactionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer_id')
                    ->numeric(),
                TextEntry::make('province_name'),
                TextEntry::make('city_name'),
                TextEntry::make('district_name'),
                TextEntry::make('subdistrict_name'),
                TextEntry::make('zip_code'),
                TextEntry::make('full_address')
                    ->columnSpanFull(),
                TextEntry::make('invoice'),
                TextEntry::make('weight')
                    ->numeric(),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
