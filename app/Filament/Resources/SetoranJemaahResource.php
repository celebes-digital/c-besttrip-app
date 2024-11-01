<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SetoranJemaahResource\Pages;
use App\Filament\Resources\SetoranJemaahResource\RelationManagers;

use App\Models\Jemaah;
use App\Models\JemaahPaket;
use App\Models\Paket;
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
                // Forms\Components\Split::make([
                    Forms\Components\FileUpload::make('bukti_setor')
                        ->label('Bukti Setor')
                        ->image()
                        ->directory('poto/setoran')
                        ->panelAspectRatio('6:5')
                        ->required(),
                    Forms\Components\Group::make([
                        Forms\Components\Select::make('jemaah_id')
                            ->native(false)
                            ->label('Nama Jemaah')
                            ->default('jemaahPaket.jemaah_id')
                            ->relationship('jemaahPaket.jemaah', 'nama_ktp')
                            ->live()
                            ->searchable()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('paket_id')
                            ->label('Nama Paket')
                            ->required()
                            ->default('jemaahPaket.paket_id')
                            ->disabled(fn (Get $get) => !$get('jemaah_id'))
                            ->native(false)
                            ->options(
                                fn (Get $get) 
                                => JemaahPaket::query()
                                    ->where('jemaah_id', $get('jemaah_id'))
                                    ->join('paket', 'paket.id', 'paket_id')
                                    ->pluck('nama_paket', 'paket.id')
                                    ->toArray()
                            )
                            ->helperText('Pilih terlebih dahulu nama jemaah'),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_setor')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('bukti_setor'),
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
