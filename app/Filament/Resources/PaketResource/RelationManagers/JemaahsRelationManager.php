<?php

namespace App\Filament\Resources\PaketResource\RelationManagers;

use App\Models\Jemaah;
use App\Models\JemaahPaket;

use Filament\Forms\Components\Select;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;

use Illuminate\Database\Eloquent\Builder;
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
                Tables\Columns\TextColumn::make('setorans_sum_nominal')
                    ->label('Total Setoran')
                    ->sum(
                        [
                            'setorans' => fn(Builder $query) => $query->where('status_setoran', 'Terverifikasi')
                        ], 'nominal'
                    )
                    ->formatStateUsing(fn ($state) => h_format_currency($state))
                    ->placeholder('IDR 0')
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
                Tables\Actions\ViewAction::make()
                    ->iconButton()
                    ->tooltip('Detail Setoran')
                    ->action(fn (Jemaah $record) => $record->advance())
                    ->modalContent(
                        function (Jemaah $record) {
                            $setoran = $record->setorans;

                            return view(
                                'components.detail-setoran',
                                ['data' => $setoran]
                            );
                        }
                    ),
                Tables\Actions\DeleteAction::make()
                    ->iconButton()
                    ->tooltip('Hapus'),
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
