<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BukuResource\Pages;
use App\Filament\Resources\BukuResource\RelationManagers;
use App\Models\Buku;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BukuResource extends Resource
{
    protected static ?string $model = Buku::class;
    protected static ?string $modelLabel = 'Buku';
    protected static ?string $pluralModelLabel = 'Buku';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Buku')
                    ->schema(([
                        TextInput::make('judul')
                            ->label('Judul')
                            ->minLength(2)
                            ->maxLength(100)
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('penulis')
                            ->label('Penulis')
                            ->minLength(2)
                            ->maxLength(100)
                            ->required(),
                        TextInput::make('tahun_terbit')
                            ->label('Tahun terbit')
                            ->minLength(2)
                            ->maxLength(100)
                            ->required(),
                        Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship('kategori','nama_kategori')   
                            ->searchable() 
                            ->required(),
                    ]))->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')->label('Judul'),
                TextColumn::make('penulis')->label('Penulis'),
                TextColumn::make('tahun_terbit')->label('Tahun Terbit'),
                TextColumn::make('kategori.nama_kategori')->label('Kategori'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
