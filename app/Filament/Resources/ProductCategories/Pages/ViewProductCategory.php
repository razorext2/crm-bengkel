<?php

namespace App\Filament\Resources\ProductCategories\Pages;

use App\Filament\Resources\ProductCategories\ProductCategoryResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ViewProductCategory extends ViewRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected static ?string $title = 'Detail Kategori';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Kategori'),
        ];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->schema(
                [
                    Grid::make(12)->schema([
                        ImageEntry::make('category_icon')
                            ->disk('public')
                            ->imageHeight(50)
                            ->circular()
                            ->columnSpan(4),
                        TextEntry::make('category_name')
                            ->label('Nama Kategori')
                            ->weight('bold')
                            ->size('lg')
                            ->columnSpan(8),
                    ])->columnSpanFull(),

                    ImageEntry::make('category_image')
                        ->disk('public')
                        ->label('Gambar Kategori')
                        ->imageHeight(240)
                        ->extraImgAttributes([
                            'class' => 'rounded-lg object-cover',
                        ]),

                    // 🔹 BARIS 3: Description
                    TextEntry::make('category_description')
                        ->label('Deskripsi')
                        ->markdown()
                        ->columnSpanFull(),

                ]);
    }
}
