<?php

//devuelve el id del usuario autenticado

use App\Models\NumerosEnLetras;

function userID(){
    return auth()->user()->id;
}



//devuelve un número en formato de moneda
function money($number){
    return '$ '. number_format($number,2,'.',',');
}


//convertir numero a letras
function numerosLetras($number){
return NumerosEnLetras::convertir($number, 'pesos',false, 'centavos');
}


//verifica si es admin
function isAdmin(){
    return auth()->user()->admin;
}
