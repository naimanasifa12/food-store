<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages\CreateSlider;
use App\Filament\Resources\Sliders\Pages\EditSlider;
use App\Filament\Resources\Sliders\Pages\ListSliders;
use App\Filament\Resources\Sliders\Pages\ViewSlider;
use App\Models\Slider;
use BackedEnum;
use UnitEnum;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

use Filament\Resources\Resource;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use Filament\Support\Icons\Heroicon;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

use App\Filament\Resources\Sliders\Schemas\SliderInfolist;

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([

                        // Image
                        FileUpload::make('image')
                            ->label('Slider Image')
                            ->placeholder('Slider Image')
                            ->required(),

                        // Link
                        TextInput::make('link')
                            ->label('Link')
                            ->placeholder('Link')
                            ->required(),

                    ]),
            ]);
    }


    public static function infolist(Schema $schema): Schema
    {
        return SliderInfolist::configure($schema);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                ImageColumn::make('image'),

                TextColumn::make('link'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'view' => ViewSlider::route('/{record}'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}