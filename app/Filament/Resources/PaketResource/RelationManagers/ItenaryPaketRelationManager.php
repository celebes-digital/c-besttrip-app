<?php

namespace App\Filament\Resources\PaketResource\RelationManagers;

use App\Filament\Resources\PaketResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ItenaryPaketRelationManager extends RelationManager
{
    protected static string $relationship   = 'itenaryPakets';
    protected static ?string $title         = 'Itenary';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Buat dinamis dengan tambah ke setting untuk jumlah hari
                Forms\Components\Select::make('hari_ke')
                    ->options(PaketResource::getHari())
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('kegiatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Intenary Paket')
            ->recordTitleAttribute('kegiatan')
            ->columns([
                Tables\Columns\SelectColumn::make('hari_ke')
                    ->grow(false)
                    ->extraAttributes([
                        'class' => 'min-w-[150px]',
                    ])
                    ->options(PaketResource::getHari()),
                Tables\Columns\TextColumn::make('kegiatan')
                    ->grow(),
            ])
            ->paginated(false)
            ->defaultSort('hari_ke', 'asc')
            ->filters([])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah Itenary'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
