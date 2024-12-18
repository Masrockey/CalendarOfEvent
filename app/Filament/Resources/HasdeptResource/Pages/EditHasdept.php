<?php

namespace App\Filament\Resources\HasdeptResource\Pages;

use App\Filament\Resources\HasdeptResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHasdept extends EditRecord
{
    protected static string $resource = HasdeptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
