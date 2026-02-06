<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\ProductCategory;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->label('Kategori')
                    ->options(ProductCategory::all()->pluck('category_name', 'id'))
                    ->searchable(),
                TextInput::make('product_name')
                    ->label('Nama Produk')
                    ->required(),
                FileUpload::make('product_image_primary')
                    ->label('Gambar Utama')
                    ->image()
                    ->maxSize(2048)
                    ->directory('products/primary')
                    ->disk('public')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                FileUpload::make('product_images')
                    ->label('Gambar Produk')
                    ->image()
                    ->multiple()
                    ->maxFiles(3)
                    ->maxSize(2048)
                    ->directory('products')
                    ->disk('public')
                    ->reorderable()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->columnSpanFull(),
                Textarea::make('product_description')
                    ->label('Deskripsi Produk')
                    ->columnSpanFull(),
                Select::make('product_unit')
                    ->label('Satuan')
                    ->options([
                        'pcs' => 'PCS',
                        'buah' => 'Buah',
                        'kg' => 'Kg',
                        'liter' => 'Liter',
                    ]),
                TextInput::make('product_weight')
                    ->label('Berat')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('Rp'),
                TextInput::make('stock')
                    ->label('Stok')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
