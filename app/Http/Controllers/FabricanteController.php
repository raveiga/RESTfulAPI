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

    // Autenticación básica al acceder a FabricanteController
    // solamente para algunos métodos de actualización.
    // Para consulta no se suele hacer generalmente salvo casos específicos.
    public function __construct()
    {
        $this->middleware('auth.basic',['only'=>['store','update','destroy']]);
    }

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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // Recibimos una petición de tipo Request (inyección de dependencias).
         if (!$request->input('nombre') || !$request->input('telefono'))
        {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores','codigo'=>422],422);
        }

        Fabricante::create($request->all());
        // Procedimiento para almacenar.

        return response()->json(['mensaje'=>'Fabricante insertado'],201);
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
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Este método responde tanto a PUT como a PATCH
        // Por medio de Request averiguamos que método estamos usando
        $metodo=$request->method();

        $fabricante=Fabricante::find($id);

        if (!$fabricante)
        {
            return response()->json(['mensaje'=>'No se encuentra este fabricante','codigo'=>404],404);   
        }

        if ($metodo === 'PATCH')
        {
            // Se actualiza alguno de los campos.
            $nombre = $request->input('nombre');

            if ($nombre !=null && $nombre != '')
            {
                $fabricante->nombre=$nombre;
            }

            $telefono=$request->input('telefono');

            if ($telefono !=null && $telefono !='')
            {
                $fabricante->telefono=$telefono;
            }
            
            // Guardamos el registro.
            $fabricante->save();
        
            return response()->json(['mensaje'=>'Fabricante datos actualizados correctamente.'],200);

        }


     // Se actualiza alguno de los campos.
        $nombre = $request->input('nombre');
        $telefono=$request->input('telefono');

        if (!$nombre || !$telefono)
        {
            return response()->json(['mensaje'=>'No se pudieron procesar los valores','codigo'=>422],422);
        }

        $fabricante->nombre=$nombre;
        $fabricante->telefono=$telefono;

        $fabricante->save();

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
    public function destroy($id)
    {
        //
    }
}
