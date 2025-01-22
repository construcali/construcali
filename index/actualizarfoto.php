<?php
	include("modelos/class_paginas.php");
	include("modelos/class_metidas.php");
	$main = new pagina();
	$meto = new metida();
	$main->login(); //entrar a base de datos construcali
	// esta variables reciben la informacion para actualizarla
	$fotoid = $_POST['fotoupdate'];
	$descripcion = $_POST['descripcion3'];

	// estas variables reciben la informacion para borrarla y atraves de hacerCatalogo.js
	$photoid = $_POST['fotoid2'];
	$boton = $_POST['boton'];
	$empresaid = $_POST['empresaid2'];

	if ($boton !== 'borrar') {
		//coger nombre de la foto
		$picname = $_FILES['foto3']['name'];
		// encontrar descripcion original
		$descripcion_original = $main->con_casilla(descripcion,fotos,fotoid,$fotoid);
		if(($descripcion == $descripcion_original) && (empty($picname))) {
			return false;
		} // cierra si la descripcion es igual a la origina
		else if(($descripcion !== $descripcion_original) && (empty($picname))) {
			$descripcion = mysql_real_escape_string($descripcion);
			$descripcion = htmlentities($descripcion);
			$meto->update_foto_descripcion($descripcion,$fotoid);
			return true;
		}
		else if (($descripcion == $descripcion_original) && (!empty($picname))) {
			$type = $_FILES['foto3']['type'];
			$foto = getPic($_FILES['foto3']); // coge la data cruda de la foto
			$foto = mysql_real_escape_string($foto);
			$meto->update_foto($descripcion,$foto,$fotoid);
			return true;
		}else{
			$descripcion = mysql_real_escape_string($descripcion);
			$descripcion = htmlentities($descripcion);
			$meto->update_foto_descripcion($descripcion,$fotoid);
			//$type = $_FILES['foto3']['type'];
			$foto = getPic($_FILES['foto3']);
			$foto = mysql_real_escape_string($foto);
			$meto->update_foto($descripcion,$foto,$fotoid);
			return true;
		}
	}
	else if($boton == 'borrar') {
				$meto->borrar_puntajes(1,$empresaid);
				$meto->borrar_fotos($photoid);
				echo 'La foto ha sido borrada';
	}
	else{
			echo 'No se pudo actualizar la foto';
	}

?>

<!-- Functions -->
<?php

	function getPic($Original){
		if(!$Original['name'])
		{
			//No image supplied, use default
			$TempName = "presentaciones/logoColconstruccion.png";
			$TempFile = fopen($TempName, "r");
			$thumbnail = fread($TempFile, fileSize($TempName));
		}	
		else if ($Original['error'] > 0)
		{	
			switch ($_FILES['logo']['error'])
			{
				case 1: 
					$mensaje = 'El Documento excedio upload_max_filesize'; 
					break;
				case 2: 
					$mensaje = 'El Documento excedio max_file_size'; 
					break;
				case 3: 
					$mensaje = 'El Documento solo subio parcialmente'; 
					break;
				case 4: 
					$mensaje = 'No se ha subido ningun documento'; 
					break;
			}
			include("vistas/usuariosanunciar.inc.php");
		}
		else if (($Original['type'] == 'application/octet-stream')||($Original['type'] == 'text/plain')||($Original['type'] == 'application/x-httpd-php'))
		{
			$mensaje = 'El Documento no es una foto';
		}else
		{
			//Get image
			$Picture = file_get_contents($Original['tmp_name']);
			
			//Create Image
			$SourceImage = imagecreatefromstring($Picture);
			if (!$SourceImage)
			{
				//Not a valid image
				echo "No ha subido una imagen valida\n";
				$TempName = "presentaciones/CasaGeneral.jpg";
				$TempFile =  fopen($TempName, "r");
				$thumbnail = fread($TempFile, filesize($TempName));
			}
			else
			{
				//Create Thumbnail
				$width = imagesx($SourceImage);
				$height = imagesy($SourceImage);
				$newThumb = imagecreatetruecolor(600, 480);
				
				//resize image to 80 x 60
				$result = imagecopyresampled($newThumb, $SourceImage, 0, 0, 0, 0, 600, 480, $width, $height);
				
				//move image to variable
				ob_start();
				imagejpeg($newThumb);
				$thumbnail = ob_get_contents();
				ob_end_clean();
			}
		}
		return $thumbnail;
	}


	function getFoto($Original)
	{
		if(!$Original['name'])
		{
			//No image supplied, use default
			$TempName = "presentaciones/logocolconstruccion.png";
			$TempFile = fopen($TempName, "r");
			$thumbnail = fread($TempFile, fileSize($TempName));
		}
		else
		{
			//Get image
			$Picture = file_get_contents($Original['tmp_name']);
			
			//Create Image
			$SourceImage = imagecreatefromstring($Picture);
			if (!$SourceImage)
			{
				//Not a valid image
				echo "No ha subido una imagen valida\n";
				$TempName = "presentaciones/CasaGeneral.jpg";
				$TempFile =  fopen($TempName, "r");
				$thumbnail = fread($TempFile, filesize($TempName));
			}
			else
			{
				//Create Thumbnail
				$width = imagesx($SourceImage);
				$height = imagesy($SourceImage);
				$newThumb = imagecreatetruecolor(600, 480);
				
				//resize image to 80 x 60
				$result = imagecopyresampled($newThumb, $SourceImage, 0, 0, 0, 0, 600, 480, $width, $height);
				
				//move image to variable
				ob_start();
				imagejpeg($newThumb);
				$thumbnail = ob_get_contents();
				ob_end_clean();
			}
		}
		return $thumbnail;
	}

?>