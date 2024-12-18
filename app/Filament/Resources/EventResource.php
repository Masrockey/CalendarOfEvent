<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Filament\Resources\EventResource\RelationManagers;
use App\Models\Event;
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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-s-calendar';

    protected static ?int $navigationSort = 1;

    public static function getModelLabel(): string
    {
        return __('Event');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Event');
    }

    public static function getNavigationLabel(): string
    {
        return __('Event');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 1])->schema([
                    Select::make('hasdept_id')
                        ->label('Pilih Department')
                        ->required()
                        ->relationship('hasdept.departement', 'nama')
                        ->searchable()
                        ->preload()
                        ->native(false),

                    TextInput::make('nama_event')
                        ->label('Nama Event')
                        ->required()
                        ->string(),

                    RichEditor::make('deskripsi_event')
                        ->label('Deskripsi Event')
                        ->required()
                        ->string(),

                    RichEditor::make('lokasi_event')
                        ->label('Lokasi Event')
                        ->required()
                        ->string(),

                    TextInput::make('pic')
                        ->label('PIC')
                        ->required()
                        ->string(),

                    TextInput::make('nohp_pic')
                        ->label('Nomor Hp PIC')
                        ->required()
                        ->string(),

                    DateTimePicker::make('starts_at')
                        ->label('Tanggal Mulai Event')
                        ->required()
                        ->native(false),

                    DateTimePicker::make('ends_at')
                        ->label('Tanggal Selesai Event')
                        ->required()
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
                TextColumn::make('hasdept.created_at')
                ->label('Departement'),

                TextColumn::make('nama_event')
                ->label('Nama Event')
                ->limit(255),

                TextColumn::make('deskripsi_event')
                ->label('Deskripsi Event')
                ->html()
                ->limit(255),

                TextColumn::make('lokasi_event')
                ->label('Lokasi Event')
                ->html()
                ->limit(255),

                TextColumn::make('pic')
                ->label('PIC'),

                TextColumn::make('nohp_pic')
                ->label('Nomor Hp PIC'),

                TextColumn::make('starts_at')
                ->label('Tanggal Mulai Event'),

                TextColumn::make('ends_at')
                ->label('Tanggal Selesai Event'),
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
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'view' => Pages\ViewEvent::route('/{record}'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
