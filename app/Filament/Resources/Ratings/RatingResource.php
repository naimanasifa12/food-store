<?php

namespace App\Filament\Resources\Ratings;

use App\Filament\Resources\Ratings\Pages\ListRatings;
use App\Filament\Resources\Ratings\Schemas\RatingForm;
use App\Filament\Resources\Ratings\Schemas\RatingInfolist;
use App\Models\Rating;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedSparkles;

    protected static string|UnitEnum|null $navigationGroup =
        'Ratings & Customers';

    protected static ?string $navigationLabel = 'Ratings & Reviews';

    protected static ?string $pluralLabel = 'Ratings & Reviews';

    protected static ?int $navigationSort = 6;

    protected static ?string $recordTitleAttribute = 'rating';


    public static function form(Schema $schema): Schema
    {
        return RatingForm::configure($schema);
    }


    public static function infolist(Schema $schema): Schema
    {
        return RatingInfolist::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('customer.name')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('product.title')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('rating')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('review')
                    ->searchable()
                    ->hidden(),

                TextColumn::make('created_at')
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


    // Disable tombol New Rating
    public static function canCreate(): bool
    {
        return false;
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => ListRatings::route('/'),
        ];
    }
}