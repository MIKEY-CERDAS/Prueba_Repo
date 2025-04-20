<?php

namespace App\Filament\Resources\CarritoResource\Pages;

use App\Filament\Resources\CarritoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Materiales;
use App\Models\Carrito;
use Illuminate\Database\Eloquent\Model;

class CreateCarrito extends CreateRecord
{
    protected static string $resource = CarritoResource::class;

    public function mount(): void{
        parent::mount();

        $materialId = request()->query('material');

        $this->form->fill([
            'materialId' => $materialId,
        ]);
    }


    protected function beforeCreate(): void{
        $data = $this->form->getState();

        $material = Materiales::find($data['materialId']);

        $carritoExistente = Carrito::where('materialId', $material->id)->where('usuarioId', auth()->id())->first();

        if ($carritoExistente) {
            $nuevaCantidad = $carritoExistente->cantidad + $data['cantidad'];
            $nuevoTotal = $material->precio * $nuevaCantidad;

            $carritoExistente->update([
                'cantidad'=>$nuevaCantidad,
                'total'=>$nuevoTotal,
            ]);
        } else {
            Carrito::create([
                'materialId' => $data['materialId'],
                'usuarioId' => auth()->id(),
                'cantidad' => $data['cantidad'],
                'total' => $material->precio * $data['cantidad'],
            ]);
        }
        
        $this->redirect(CarritoResource::getUrl('index'), navigate: true);
        $this->halt();
    }

    protected function getRedirectUrl(): string
    {
        return CarritoResource::getUrl('index');
    }
}
