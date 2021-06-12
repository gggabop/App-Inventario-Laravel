<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Productos;
use App\Blog;
use App\Administradores;
use Illuminate\Support\Facades\DB;
use App\Distribuidores;
use App\Entregas;

class ProductosController extends Controller
{
    public function index(){
		
    	 $datosP=DB::table('productos')
        ->join('distribuidores', function ($join) {
            $join->on('productos.id_dist', '=', 'distribuidores.id_distribuidor')
                 ->where('productos.p_eliminado', '<', 1);
        })
        ->join('entregas', function ($join) {
            $join->on('productos.id_lote', '=', 'entregas.id_entrega')
                 ->where('productos.p_eliminado', '<', 1);
        })
        ->get();
        if(request()->ajax()){
            return datatables()->of($datosP)
            ->addColumn('nombre_distribuidor', function($data){

              $nombre_distribuidor = $data->nombre_organizacion;

              return $nombre_distribuidor;

            })
            ->addColumn('serial_entrega', function($data){

              $serial_entrega = $data->serial_entrega;

              return $serial_entrega;

            })
            ->addColumn('acciones', function($data){

                $botones = '<div class="btn-group">
                            <a href="'.url()->current().'/'.$data->id_producto.'" class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </a>

                            <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_producto.'" method="DELETE" token="'.csrf_token().'" pagina="productos"> <i class="fas fa-trash-alt"></i></button>

                          </div>';
               
                return $botones;

            })
            ->rawColumns(['nombre_distribuidor','serial_entrega','acciones'])
            ->make(true);

        }

		$blog = Blog::all();
        $administradores = Administradores::all();
        $distribuidores = Distribuidores::where('d_eliminado', 0)->get();
        $entregas = Entregas::where('e_eliminado', 0)->get();

        return view("paginas.productos", array("blog"=>$blog, "entregas"=>$entregas, "administradores"=>$administradores, "distribuidores"=>$distribuidores));
	}

	/*=============================================
    Crear un registro
    =============================================*/

    public function store(Request $request){

        // Recoger los datos

        $datos = array("id_dist"=>$request->input("id_dist"),
                        "id_lote"=>$request->input("id_lote"),
                        "nombre_producto"=>$request->input("nombre_producto"),
                        "descripcion_producto"=>$request->input("descripcion_producto"),
                        "tipo_producto"=>$request->input("tipo_producto"),
                        "peso_producto"=>$request->input("peso_producto"),
                        "extension_peso"=>$request->input("extension_peso"),
                        "valor_producto"=>$request->input("valor_producto"),
                        "serial_producto"=>$request->input("serial_producto"),
                        "cantidad_producto"=>$request->input("cantidad_producto"),
                        "fecha_vencimiento"=>$request->input("fecha_vencimiento"),
                        "fecha_elaboracion"=>$request->input("fecha_elaboracion"));  

        // Recoger datos de la BD blog para las rutas de imágenes 

        $blog = Blog::all();

         // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
            $validar = \Validator::make($datos,[

                "nombre_producto" => "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion_producto" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i' ,
                "tipo_producto" => 'required',
                "peso_producto" => "required|regex:/^[a-z0-9]+$/i",
                "extension_peso" => "required",
                "valor_producto" => "required|regex:/^[.\\,\\0-9]+$/i",
                "serial_producto" => 'required|regex:/^[0-9a-zA-Z]+$/i|unique:productos',
                "cantidad_producto" => "required|regex:/^[0-9]+$/i",
                "fecha_vencimiento" => 'required',
                "fecha_elaboracion" => 'required'
         
            ]);

            //Guardar artículo

            if($validar->fails()){
   
                return redirect("productos")->with("no-validacion", "");

            }else{
           
                $producto = new Productos();
                $producto->id_dist = $datos["id_dist"];
                $producto->id_lote = $datos["id_lote"];
                $producto->nombre_producto = $datos["nombre_producto"];
                $producto->descripcion_producto = $datos["descripcion_producto"];
                $producto->tipo_producto = $datos["tipo_producto"];
                $producto->peso_producto = $datos["peso_producto"].$datos["extension_peso"];
                $producto->valor_producto = $datos["valor_producto"];
                $producto->serial_producto = $datos["serial_producto"];
                $producto->cantidad_producto = $datos["cantidad_producto"];
                $producto->fecha_vencimiento = $datos["fecha_vencimiento"];
                $producto->fecha_elaboracion = $datos["fecha_elaboracion"];



                $producto->save();    

                return redirect("productos")->with("ok-crear", "");
            }

        }else{
         
            return redirect("productos")->with("error", "");

        }

    }

    /*=============================================
    Mostrar un solo registro
    =============================================*/

    public function show($id){    

        $productos = Productos::where('id_producto', $id)->get();
        $distribuidores = Distribuidores::where('d_eliminado', 0)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();
        $entregas = Entregas::where('e_eliminado', 0)->get();

        if(count($productos) != 0){

            return view("paginas.productos", array("status"=>200, "producto"=>$productos, "entregas"=>$entregas, "distribuidores"=>$distribuidores, "blog"=>$blog, "administradores"=>$administradores));
        
        }else{
            
            return view("paginas.productos", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));
        
        }

    }

    /*=============================================
    Editar un registro
    =============================================*/

    public function update($id, Request $request){

        // Recoger los datos

        $datos = array("id_dist"=>$request->input("id_dist"),
                        "id_lote"=>$request->input("id_lote"),
                        "nombre_producto"=>$request->input("nombre_producto"),
                        "descripcion_producto"=>$request->input("descripcion_producto"),
                        "tipo_producto"=>$request->input("tipo_producto"),
                        "peso_producto"=>$request->input("peso_producto"),
                        "extension_peso"=>$request->input("extension_peso"),
                        "valor_producto"=>$request->input("valor_producto"),
                        "serial_producto"=>$request->input("serial_producto"),
                        "cantidad_producto"=>$request->input("cantidad_producto"),
                        "fecha_vencimiento"=>$request->input("fecha_vencimiento"),
                        "fecha_elaboracion"=>$request->input("fecha_elaboracion"));   

        // Recoger datos de la BD blog para las rutas de imágenes 

        $blog = Blog::all();

        // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
           $validar = \Validator::make($datos,[

                "nombre_producto" => "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion_producto" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i' ,
                "tipo_producto" => 'required',
                "peso_producto" => "required|regex:/^[a-z0-9]+$/i",
                "extension_peso" => "required",
                "valor_producto" => "required|regex:/^[.\\,\\0-9]+$/i",
                "serial_producto" => 'required|regex:/^[0-9a-zA-Z]+$/i',
                "cantidad_producto" => "required|regex:/^[0-9]+$/i",
                "fecha_vencimiento" => 'required',
                "fecha_elaboracion" => 'required'
         
            ]);

            //Guardar producto

            if($validar->fails()){
               
                return redirect("productos")->with("no-validacion", "");

            }else{

                $datos = array("id_dist" => $datos["id_dist"],
                                "id_lote" => $datos["id_lote"],
                                "nombre_producto" => $datos["nombre_producto"],
                                "descripcion_producto" => $datos["descripcion_producto"],
                                "tipo_producto" => $datos["tipo_producto"],
                                "peso_producto" => $datos["peso_producto"].$datos["extension_peso"],
                                "valor_producto" => $datos["valor_producto"],
                                "serial_producto" => $datos["serial_producto"],
                                "cantidad_producto" => $datos["cantidad_producto"],
                                "fecha_vencimiento" => $datos["fecha_vencimiento"],
                                "fecha_elaboracion" => $datos["fecha_elaboracion"],);

                $producto = Productos::where('id_producto', $id)->update($datos); 

                return redirect("productos")->with("ok-editar", "");
            }

        }else{

             return redirect("productos")->with("error", "");

        }

    }

    /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){

        $validar = Productos::where("id_producto", $id)->get();
        
        if(!empty($validar)){
            $eliminar = array('p_eliminado' => 1);
            $producto = Productos::where("id_producto",$validar[0]["id_producto"])->update($eliminar);

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("producto")->with("no-borrar", "");   

        }

    }

}
