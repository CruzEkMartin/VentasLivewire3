<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    //se crea la relación con la tabla de users, se debe especificar en user esta relación
    public function user(){
        return $this->belongsTo(User::class);
    }

    //se crea la relación con la tabla de clients, se debe especificar en Clients esta relación
    public function client(){
        return $this->belongsTo(Client::class);
    }

    //se crea la relación con la tabla de items, se debe especificar en Items esta relación
    public function items(){
        return $this->belongsToMany(Item::class);
    }


}
