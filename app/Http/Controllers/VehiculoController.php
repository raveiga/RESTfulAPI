<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    public function showAll()
    {
        // Mostrando todos los vehículos
        return 'mostrando todos los vehículos';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id)
    {
        //
        return 'Mostrando vehículos del fabricante con id '.$id;

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
