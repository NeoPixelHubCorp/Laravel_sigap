<?php

namespace App\Filament\Resources\AppRatingResource\Pages;

use App\Filament\Resources\AppRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppRating extends EditRecord
{
    protected static string $resource = AppRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
    return AppRatingResource::getUrl('index');
    }
}
