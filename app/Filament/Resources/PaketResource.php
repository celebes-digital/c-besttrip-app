<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaketResource\Pages;
use App\Filament\Resources\PaketResource\RelationManagers;

use App\Models\Paket;

use Filament\Resources\Resource;
use Filament\Forms;
use Filament\Tables;
use Filament\Support\RawJs;

use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

class PaketResource extends Resource
{
    protected static ?string $model             = Paket::class;
    protected static ?string $modelLabel        = 'Manajemen Paket';
    protected static ?string $navigationIcon    = 'heroicon-o-squares-plus';
    protected static ?string $slug              = 'paket';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Informasi Paket')
                    ->columns([
                        'md' => 7,
                        'lg' => 7,
                    ])
                    ->schema([
                        Forms\Components\FileUpload::make('foto')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                            ])
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('foto/paket')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('nama_paket')
                            ->required()
                            ->columnSpan([
                                'md' => 3,
                                'lg' => 3,
                            ])
                            ->maxLength(50),
                        Forms\Components\TextInput::make('deskripsi')
                            ->columnSpan([
                                'md' => 3,
                                'lg' => 3,
                            ])
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->inline(false)
                            ->default(true),
                        Forms\Components\Group::make([
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
                            Forms\Components\TextInput::make('kuota')
                                ->required()
                                ->minValue(1)
                                ->numeric()
                                ->prefixIcon('heroicon-o-user-group')
                                ->prefixIconColor('primary'),
                            Forms\Components\DatePicker::make('tgl_paket')
                                ->label('Tanggal Paket')
                                ->native(false)
                                ->displayFormat('d F Y')
                                ->prefixIcon('heroicon-o-calendar')
                                ->prefixIconColor('primary')
                                ->required(),
                            Forms\Components\TextInput::make('no_wa_admin')
                                ->label('No. WA Admin')
                                ->prefixIcon('heroicon-o-phone')
                                ->prefixIconColor('primary')
                                ->maxLength(20),
                        ])
                        ->columnSpanFull()
                        ->columns([
                            'md' => 2,
                            'lg' => 4,
                        ]),
                    ]),
                    Forms\Components\Tabs\Tab::make('Itenary Paket')
                    ->schema([
                    Forms\Components\Repeater::make('itenary_pakets')
                        ->relationship('itenaryPakets')
                        ->columns(7)
                        ->label('')
                        ->defaultItems(0)
                        ->addActionLabel('Tambah Itenary')
                        ->schema([
                            Forms\Components\Select::make('hari_ke')
                                ->options(static::getHari())
                                ->native(false)
                                ->columnSpan(2)
                                ->live()
                                ->label('')
                                ->required(),
                            Forms\Components\TextInput::make('kegiatan')
                                ->hiddenLabel()
                                ->columnSpan(5)
                                ->extraAttributes(['class' => 'w-full'])
                                ->maxLength(255)
                                ->required(),
                        ])
                        ->itemLabel(
                            fn(array $state): ?string 
                            => $state['hari_ke'] 
                                ? ('Hari ke-' . $state['hari_ke']) 
                                : 'Tentukan hari dan kegiatan'
                            ),
                    ])
                ])
            ])
            ->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                // Tables\Columns\ImageColumn::make('foto')
                //     ->grow(false),
                Tables\Columns\TextColumn::make('nama_paket')
                    ->grow(true)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kuota')
                    ->numeric()
                    ->formatStateUsing(
                        fn ($state, Paket $record) 
                        => $record
                            ->jemaahs()
                            ->whereNull('jemaah.deleted_at')->count() . '/' . $state
                        )
                    ->sortable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(25),
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
            ])
            ->defaultSort('updated_at', 'desc')
            ->recordUrl(
                fn(Model $record): string => PaketResource::getUrl('view', ['record' => $record]),
            )
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
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
        return [
            RelationManagers\JemaahsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'     => Pages\ListPakets::route('/'),
            'create'    => Pages\CreatePaket::route('/create'),
            'view'      => Pages\ViewPaket::route('/{record}'),
            'edit'      => Pages\EditPaket::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                Eloquent\SoftDeletingScope::class,
            ]);
    }

    public static function getHari(): array
    {
        return [
            1 => 'Hari 1',
            2 => 'Hari 2',
            3 => 'Hari 3',
            4 => 'Hari 4',
            5 => 'Hari 5',
            6 => 'Hari 6',
            7 => 'Hari 7',
            8 => 'Hari 8',
            9 => 'Hari 9',
            10 => 'Hari 10',
            11 => 'Hari 11',
            12 => 'Hari 12',
            13 => 'Hari 13',
            14 => 'Hari 14',
            15 => 'Hari 15',
            16 => 'Hari 16',
            17 => 'Hari 17',
            18 => 'Hari 18',
            19 => 'Hari 19',
            20 => 'Hari 20',
            21 => 'Hari 21',
            22 => 'Hari 22',
            23 => 'Hari 23',
        ];
    }
}
