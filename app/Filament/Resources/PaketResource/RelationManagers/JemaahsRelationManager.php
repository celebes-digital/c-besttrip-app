<?php

namespace App\Filament\Resources\PaketResource\RelationManagers;

use App\Enums\StatusJemaahPaket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaahsRelationManager extends RelationManager
{
    protected static string $relationship = 'jemaahs';
    protected static ?string $title = 'Daftar Jemaah yang Terdaftar';
    

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_ktp')
            ->columns([
                Tables\Columns\TextColumn::make('nama_ktp')
                    ->label('Nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_paket')
                    ->label('Kode Paket')
                    ->icon('heroicon-o-clipboard')
                    ->iconPosition(IconPosition::After)
                    ->copyable()
                    ->copyableState(fn (string $state): string => url('/jemaah/' . $state . '/paket')),
                Tables\Columns\TextColumn::make('tgl_pendaftaran')
                    ->label('Tanggal Pendaftaran')
                    ->formatStateUsing(fn ($state) => $state->format('d F Y'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_pendaftaran')
                    ->badge(),
            ])
            ->defaultSort('jemaah_paket.updated_at', 'desc')
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
