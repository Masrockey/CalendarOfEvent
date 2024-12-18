<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\Widget;
use App\Filament\Resources\EventResource;
use Saade\FilamentFullCalendar\Data\EventData;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    // protected static string $view = 'filament.widgets.calendar-widget';

    public function fetchEvents(array $fetchInfo): array
    {
        return Event::query()
            ->where('starts_at', '>=', $fetchInfo['start'])
            ->where('ends_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Event $event) => EventData::make()
                    ->id($event->id)
                    ->title($event->nama_event)
                    ->start($event->starts_at)
                    ->end($event->ends_at)
                    ->url(
                        url: EventResource::getUrl(name: 'view', parameters: ['record' => $event]),
                        shouldOpenUrlInNewTab: true
                    )
            )
            ->toArray();
    }
}
