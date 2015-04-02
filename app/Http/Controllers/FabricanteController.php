<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Fabricante;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Devuelve todos los fabricantes en JSON.
        // return Fabricante::all();
        
        // Mejora en la respuesta.
        // Devolvemos explícitamente el código 200 http de datos encontrados.
        // Se puede poner como 404 cuando no se encuentra nada.
        return response()->json(['datos'=>Fabricante::all()],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return 'mostrando formulario para crear fabricante';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Devuelve un fabricante en base a su ID.
        //return 'Mostrando fabricante con id '.$id;
        $fabricante = Fabricante::find($id);

        // Si no se encuentra el fabricante devuelve un JSON y 404 http.
        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante','codigo'=>404],404);
        }

        // Si encuentra fabricantes devuelve el JSON con los resultados.
        return response()->json(['datos'=>$fabricante],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return 'Mostrando formulario editar fabricante con id '.$id;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
