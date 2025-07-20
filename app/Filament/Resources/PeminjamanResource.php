<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Filament\Resources\PeminjamanResource\RelationManagers;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;
    protected static ?string $modelLabel = 'Peminjaman';
    protected static ?string $pluralModelLabel = 'Peminjaman';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Peminjaman')
                    ->schema(([
                        Select::make('buku_id')
                        ->label('Judul')
                        ->relationship('buku', 'judul')
                        ->searchable()
                        ->required(),
                        Select::make('anggota_id')       
                        ->label('Anggota')  
                        ->relationship('anggota', 'nama')
                        ->searchable()  
                        ->required(),
                        DatePicker::make('tanggal_peminjaman')
                        ->label('Tanggal Peminjaman')   
                        ->required(),
                        DatePicker::make('tanggal_pengembalian')
                        ->label('Tanggal Pengembalian')    
                        ->required(),
                        Select::make('pengguna_id')
                        ->label('Pengguna')    
                        ->relationship('pengguna', 'nama')
                        ->searchable()
                        ->required(),
                        
                ]))->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('buku.judul')->label('Buku'),
                TextColumn::make('anggota.nama')->label('Anggota'),
                TextColumn::make('tanggal_peminjaman')->label('Tanggal Peminjaman')->date(),
                TextColumn::make('tanggal_pengembalian')->label('Tanggal Pengembalian')->date(),
                TextColumn::make('pengguna.nama')->label('Pengguna'),
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
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
