<?php namespace App\Http\Controllers;

// Indicamos el modelo a utilizar
use App\Prueba;

class MyController extends Controller
{
	public function index()
	{
		$modelo=new Prueba();
		$saludo= $modelo->saludar("Rafa");

		return view("prueba.index",['saludo'=>$saludo]);
	}


}