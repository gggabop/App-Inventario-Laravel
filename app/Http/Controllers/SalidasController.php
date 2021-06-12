<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salidas;
use App\Blog;
use App\Administradores;
use Illuminate\Support\Facades\DB;
use App\Productos;

class SalidasController extends Controller
{
    public function index(){

        $datosS=DB::table('salidas')
        ->join('productos', function ($join) {
            $join->on('salidas.id_prod', '=', 'productos.id_producto')
                 ->where('salidas.s_eliminado', '<', 1);
        })
        ->get();
		 if(request()->ajax()){

            return datatables()->of($datosS)
            ->addColumn('nombre_producto', function($data){

              $nombre_producto = $data->nombre_producto."-".$data->descripcion_producto."-".$data->serial_producto;

              return $nombre_producto;

            })
            ->addColumn('acciones', function($data){

                $acciones = '<div class="btn-group">
                            <a href="'.url()->current().'/'.$data->id_salida.'" class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </a>
                         
                            <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_salida.'" method="DELETE" token="'.csrf_token().'" pagina="salidas"> 
                            <i class="fas fa-trash-alt"></i>
                            </button>

                          </div>';
               
                return $acciones;

            })
            ->rawColumns(['nombre_producto','acciones'])
            ->make(true);

        };

		$blog = Blog::all();
		$administradores = Administradores::all();
        $productos = Productos::where('p_eliminado', 0)->get();

		return view("paginas.salidas", array("blog"=>$blog, "administradores"=>$administradores, "productos"=>$productos));

	}
    /*=============================================
    Crear un registro
    =============================================*/

    public function store(Request $request){

        // Recoger los datos

        $datos = array( "id_prod"=>$request->input("id_prod"),
                        "fecha_salida"=>$request->input("fecha_salida"),
                        "cantidad_salida"=>$request->input("cantidad_salida"),
                        "actualizar_cantidad"=>$request->input("actualizar_cantidad"));  

        // Recoger datos de la BD blog para las rutas de imágenes 
        $blog = Blog::all();

         // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
            $validar = \Validator::make($datos,[

                "id_prod" => 'required|unique:salidas',
                "fecha_salida" => 'required',
                "cantidad_salida" => 'required|regex:/^[0-9]+$/i'
         
            ]);

            //Guardar artículo

            if($validar->fails()){
   
                return redirect("salidas")->with("no-validacion", "");

            }else{

           
                $salidas = new Salidas();
                $salidas->id_prod = $datos["id_prod"];
                $salidas->fecha_salida= $datos["fecha_salida"];
                $salidas->cantidad_salida= $datos["cantidad_salida"];

                $salidas->save();

                $actualizar = array("cantidad_producto" => $datos["actualizar_cantidad"]);

                $producto = Productos::where('id_producto', $datos["id_prod"])->update($actualizar); 

                return redirect("salidas")->with("ok-crear", "");
            }

        }else{
         
            return redirect("salidas")->with("error", "");

        }

    }
        public function show($id){    

        $salidas = Salidas::where('id_salida', $id)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();
        $productos = Productos::where('p_eliminado', 0)->get();

        if(count($salidas) != 0){

            return view("paginas.salidas", array("status"=>200, "salida"=>$salidas, "blog"=>$blog, "administradores"=>$administradores, "productos"=>$productos));
        
        }else{
            
            return view("paginas.salidas", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));
        
        }

    }
    public function update($id, Request $request){

        // Recoger los datos

        $datos = array( "id_prod"=>$request->input("id_prod"),
                        "fecha_salida"=>$request->input("fecha_salida"),
                        "cantidad_salida"=>$request->input("cantidad_salida"),
                        "actualizar_cantidad"=>$request->input("actualizar_cantidad"));

        // Recoger datos de la BD blog para las rutas de imágenes 

        $blog = Blog::all();

         // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
            $validar = \Validator::make($datos,[

                "id_prod" => 'required',
                "fecha_salida" => 'required',
                "cantidad_salida" => 'required|regex:/^[0-9]+$/i'
         
            ]);


            //Guardar salida

            if($validar->fails()){
   
                return redirect("/salidas")->with("no-validacion", "");

            }else{

                $cant = $datos["actualizar_cantidad"];
           
                $datos = array("id_prod" => $datos["id_prod"],
                               "fecha_salida" => $datos["fecha_salida"],
                               "cantidad_salida" => $datos["cantidad_salida"]);

                $salida = Salidas::where('id_salida', $id)->update($datos); 

                $actualizar = array("cantidad_producto" => $cant);

                $producto = Productos::where('id_producto', $datos["id_prod"])->update($actualizar);

                return redirect("/salidas")->with("ok-crear", "");
            }

        }else{
         
            return redirect("/salidas")->with("error", "");

        }

    }

        public function destroy($id, Request $request){

        $validar = Salidas::where("id_salida", $id)->get();
        
        if(!empty($validar)){
            $eliminar = array('s_eliminado' => 1);
            $salida = Salidas::where("id_salida",$validar[0]["id_salida"])->update($eliminar);

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("salidas")->with("no-borrar", "");

        }

    }
    public function all(Request $request){
        $productos = DB::table('productos')
         ->select('productos.*')
         ->orderBy('id_producto','DESC')
         ->get();
         return response(json_encode($productos),200)->header('Content-type','text/plain');
    }

}
