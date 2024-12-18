<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HasdeptResource\Pages;
use App\Filament\Resources\HasdeptResource\RelationManagers;
use App\Models\Hasdept;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class HasdeptResource extends Resource
{
    protected static ?string $model = Hasdept::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office-2';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Setting';

    public static function getModelLabel(): string
    {
        return __('Pilih Department');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Pilih Department');
    }

    public static function getNavigationLabel(): string
    {
        return __('Pilih Department');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    Select::make('user_id')
                        ->required()
                        ->relationship('user', 'name')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    Select::make('departement_id')
                        ->required()
                        ->relationship('departement', 'nama')
                        ->searchable()
                        ->preload()
                        ->native(false),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('user.name'),

                TextColumn::make('departement.nama'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
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
            'index' => Pages\ListHasdepts::route('/'),
            'create' => Pages\CreateHasdept::route('/create'),
            'view' => Pages\ViewHasdept::route('/{record}'),
            'edit' => Pages\EditHasdept::route('/{record}/edit'),
        ];
    }
}
