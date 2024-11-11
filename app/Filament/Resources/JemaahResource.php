<?php

namespace App\Filament\Resources;

use App\Models\Jemaah;
use App\Filament\Resources\JemaahResource\Pages;
use App\Filament\Resources\JemaahResource\RelationManagers;
use App\Models\Paket;
use Filament\Resources\Resource;

use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Components\Tabs;

use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaahResource extends Resource
{
    protected static ?string $model             = Jemaah::class;
    protected static ?string $modelLabel        = 'Manajemen Jemaah';
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
                    ->searchable()
                    ->placeholder('No email')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('kelamin')
                    ->label('Jenis Kelamin')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'l' => 'Laki-laki',
                            'p' => 'Perempuan',
                            default => $state,
                        };
                    }),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->formatStateUsing(fn($state) => $state->format('d F Y')),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status_nikah')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            0 => 'Belum Menikah',
                            1 => 'Menikah',
                            2 => 'Cerai',
                            default => $state,
                        };
                    }),
                // Tables\Columns\TextColumn::make('deleted_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->recordUrl(
                fn(Model $record): string => JemaahResource::getUrl('view', ['record' => $record]),
            )
            ->actions([
                // Tables\Actions\ViewAction::make()
                //     ->iconButton(),
                Tables\Actions\EditAction::make()
                    ->color('warning'),
                Tables\Actions\DeleteAction::make()
                    ->iconButton(),
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
                    ->mask('9999 9999 9999 9999')
                    ->stripCharacters(' ')
                    ->length(16)
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->prefixIcon('heroicon-s-calendar')
                    ->displayFormat('d F Y')
                    ->placeholder('Pilih tanggal')
                    ->maxDate(now()->subMonths(6))
                    ->closeOnDateSelection()
                    ->native(false)
                    ->required(),
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
                    ->prefix('+62')
                    ->mask('9999 9999 9999')
                    ->stripCharacters(' ')
                    ->minLength(10)
                    ->required()
                    ->maxLength(13),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->helperText('Gunakan email yang aktif jika ada')
                    ->hint('Opsional')
                    ->hintColor('success')
                    ->maxLength(100),
            ]);
    }

    public static function getAlamatFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Alamat')
            ->schema([
                Forms\Components\TextInput::make('alamat')
                    ->label('Alamat Lengkap')
                    ->helperText('Alamat lengkap sesuai KTP')
                    ->required()
                    ->columnSpan([
                        'sm' => 2
                    ])
                    ->maxLength(100),
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('rt')
                        ->label('RT')
                        ->mask('999')
                        ->helperText('Contoh: 003')
                        ->length(3)
                        ->required(),
                    Forms\Components\TextInput::make('rw')
                        ->label('RW')
                        ->mask('999')
                        ->helperText('Contoh: 003')
                        ->length(3)
                        ->required(),
                ])
                ->columns([
                    'default' => 2,
                    'sm' => 2,
                    'md' => 2,
                ])
                ->columnSpan([
                    'sm' => 2,
                    'md' => 2,
                ]),
                Forms\Components\TextInput::make('provinsi')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kabupaten')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('kelurahan')
                    ->required()
                    ->maxLength(50),
            ])
            ->columns([
                'md' => 2,
                'lg' => 4,
            ]);
    }

    public static function getPasporFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Paspor')
            ->schema([
                Forms\Components\TextInput::make('nama_paspor')
                    ->maxLength(100)
                    ->live(onBlur: true)
                    ->columnSpan([
                        'sm' => 2
                    ]),
                Forms\Components\TextInput::make('no_paspor')
                    ->label('Nomor Paspor')
                    ->required(fn(Get $get) => !empty($get('nama_paspor')))
                    ->maxLength(20),
                Forms\Components\DatePicker::make('berlaku_paspor')
                    ->native(false)
                    ->closeOnDateSelection()
                    ->minDate(now())
                    ->placeholder('Pilih tanggal')
                    ->required(fn(Get $get) => !empty($get('nama_paspor')))
                    ->displayFormat('d F Y'),
            ])
            ->columns([
                'sm' => 2,
                'lg' => 4,
            ]);
    }

    public static function getDokumenPendukungFormField(): Forms\Components\Fieldset
    {
        return Forms\Components\Fieldset::make('Dokumen Pendukung')
            ->schema([
                Forms\Components\FileUpload::make('foto_ktp')
                    ->label('Foto KTP')
                    ->image()
                    ->directory('foto/ktp')
                    ->imageEditor()
                    ->required(),
                Forms\Components\FileUpload::make('foto_paspor')
                    ->label('Foto Paspor')
                    ->image()
                    ->directory('foto/paspor')
                    ->required(fn(Get $get) => !empty($get('nama_paspor'))),
            ]);
    }

    public static function getSetoranAwalFormField(): Forms\Components\Wizard\Step
    {
        return Forms\Components\Wizard\Step::make('Setoran Awal')
            ->schema([
                Forms\Components\FileUpload::make('bukti_setor')
                    ->label('Bukti Setoran Awal')
                    ->required()
                    ->image()
                    ->directory('foto/bukti-setor'),
                Forms\Components\Select::make('nominal')
                    ->label('Setoran Awal')
                    ->required()
                    ->options(
                        function (Get $get) {
                            $hargaPaket = Paket::find($get('paket_id'));

                            return [
                                '5000000'               => 'IDR 5.000.000',
                                '10000000'              => 'IDR 10.000.000',
                                $hargaPaket?->harga ?? 0=> h_format_currency($hargaPaket?->harga ?? 0) . ' (Lunas)',
                            ];
                        }
                    )
                    ->native(false)
            ])
            ->columns([
                'md' => 2,
            ])
            ->icon('heroicon-o-banknotes')
            ->completedIcon('heroicon-o-document-check');
    }
}
