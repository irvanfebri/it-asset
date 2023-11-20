<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AssetResource\Pages;
use App\Filament\Resources\AssetResource\RelationManagers;
use App\Models\Asset;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class AssetResource extends Resource
{
    protected static ?string $model = Asset::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_asset')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('category_id')
                    ->relationship('categories', 'name')
                    ->required(),
                    Forms\Components\Section::make('Images')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('image')
                            ->collection('product-images')
                            ->multiple()
                            ->maxFiles(5)
                            ->disableLabel(),
                    ])
                    ->collapsible(),
                Forms\Components\TextInput::make('kode_asset')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('spek')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('kondisi_asset')
                    ->options([
                        'Dapat digunakan' => 'Dapat digunakan',
                        'Rusak dapat diperbaiki' => 'Rusak dapat diperbaiki',
                        'Rusak Tidak dapat diperbaiki' => 'Rusak Tidak dapat diperbaiki',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_asset'),
                Tables\Columns\TextColumn::make('categories.name'),
                Tables\Columns\TextColumn::make('image'),
                Tables\Columns\TextColumn::make('kode_asset'),
                Tables\Columns\TextColumn::make('spek'),
                Tables\Columns\TextColumn::make('kondisi_asset'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListAssets::route('/'),
            'create' => Pages\CreateAsset::route('/create'),
            'edit' => Pages\EditAsset::route('/{record}/edit'),
        ];
    }
}
