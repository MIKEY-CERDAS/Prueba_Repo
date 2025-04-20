<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedidos extends Model
{
    protected $fillable = ['usuarioId', 'fecha'];

    public function usuarios(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function detallePedidos(): HasMany{
        return $this->hasMany(DetallePedidos::class);
    }
}
