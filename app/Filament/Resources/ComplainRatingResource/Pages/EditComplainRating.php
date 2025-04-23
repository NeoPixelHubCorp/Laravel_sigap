<?php

namespace App\Filament\Resources\ComplainRatingResource\Pages;

use App\Filament\Resources\ComplainRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplainRating extends EditRecord
{
    protected static string $resource = ComplainRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
            protected function getRedirectUrl(): string
    {
    return ComplainRatingResource::getUrl('index');
    }
}
