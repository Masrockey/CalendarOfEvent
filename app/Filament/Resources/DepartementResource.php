<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DepartementResource\Pages;
use App\Filament\Resources\DepartementResource\RelationManagers;
use App\Models\Departement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Component;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class DepartementResource extends Resource
{
    protected static ?string $model = Departement::class;

    protected static ?string $navigationIcon = 'heroicon-s-building-office-2';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Setting';

    public static function getModelLabel(): string
    {
        return __('Departement');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Departement');
    }

    public static function getNavigationLabel(): string
    {
        return __('Departement');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    TextInput::make('nama')
                        ->required()
                        ->string()
                        ->autofocus(),

                    RichEditor::make('deskripsi')
                        ->required()
                        ->string()
                        ->fileAttachmentsVisibility('public'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                TextColumn::make('nama'),

                TextColumn::make('deskripsi')->limit(255),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDepartements::route('/'),
            'create' => Pages\CreateDepartement::route('/create'),
            'view' => Pages\ViewDepartement::route('/{record}'),
            'edit' => Pages\EditDepartement::route('/{record}/edit'),
        ];
    }
}
