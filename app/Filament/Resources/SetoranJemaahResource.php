<?php

namespace App\Filament\Resources;

use App\Enums\StatusSetoran;
use App\Filament\Resources\SetoranJemaahResource\Pages;
use App\Filament\Resources\SetoranJemaahResource\RelationManagers;

use App\Models\SetoranJemaah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SetoranJemaahResource extends Resource
{
    protected static ?string $model = SetoranJemaah::class;

    protected static ?string $navigationIcon    = 'heroicon-o-rectangle-stack';
    protected static ?string $slug              = 'setoran-jemaah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('bukti_setor')
                    ->label('Bukti Setor')
                    ->image()
                    ->directory('poto/setoran')
                    ->panelAspectRatio('6:5')
                    ->required(),
                Forms\Components\Group::make([
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('jemaah_id')
                            ->native(false)
                            ->label('Nama Jemaah')
                            ->relationship(
                                'jemaah',
                                'nama_ktp',
                            )
                            ->afterStateUpdated(
                                fn(Set $set) => $set('paket_id', null)
                            )
                            ->live()
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('paket_id')
                            ->label('Nama Paket')
                            ->required()
                            ->disabled(fn(Get $get) => !$get('jemaah_id'))
                            ->native(false)
                            ->options(function (Get $get) {
                                $jemaahId = $get('jemaah_id');

                                if (!$jemaahId) {
                                    return [];
                                }

                                $options = \App\Models\JemaahPaket::where('jemaah_id', $jemaahId)
                                    ->join('paket', 'paket.id', '=', 'jemaah_paket.paket_id')
                                    ->pluck('paket.nama_paket', 'paket.id')
                                    ->toArray();

                                // Jika tidak ada opsi, kembalikan array dengan pesan "Tidak ada paket"
                                if (empty($options)) {
                                    return ['' => 'Tidak ada paket tersedia'];
                                }

                                return $options;
                            })
                            ->helperText('Pilih terlebih dahulu nama jemaah'),
                    ])
                        ->relationship('jemaahPaket'),
                    Forms\Components\Textarea::make('keterangan')
                        ->label('Keterangan')
                        ->rows(3)
                        ->required(),
                    Forms\Components\TextInput::make('nominal')
                        ->prefix('IDR')
                        ->mask(
                            RawJs::make(
                                <<<'JS'
                                        $money($input, ',', '.', 0);
                                    JS
                            )
                        )
                        ->stripCharacters(['.'])
                        ->required()
                        ->numeric(),
                    Forms\Components\DateTimePicker::make('waktu_setor')
                        ->displayFormat('d F Y H:m')
                        ->default(now())
                        ->native(false)
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jemaahPaket.jemaah.nama_ktp')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jemaahPaket.paket.nama_paket')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->formatStateUsing(fn ($state): string => h_format_currency($state))
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_setor')
                    ->dateTime()
                    ->formatStateUsing(fn ($state): string => h_format_datetime($state))
                    ->sortable(),
                Tables\Columns\ImageColumn::make('bukti_setor'),
                Tables\Columns\SelectColumn::make('status_setoran')
                    ->selectablePlaceholder(false)
                    ->options(StatusSetoran::class)
                    ->rules(['required']),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'     => Pages\ListSetoranJemaahs::route('/'),
            'create'    => Pages\CreateSetoranJemaah::route('/create'),
            // 'view'      => Pages\ViewSetoranJemaah::route('/{record}'),
            'edit'      => Pages\EditSetoranJemaah::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
