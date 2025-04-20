<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materiales extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'cantidad', 'precio'];
    
    public function detallePedidos(): HasMany{
        return $this->hasMany(DetallePedidos::class);
    }

    public function carrito(): HasMany{
        return $this->hasMany(Carrito::class);
    }
}
