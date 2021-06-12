<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distribuidores;
use App\Blog;
use App\Administradores;


class DistribuidoresController extends Controller
{
    public function index(){

    	if(request()->ajax()){
            $distribuidores = Distribuidores::where('d_eliminado', 0)->get(); 
			  return datatables()->of($distribuidores)
			  ->addColumn('acciones', function($data){

			  		$acciones = '<div class="btn-group">
								
								<a href="'.url()->current().'/'.$data->id_distribuidor.'" class="btn btn-warning btn-sm">
									<i class="fas fa-pencil-alt text-white"></i>
								</a>

								<button class="btn btn-danger btn-sm eliminarRegistro" action="'.url()->current().'/'.$data->id_distribuidor.'" method="DELETE" pagina="distribuidores" token="'.csrf_token().'">
								<i class="fas fa-trash-alt"></i>
								</button>

			  				</div>';

			  		return $acciones;

			  })
			  ->rawColumns(['acciones'])
			  -> make(true);

		}

		$blog = Blog::all();
		$administradores = Administradores::all();

		return view("paginas.distribuidores", array("blog"=>$blog, "administradores"=>$administradores));

	}

	/*=============================================
    Crear un registro
    =============================================*/

    public function store(Request $request){

    	// Regocer datos
    	$datos = array( "nombre_distribuidor"=>$request->input("nombre_distribuidor"),
    					"nombre_organizacion"=>$request->input("nombre_organizacion"),
    					"descripcion_distribuidor"=>$request->input("descripcion_distribuidor"));

    	// Validar datos
    	if(!empty($datos)){

    		$validar = \Validator::make($datos,[

    			"nombre_distribuidor"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "nombre_organizacion"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
    			"descripcion_distribuidor"=> "nullable|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i"
    		]);

    		//Guardar categoría
    		if($validar->fails()){

    		 	return redirect("/distribuidores")->with("no-validacion", "");

    		}else{

                $distribuidor = new Distribuidores();
                $distribuidor->nombre_distribuidor = $datos["nombre_distribuidor"];
                $distribuidor->nombre_organizacion = $datos["nombre_organizacion"];
                $distribuidor->descripcion_distribuidor = $datos["descripcion_distribuidor"];
                $distribuidor->save(); 

                return redirect("/distribuidores")->with("ok-crear", "");   


    		}


    	}else{

    		return redirect("/distribuidores")->with("error", "");
    	}


    }

    /*=============================================
    Mostrar un solo registro
    =============================================*/

    public function show($id){   

        $distribuidor = Distribuidores::where('id_distribuidor', $id)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();

        if(count($distribuidor) != 0){

            return view("paginas.distribuidores", array("status"=>200, "distribuidor"=>$distribuidor, "blog"=>$blog, "administradores"=>$administradores)); 
        }

        else{
            
            return view("paginas.distribuidores", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));

        }

    }

    /*=============================================
    Editar un registro
    =============================================*/

    public function update($id, Request $request){

        // Recoger los datos

         $datos = array( "nombre_distribuidor"=>$request->input("nombre_distribuidor"),
                        "nombre_organizacion"=>$request->input("nombre_organizacion"),
                        "descripcion_distribuidor"=>$request->input("descripcion_distribuidor"));

        // Validar los datos

        if(!empty($datos)){

            $validar = \Validator::make($datos,[

                "nombre_distribuidor"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "nombre_organizacion"=> "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion_distribuidor"=> "nullable|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i"
            ]);

            if($validar->fails()){

                return redirect("/distribuidores")->with("no-validacion", "");

            }else{


                $datos = array("nombre_distribuidor" => $datos["nombre_distribuidor"],
                                "nombre_organizacion" => $datos["nombre_organizacion"],
                                "descripcion_distribuidor" =>$datos["descripcion_distribuidor"]);

                $distribuidor = Distribuidores::where('id_distribuidor', $id)->update($datos); 

                return redirect("/distribuidores")->with("ok-editar", "");
                
            }

        }else{

           return redirect("/distribuidores")->with("error", ""); 

        }


    }

    /*=============================================
    Eliminar un registro
    =============================================*/

    public function destroy($id, Request $request){

        $validar = Distribuidores::where("id_distribuidor", $id)->get();
        
        if(!empty($validar)){
            $eliminar = array('d_eliminado' => 1);
            $categoria = Distribuidores::where("id_distribuidor",$validar[0]["id_distribuidor"])->update($eliminar);

            //Responder al AJAX de JS
            return "ok";
        
        }else{

            return redirect("/distribuidores")->with("no-borrar", "");   

        }

    }

}
