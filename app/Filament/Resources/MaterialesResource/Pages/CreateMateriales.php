<?php

namespace App\Filament\Resources\MaterialesResource\Pages;

use App\Filament\Resources\MaterialesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Http\Controllers\MaterialesController;
use Illuminate\Database\Eloquent\Model;

class CreateMateriales extends CreateRecord
{
    protected static string $resource = MaterialesResource::class;

    protected function handleRecordCreation(array $data): Model{
        return app(MaterialesController::class)->store($data);
    }
}
