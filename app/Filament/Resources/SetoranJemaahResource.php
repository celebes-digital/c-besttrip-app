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
                Forms\Components\FileUpload::make('bukti_setor')
                    ->label('Bukti Setor')
                    ->columnSpanFull()
                    ->image()
                    ->required(),
                Forms\Components\Select::make('id_jemaah')
                    ->label('Nama Jemaah')
                    ->options(
                        Jemaah::all()->pluck('nama_ktp', 'id')
                    )
                    ->live(onBlur: true)
                    ->searchable()
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('id_paket')
                    ->label('Nama Paket')
                    ->options(
                        fn (Get $get) 
                        => JemaahPaket::where('jemaah_id', $get('id_jemaah'))
                            ->get()
                            ->pluck('nama_paket', 'id')
                            ->toArray()
                    )
                    ->live(onBlur: true)
                    ->helperText('Pilih terlibih dahulu nama jemaah')
                    ->disabled(fn (Get $get) => $get('id_jemaah') === null)
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
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('paket_jemaah_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nominal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_setor')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bukti_setor')
                    ->searchable(),
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
            'view'      => Pages\ViewSetoranJemaah::route('/{record}'),
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
