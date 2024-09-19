<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    //relación polifórmica image
    public function image()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    //atributos
    protected function stockLabel() : Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->attributes['stock'] >= $this->attributes['stock_minimo'] ? '<span class="badge badge-pill badge-success">' . $this->attributes['stock'] . '</span>' : '<span class="badge badge-pill badge-danger">' . $this->attributes['stock'] . '</span>';
            }
        );
    }
}
