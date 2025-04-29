<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrabajadoresController
{
   public function index()
   {
    return view("Trabajadores.index");
   }
   public function create()
   {
      return view('Trabajadores.create');
   }
}
