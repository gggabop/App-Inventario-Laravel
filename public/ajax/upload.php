<?php

if(isset($_FILES["file"]["name"])){

	if (!$_FILES['file']['error']) {

		$titulo = md5(rand(100, 200));
		$extension = explode('.', $_FILES['file']['name']);
		$archivo = $titulo.'.'.$extension[1];
		$destino = '../img/temp/'.$_POST["carpeta"].'/'.$archivo; 
		$origen = $_FILES["file"]["tmp_name"];
		move_uploaded_file($origen, $destino);
		echo $_POST["ruta"].'/img/temp/'.$_POST["carpeta"].'/'.$archivo;

	}else{

		echo  $mensaje = 'Ooops!  El archivo temporal no se puedo cear:  '.$_FILES['file']['error'];

	}


}