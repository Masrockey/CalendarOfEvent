<?php

namespace App\Filament\Resources\HasdeptResource\Pages;

use App\Filament\Resources\HasdeptResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewHasdept extends ViewRecord
{
    protected static string $resource = HasdeptResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
