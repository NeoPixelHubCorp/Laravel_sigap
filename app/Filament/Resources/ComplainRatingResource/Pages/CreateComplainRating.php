<?php

namespace App\Filament\Resources\ComplainRatingResource\Pages;

use App\Filament\Resources\ComplainRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateComplainRating extends CreateRecord
{
    protected static string $resource = ComplainRatingResource::class;
        protected function getRedirectUrl(): string
    {
    return ComplainRatingResource::getUrl('index');
    }
}
