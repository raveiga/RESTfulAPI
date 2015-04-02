<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Fabricante;

use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        //
        $fabricante = Fabricante::find($id);

        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No se encuentra el fabricante','codigo'=>404],404);
        }

        return response()->json(['datos'=>$fabricante->vehiculos()->get()],200);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($id)
    {
        //
        return 'Mostrando formulario para agregar vehículo al fabricante con id '.$id;

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
    public function show($idFabricante,$idVehiculo)
    {
        //
        return "Mostrando vehículo $idVehiculo del fabricante $idFabricante";


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($idFabricante,$idVehiculo)
    {
        //
        return "Mostrando form para editar $idVehiculo del fabricante $idFabricante";

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
