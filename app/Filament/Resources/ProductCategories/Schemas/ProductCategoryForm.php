<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('category_name')
                    ->label('Nama Kategori')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('category_icon')
                    ->label('Ikon Kategori')
                    ->disk('public')
                    ->directory('categories/icons')
                    ->required()
                    ->image(),
                FileUpload::make('category_image')
                    ->label('Gambar Kategori')
                    ->disk('public')
                    ->directory('categories/images')
                    ->afterLabel('*Opsional, berupa gambar wide untuk keperluan promosi')
                    ->image()
                    ->maxSize(1024)
                    ->nullable(),
                Textarea::make('category_description')
                    ->label('Deskripsi Kategori')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
