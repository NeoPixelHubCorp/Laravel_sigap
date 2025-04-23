<?php

namespace App\Filament\Resources\AppRatingResource\Pages;

use App\Filament\Resources\AppRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppRatings extends ListRecords
{
    protected static string $resource = AppRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
