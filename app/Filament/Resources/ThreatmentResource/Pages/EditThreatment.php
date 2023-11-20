<?php

namespace App\Filament\Resources\ThreatmentResource\Pages;

use App\Filament\Resources\ThreatmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditThreatment extends EditRecord
{
    protected static string $resource = ThreatmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
