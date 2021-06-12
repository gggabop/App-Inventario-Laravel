<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use App\Productos;
use App\Administradores;
use App\Distribuidores;
use App\Entregas;
use App\Salidas;
use App\Blog;
use Illuminate\Support\Facades\DB;
// reference the Dompdf namespace
/**
 * 
 */
class pdfController extends Controller
{
	public function PDF(){

// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml('hello world');

// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
		$dompdf->render();

// Output the generated PDF to Browser
		$dompdf->stream();
	}
	public function index(){
		$blog = Blog::all();
		$administradores = Administradores::all();
		return view("paginas.reportes", array("blog"=>$blog, "administradores"=>$administradores));
	}
	public function PDFproductos(){
		$productos = DB::table('productos')
                ->orderBy('id_producto', 'desc')
                ->get();
		$distribuidores = Distribuidores::all();
		$entregas = Entregas::all();
		$pdf=PDF::loadView('productos', compact('productos','distribuidores','entregas'))->setPaper('a4', 'landscape');
		return $pdf->download('productos.pdf');
	}
	public function PDFadministradores(){
		$administradores = Administradores::all();
		$pdf=PDF::loadView('administradores', compact('administradores'));
		return $pdf->download('administradores.pdf');
	}
	public function PDFdistribuidores(){
		$distribuidores = DB::table('distribuidores')
                ->orderBy('id_distribuidor', 'desc')
                ->get();
		$pdf=PDF::loadView('distribuidores', compact('distribuidores'));
		return $pdf->download('distribuidores.pdf');
	}
	public function PDFentregas(){
		$entregas = DB::table('entregas')
                ->orderBy('id_entrega', 'desc')
                ->get();
		$distribuidores = Distribuidores::all();
		$pdf=PDF::loadView('entregas', compact('entregas','distribuidores'));
		return $pdf->download('entregas.pdf');
	}
	public function PDFsalidas(){
		$salidas = DB::table('salidas')
                ->orderBy('id_salida', 'desc')
                ->get();
		$productos = Productos::all();
		$pdf=PDF::loadView('salidas', compact('salidas','productos'));
		return $pdf->download('salidas.pdf');
	}
}
