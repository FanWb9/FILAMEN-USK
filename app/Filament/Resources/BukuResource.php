<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Filament\Resources\BukuResource\RelationManagers;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Card::make()
                ->schema([
                    Forms\Components\TextInput::make('Id_barang')
                    ->label('No Barang')
                    ->placeholder('Masukkan No Barang')
                    ->required(),

                    Forms\Components\TextInput::make('Nama_barang')
                    ->label('Nama Barang')
                    ->placeholder('Masukkan Nama Barang')
                    ->required(),

                    Forms\Components\TextInput::make('Kategori')
                    ->label('Kategori')
                    ->placeholder('Masukkan Kategori')
                    ->required(),

                    Forms\Components\TextInput::make('quantity')
                    ->label('Quantity')
                    ->placeholder('Masukkan Quantity')
                    ->required(),


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('Id_barang')->label('No Barang')->searchable(),
                Tables\Columns\TextColumn::make('Nama_barang')->label('Nama Barang')->searchable(),
                Tables\Columns\TextColumn::make('Kategori')->label('Kategori'),
                Tables\Columns\TextColumn::make('quantity')->label('Quantity'),
                
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
            'index' => Pages\ListBukus::route('/'),
            'create' => Pages\CreateBuku::route('/create'),
            'edit' => Pages\EditBuku::route('/{record}/edit'),
        ];
    }
}
