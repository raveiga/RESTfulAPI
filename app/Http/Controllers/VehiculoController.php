<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Vehiculo;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {
        //
        return response()->json(['datos'=>Vehiculo::all()],200);

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
        $vehiculo = Vehiculo::find($id);

        // Si no se encuentra el vehiculo devuelve un JSON y 404 http.
        if (!$vehiculo)
        {
            return response()->json(['mensaje'=>'No se encuentra este vehiculo','codigo'=>404],404);
        }

        // Si encuentra vehiculos devuelve el JSON con los resultados.
        return response()->json(['datos'=>$vehiculo],200);
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
