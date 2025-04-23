<?php

namespace App\Filament\Resources\ComplainRatingResource\Pages;

use App\Filament\Resources\ComplainRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplainRatings extends ListRecords
{
    protected static string $resource = ComplainRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
