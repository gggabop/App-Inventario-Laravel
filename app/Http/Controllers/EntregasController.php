<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entregas;
use App\Blog;
use App\Administradores;

use Illuminate\Support\Facades\DB;
use App\Distribuidores;

class EntregasController extends Controller
{
    public function index(){

    	 $datosE=DB::table('entregas')
        ->join('distribuidores', function ($join) {
            $join->on('entregas.id_distentrega', '=', 'distribuidores.id_distribuidor')
                 ->where('entregas.e_eliminado', '<', 1);
        })
        ->get();

        if(request()->ajax()){

            return datatables()->of($datosE)
            ->addColumn('nombre_distribuidor', function($data){

              $nombre_distribuidor = $data->nombre_organizacion;

              return $nombre_distribuidor;

            })
            ->addColumn('acciones', function($data){

                $acciones = '<div class="btn-group">
                            <a href="'.url()->current().'/'.$data->id_entrega.'" class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </a>

                            <button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_entrega.'" method="DELETE" token="'.csrf_token().'" pagina="entregas"> 
                            <i class="fas fa-trash-alt"></i>
                            </button>

                          </div>';
               
                return $acciones;

            })
            ->addColumn('productos_entrega', function($data){

                $tags = json_decode($data->productos_entrega, true); 

                $productos_entrega = '<h5>';

                foreach ($tags as $key => $value) {
                    
                    $productos_entrega .= '<span class="badge badge-secondary mx-1">'.$value.'</span>';
                }

                 $productos_entrega .= '</h5>';

                return $productos_entrega;

            })
            ->rawColumns(['productos_entrega','nombre_distribuidor','acciones'])
            ->make(true);

        }

		$blog = Blog::all();
		$administradores = Administradores::all();
        $distribuidores = Distribuidores::where('d_eliminado', 0)->get();

		return view("paginas.entregas", array("blog"=>$blog, "administradores"=>$administradores, "distribuidores"=>$distribuidores));

	}
        /*=============================================
    Crear un registro
    =============================================*/

    public function store(Request $request){

        // Recoger los datos

        $datos = array("id_distentrega"=>$request->input("id_distentrega"),
                        "productos_entrega"=>$request->input("productos_entrega"),
                        "serial_entrega"=>$request->input("serial_entrega"),
                        "fecha_entrega"=>$request->input("fecha_entrega")
                        ); 

        // Recoger datos de la BD blog para las rutas de imágenes 

        $blog = Blog::all();

         // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
            $validar = \Validator::make($datos,[
                "id_distentrega"=> 'required',
                "productos_entrega" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "serial_entrega" => 'required|regex:/^[0-9a-zA-Z]+$/i|unique:entregas',
                "fecha_entrega"=> 'required'
         
            ]);

            //Guardar artículo

            if($validar->fails()){
   
                return redirect("entregas")->with("no-validacion", "");

            }else{
           
                $entrega = new Entregas();
                $entrega->id_distentrega = $datos["id_distentrega"];
                $entrega->productos_entrega = json_encode(explode(",", $datos["productos_entrega"]));
                $entrega->serial_entrega = $datos["serial_entrega"];
                $entrega->fecha_entrega = $datos["fecha_entrega"];
                

                $entrega->save();    

                return redirect("entregas")->with("ok-crear", "");
            }

        }else{
         
            return redirect("entregas")->with("error", "");

        }

    }

        public function show($id){    

        $entrega = Entregas::where('id_entrega', $id)->get();
        $distribuidores = Distribuidores::where('d_eliminado', 0)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();

        if(count($entrega) != 0){

            return view("paginas.entregas", array("status"=>200, "entrega"=>$entrega, "distribuidores"=>$distribuidores, "blog"=>$blog, "administradores"=>$administradores));
        
        }else{
            
            return view("paginas.opiniones", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));
        
        }

    }
    public function update($id, Request $request){
        // Recoger los datos

        $datos = array("id_distentrega"=>$request->input("id_distentrega"),
                        "productos_entrega"=>$request->input("productos_entrega"),
                        "serial_entrega"=>$request->input("serial_entrega"),
                        "fecha_entrega"=>$request->input("fecha_entrega")
                        ); 

        // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
           $validar = \Validator::make($datos,[
                "id_distentrega"=> 'required',
                "productos_entrega" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "serial_entrega" => 'required|regex:/^[0-9a-zA-Z]+$/i',
                "fecha_entrega"=> 'required'
         
            ]);

            //Guardar opinion

            if($validar->fails()){
               
                return redirect("entregas")->with("no-validacion", "");

            }else{

                $datos = array("id_distentrega"=>$datos["id_distentrega"],
                        "productos_entrega"=>json_encode(explode(",", $datos["productos_entrega"])),
                        "serial_entrega"=>$datos["serial_entrega"],
                        "fecha_entrega"=>$datos["fecha_entrega"]
                        ); 

                $entrega = Entregas::where('id_entrega', $id)->update($datos); 

                return redirect("entregas")->with("ok-editar", "");
            }

        }else{

             return redirect("entregas")->with("error", "");

        }

    }

        /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){

        $validar = Entregas::where("id_entrega", $id)->get();
        
        if(!empty($validar)){

            $eliminar = array('e_eliminado' => 1);
            $entrega = Entregas::where("id_entrega",$validar[0]["id_entrega"])->update($eliminar);

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("entrega")->with("no-borrar", "");

        }

    }

}
