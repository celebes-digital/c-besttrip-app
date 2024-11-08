<?php

namespace App\Filament\Resources\PaketResource\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaahsRelationManager extends RelationManager
{
    protected static string $relationship   = 'jemaahs';
    protected static ?string $title         = 'Daftar Jemaah yang Terdaftar';
    

    public function table(Tables\Table $table): Tables\Table
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
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->label('Tambahkan Jemaah')
                    ->color('warning')
                    ->preloadRecordSelect(true)
                    ->attachAnother(false)
                    ->recordSelectSearchColumns(['nama_ktp'])
                    ->recordSelect(
                        fn (Select $select) => $select
                            ->placeholder('Pilih jemaah')
                            ->optionsLimit(5)
                    ),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\RestoreAction::make()
                        ->color('success'),
                    Tables\Actions\ForceDeleteAction::make()
                        ->color('danger'),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
