<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Filament\Resources\PaketResource\RelationManagers;
use App\Models\Paket;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaketResource extends Resource
{
    protected static ?string $model             = Paket::class;
    protected static ?string $navigationIcon    = 'heroicon-o-squares-plus';
    protected static ?string $slug              = 'paket';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->imageEditor()
                    ->directory('paket/foto')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nama_paket')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('deskripsi')
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga')
                    ->prefix('IDR')
                    ->mask(RawJs::make(
                        <<<'JS'
                            $money($input, ',', '.', 0);
                        JS
                    ))
                    ->stripCharacters(['.'])
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('tgl_paket')
                    ->label('Tanggal Paket')
                    ->native(false)
                    ->displayFormat('d F Y')
                    ->prefixIcon('heroicon-o-calendar')
                    ->prefixIconColor('primary')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto'),
                Tables\Columns\TextColumn::make('nama_paket')
                    ->grow(false)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi'),
                Tables\Columns\TextColumn::make('harga')
                    ->prefix('IDR ')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_paket')
                    ->label('Tanggal Paket')
                    ->date('d F Y')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Aktif'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Waktu Hapus')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Buat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Ubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Paket Aktif')
                    ->native(false)
                    ->placeholder('Semua Paket')
                    ->trueLabel('Aktif')
                    ->falseLabel('Tidak Aktif')
                    ->queries(
                        true    : fn(Builder $query) => $query->where('is_active', true),
                        false   : fn(Builder $query) => $query->where('is_active', false),
                        blank   : fn(Builder $query) => $query,
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('primary'),
                Tables\Actions\EditAction::make()
                    ->color('warning'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ReplicateAction::make(),
                    Tables\Actions\RestoreAction::make()
                        ->color('success'),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make()
                        ->color('danger'),
                ]),
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
            'index'     => Pages\ListPakets::route('/'),
            'create'    => Pages\CreatePaket::route('/create'),
            'edit'      => Pages\EditPaket::route('/{record}/edit'),
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
