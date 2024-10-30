<?php

namespace App\Filament\Resources;

use App\Models\Jemaah;
use App\Filament\Resources\JemaahResource\Pages;
use App\Filament\Resources\JemaahResource\RelationManagers;

use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Components\Tabs;

use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaahResource extends Resource
{
    protected static ?string $model             = Jemaah::class;
    protected static ?string $navigationIcon    = 'heroicon-o-identification';
    protected static ?string $slug              = 'jemaah';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()
                    ->tabs([
                        Tabs\Tab::make('Data Utama') 
                            ->schema([
                            JemaahResource::getDataPribadiFormField(),
                            JemaahResource::getKontakFormField(),
                            JemaahResource::getAlamatFormField(),
                        ]),
                        Tabs\Tab::make('Data Pendukung')
                            ->schema([
                            JemaahResource::getPasporFormField(),
                            JemaahResource::getDokumenPendukungFormField(),
                        ]),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_ktp')
                    ->label('Nama (KTP)')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_hp')
                    ->label('Nomor Telepon')
                    ->grow(false)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->grow()
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'     => Pages\ListJemaahs::route('/'),
            'create'    => Pages\CreateJemaah::route('/create'),
            'view'      => Pages\ViewJemaah::route('/{record}'),
            'edit'      => Pages\EditJemaah::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getDataPribadiFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Data Pribadi')
        ->schema([
            Forms\Components\TextInput::make('nama_ktp')
            ->label('Nama Sesuai KTP')
            ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('nik')
                ->label('Nomor Induk Kependudukan')
                ->helperText('NIK terdapat pada KTP atau KK')
                ->required()
                ->maxLength(20),
            Forms\Components\DatePicker::make('tanggal_lahir')
                ->prefixIcon('heroicon-s-calendar')
                ->native(false)
                ->required(),
            Forms\Components\TextInput::make('tempat_lahir')
                ->required()
                ->maxLength(100),
            Forms\Components\Select::make('kelamin')
                ->label('Jenis Kelamin')
                ->options([
                    'l' => 'Laki-laki',
                    'p' => 'Perempuan',
                ])
                ->native(false)
                ->required(),
            Forms\Components\Select::make('status_nikah')
                ->options([
                    '0' => 'Belum Menikah',
                    '1' => 'Menikah',
                    '2' => 'Cerai',
                ])
                ->native(false)
                ->required(),
        ]);
    }

    public static function getKontakFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Kontak')
        ->schema([
            Forms\Components\TextInput::make('no_hp')
            ->label('Nomor Telepon')
            ->helperText('Gunakan nomor yang aktif whatsapp')
            ->required()
                ->maxLength(20),
            Forms\Components\TextInput::make('email')
            ->email()
                ->helperText('Gunakan email yang aktif jika ada')
                ->maxLength(100),
        ]);
    }

    public static function getAlamatFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Alamat')
            ->schema([
                Forms\Components\TextInput::make('alamat')
                ->label('Alamat Lengkap')
                ->required()
                    ->columnSpan(2)
                    ->maxLength(100),
                Forms\Components\TextInput::make('kelurahan')
                ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('provinsi')
                ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kabupaten')
                ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kecamatan')
                ->required()
                    ->maxLength(50),
            ])
            ->columns(3);
    }

    public static function getPasporFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Paspor')
        ->schema([
            Forms\Components\TextInput::make('nama_paspor')
            ->maxLength(100)
                ->live(onBlur: true)
                ->columnSpan(2),
            Forms\Components\TextInput::make('no_paspor')
            ->label('Nomor Paspor')
            ->required(fn(Get $get) => !empty($get('nama_paspor')))
            ->maxLength(20),
            Forms\Components\DatePicker::make('berlaku_paspor')
            ->native(false)
                ->required(fn(Get $get) => !empty($get('nama_paspor')))
                ->displayFormat('d F Y'),
        ])
            ->columns(4);
    }

    public static function getDokumenPendukungFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Dokumen Pendukung')
        ->schema([
            Forms\Components\FileUpload::make('foto_ktp')
            ->label('Foto KTP')
            ->image()
                ->directory('foto/ktp')
                ->required(),
            Forms\Components\FileUpload::make('foto_paspor')
            ->label('Foto Paspor')
            ->image()
                ->directory('foto/paspor')
                ->required(fn(Get $get) => !empty($get('nama_paspor'))),
        ]);
    }
}