<?php

namespace App\Filament\Resources\AppRatingResource\Pages;

use App\Filament\Resources\AppRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAppRating extends CreateRecord
{
    protected static string $resource = AppRatingResource::class;
    protected function getRedirectUrl(): string
    {
    return AppRatingResource::getUrl('index');
    }
}
