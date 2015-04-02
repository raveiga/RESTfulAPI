<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Fabricante;

use App\Vehiculo;

class FabricanteVehiculoController extends Controller
{
    // Autenticación básica al acceder a FabricanteController
    // solamente para algunos métodos de actualización.
    // Para consulta no se suele hacer generalmente salvo casos específicos.
    public function __construct()
    {
        $this->middleware('auth.basic',['only'=>['store','update','destroy']]);
    }



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
    public function store(Request $request,$id)
    {
        // Necesitamos $id del fabricante que recibimos en la URL.
        // Serie (autoinc)
        // color, cilindraje, potencia y peso
        if (!$request->input('color') || !$request->input('cilindraje') || !$request->input('potencia') || !$request->input('peso'))
        {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores','codigo'=>422],422); 
        }

        // Buscamos el fabricante:
        $fabricante = Fabricante::find($id);

        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No existe el fabricante asociado.','codigo'=>404],404); 
        }

        $fabricante->vehiculos()->create($request->all());

        return  response()->json(['mensaje'=>'Vehiculo insertado correctamente.'],201);
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
    public function update(Request $request,$idFabricante,$idVehiculo)
    {
        // Este método responde tanto a PUT como a PATCH
        // Por medio de Request averiguamos que método estamos usando
        $metodo=$request->method();

        $fabricante=Fabricante::find($idFabricante);

        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante','codigo'=>404],404);   
        }

        $vehiculo = $fabricante->vehiculos()->find($idVehiculo);

        if (!$vehiculo)
        {
            return response()->json(['mensaje'=>'No se encuentra este vehículo asociado a ese fabricante.','codigo'=>404],404);   
        }

        $color=$request->input('color');
        $cilindraje=$request->input('cilindraje');
        $potencia=$request->input('potencia');
        $peso=$request->input('peso');    

        if ($metodo === 'PATCH')
        {
            $bandera=false;

            if ($color !=null && $color != '')
            {
                $vehiculo->color=$color;
                $bandera=true;
            }

            if ($cilindraje !=null && $cilindraje != '')
            {
                $vehiculo->cilindraje=$cilindraje;
                $bandera=true;

            }


            if ($potencia !=null && $potencia != '')
            {
                $vehiculo->potencia=$potencia;
                $bandera=true;

            }

            if ($peso !=null && $peso != '')
            {
                $vehiculo->peso=$peso;
                $bandera=true;

            }

            // Guardamos el registro.
            if ($bandera)
            {
                $vehiculo->save();
                return response()->json(['mensaje'=>'Vehículo editado.'],200);
            }

            // Se podría definir código 304 que indica que no hay necesidad de devolver nada 
            // Y no mostraría nada como resultado.
            // Así que vamos a poner código 200 para leer el mensaje.
            return response()->json(['mensaje'=>'No se modificó ningún vehículo.'],200);

        }


     // Se actualiza alguno de los campos.

        if (!$color || !$cilindraje || !$potencia || !$peso)
        {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores','codigo'=>422],422);
        }


        $vehiculo->color=$color;
        $vehiculo->cilindraje=$cilindraje;
        $vehiculo->potencia=$potencia;
        $vehiculo->peso=$peso;

        $vehiculo->save();

        return response()->json(['mensaje'=>'Fabricante actualizado correctamente.'],200);
        
        // Con PUT se actualiza el registro completo.
        // Se validan todos los campos (nombre, telefono)
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($idFabricante, $idVehiculo)
    {
        //
        $fabricante = Fabricante::find($idFabricante);

        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante','codigo'=>404],404);   

        }
        
        $vehiculo = $fabricante->vehiculos()->find($idVehiculo);

        if (!$vehiculo)
        {
            return response()->json(['mensaje'=>'No se encuentra este vehículo asociado a ese fabricante','codigo'=>404],404);   
        }

        $vehiculo->delete();

        // En estándar http se recomienda código 204 de respuesta, que indica que básicamente no hay nada que devolver.
        // Si queremos devolver el mensaje pondremos entonces un estado 200.
        return response()->json(['mensaje'=>'Vehículo eliminado correctamente.'],204);
    }
}
