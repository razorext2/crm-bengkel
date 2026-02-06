<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('category.category_name')
                    ->label('Kategori')
                    ->sortable(),
                ImageColumn::make('product_image_primary')
                    ->disk('public')
                    ->imageHeight(100)
                    ->label('Foto Produk'),
                TextColumn::make('product_name')
                    ->searchable()
                    ->label('Nama Produk'),
                TextColumn::make('product_unit')
                    ->searchable()
                    ->label('Satuan'),
                TextColumn::make('product_weight')
                    ->numeric()
                    ->sortable()
                    ->label('Berat'),
                TextColumn::make('price')
                    ->money('Rp.')
                    ->sortable()
                    ->label('Harga'),
                TextColumn::make('stock')
                    ->numeric()
                    ->sortable()
                    ->label('Stok'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
}
