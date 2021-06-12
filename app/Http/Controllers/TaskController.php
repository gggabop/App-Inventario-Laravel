<?php
namespace App\Http\Controllers;

use Alert;
use Artisan;
use Carbon\Carbon;
use Log;
use Spatie\Backup\Helpers\Format;
use Storage;
use App\Blog;
use App\Administradores;
use ZipArchive;

class TaskController extends Controller
{
    public function index(){
        $blog = Blog::all();
        $administradores = Administradores::all();
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        $files = $disk->files(config('backup.backup.name'));
        $backups = [];
        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size' => Format::humanReadableSize($disk->size($f)),
                    'last_modified' => Carbon::createFromTimestamp($disk->lastModified($f)),
                ];
            }
        }
        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);
        return view("paginas.backup")->with(compact('backups','blog','administradores'));
    }
    public function respaldo(){

    $db_host = 'localhost'; //Host del Servidor MySQL
    $db_name = 'bd_proyecto'; //Nombre de la Base de datos
    $db_user = 'root'; //Usuario de MySQL
    $db_pass = ''; //Password de Usuario MySQL
    $public_dir=public_path();
    
    $fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo
 
    // Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
    $salida_sql = $db_name.'_'.$fecha.'.sql'; 
    
    //Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
    $dump = "mysqldump --h$db_host -u$db_user -p$db_pass --opt $db_name > $salida_sql";
    system($dump, $output); //Ejecutamos el comando para respaldo
    
    $zip = new ZipArchive(); //Objeto de Libreria ZipArchive
    
    //Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
    $salida_zip = $db_name.'_'.$fecha.'.zip';
    
    if($zip->open($salida_zip,ZIPARCHIVE::CREATE)===true) { //Creamos y abrimos el archivo ZIP
        $zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
        $zip->close(); //Cerramos el ZIP
        unlink($salida_sql); //Eliminamos el archivo temporal SQL
        $headers = array(
                'Content-Type' => 'application/octet-stream',
            );
        $filetopath=$public_dir.'/'.$salida_zip;
            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$salida_zip,$headers);
            }
        } else {
        echo 'Error'; //Enviamos el mensaje de error
    }
    }

    public function create()
    {
        try {
            // start the backup process
            Artisan::call('backup:run', ['--only-db' => 'true']);
            $output = Artisan::output();
            // log the results
            Log::info("Backpack\BackupManager -- new backup started from admin interface \r\n" . $output);
            // return the results as a response to the ajax call
            return redirect("/backup")->with("creado", "");
        } catch (Exception $e) {
            Flash::error($e->getMessage());
            return redirect()->back();
        }
    }
    /**
     * Downloads a backup zip file.
     *
     * TODO: make it work no matter the flysystem driver (S3 Bucket, etc).
     */
    public function download($file_name)
    {
        $file = config('backup.backup.name') . '/' . $file_name;
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists($file)) {
            $fs = Storage::disk(config('backup.backup.destination.disks')[0])->getDriver();
            $stream = $fs->readStream($file);
            return \Response::stream(function () use ($stream) {
                fpassthru($stream);
            }, 200, [
                "Content-Type" => $fs->getMimetype($file),
                "Content-Length" => $fs->getSize($file),
                "Content-disposition" => "attachment; filename=\"" . basename($file) . "\"",
            ]);
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }
    /**
     * Deletes a backup file.
     */
    public function delete($file_name)
    {
        $disk = Storage::disk(config('backup.backup.destination.disks')[0]);
        if ($disk->exists(config('backup.backup.name') . '/' . $file_name)) {
            $disk->delete(config('backup.backup.name') . '/' . $file_name);
            return redirect()->back();
        } else {
            abort(404, "The backup file doesn't exist.");
        }
    }

}

