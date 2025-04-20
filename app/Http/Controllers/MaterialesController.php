<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Materiales;

class MaterialesController extends Controller
{
    public function store(array $data){
        $validator = Validator::make($data, [
            'nombre'=>'required',
            'descripcion'=>'required',
            'cantidad'=>'required|numeric',
            'precio'=>'required|numeric'
        ]);

        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->toArray());
        }

        return Materiales::create($validator->validated());
    }
}