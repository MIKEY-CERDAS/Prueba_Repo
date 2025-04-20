<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrito extends Model
{
    protected $fillable = ['usuarioId', 'materialId', 'cantidad', 'total'];

    public function materiales(): BelongsTo{
        return $this->belongsTo(Materiales::class);
    }

    public function usuarios(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
