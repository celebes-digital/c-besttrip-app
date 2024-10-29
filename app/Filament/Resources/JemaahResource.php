<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JemaahResource\Pages;
use App\Filament\Resources\JemaahResource\RelationManagers;
use App\Models\Jemaah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaahResource extends Resource
{
    protected static ?string $model = Jemaah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_ktp')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kelamin')
                    ->required()
                    ->maxLength(1),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_hp')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('foto_ktp')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('nama_passport')
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_passport')
                    ->maxLength(20),
                Forms\Components\TextInput::make('foto_passport')
                    ->maxLength(50),
                Forms\Components\DatePicker::make('berlaku_passport'),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('kelurahan')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kabupaten')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('provinsi')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('status_nikah')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_ktp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelamin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tempat_lahir')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto_ktp')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_passport')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_passport')
                    ->searchable(),
                Tables\Columns\TextColumn::make('foto_passport')
                    ->searchable(),
                Tables\Columns\TextColumn::make('berlaku_passport')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kelurahan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten')
                    ->searchable(),
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status_nikah')
                    ->numeric()
                    ->sortable(),
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJemaahs::route('/'),
            'create' => Pages\CreateJemaah::route('/create'),
            'view' => Pages\ViewJemaah::route('/{record}'),
            'edit' => Pages\EditJemaah::route('/{record}/edit'),
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
