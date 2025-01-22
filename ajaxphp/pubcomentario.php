<?php 
       session_start();
       include("../modelos/class_paginas.php");
       $main = new pagina();
       //revisar si esta como usuario
       $usuarioid = $_SESSION['usuario'];
       if (empty($usuarioid)){
       	echo 'Debe registrarse como usuario';
       }else
       {
              //informacion para comparar
              $foroid = $_POST['foroid'];
              $mensaje = $_POST['comentario'];
              //revisar si magic quote no esta
              if (!get_magic_quotes_gpc())
              {
                     $mensaje = addslashes($mensaje);
              }

              $mensaje = trim($mensaje);
              $mensaje = strtolower($mensaje);
              $mensaje = ucfirst($mensaje);
              $mensaje = strip_tags($mensaje);
              $mensaje = htmlentities($mensaje, ENT_NOQUOTES | ENT_IGNORE, "ISO8859-1");

              $today = time();
              $format = 'Y-m-d-H-s';
              $hora = date($format, $today);
              $date = date($format, $today);
              //conseguir usuarioid del que publico el foro
              $main->login();
              $userid = $main->con_casilla(usuarioid,foros,productoid,$foroid);
              //titulo del foro
              $title = $main->con_casilla(titulo,foro,productoid,$foroid);
              //meter la informacion a la base de datos
              $query = "INSERT INTO comentarios (usuarioid,foroid,hora,date,comentario)" . "VALUES ($usuarioid,$foroid,'$hora','$date','$mensaje')";
              $result = mysql_query($query);
              //actualizar foros por el nuevo comentario
              $query1 = "UPDATE foros SET hora = '$hora' WHERE productoid = $foroid";
              $result1 = mysql_query($query1);


              // cuadrar headers
              $headers = "MIME-Version: 1.0"."\r\n";
              $headers .= "Content-Type: text/html; charset=\"iso-8859-1"."\r\n";
              
              if ($result1){  
                     echo $foroid;
                     //infomacion del que publica
                     $main->entrar();
                     $nombre = $main->con_casilla(nombre,usuarios,usuarioid,$usuarioid);
                     $correo = $main->con_casilla(email,usuarios,usuarioid,$userid);
                     $titulo = 'Nuevo comentario en su foro '.$title;   
                     $direcion = 'construcali.publicidad@gmail.com';
                     $mailcontent = 'Nuevo comentario en su foro publicado por: '.$nombre. "\n";
                     $mailcontent .= 'Visite el foro <a href="construcali.com/foros.php?content=unforo&foroid='.$foroid.'">aqui</a>';          
                     mail($direcion, $titulo, $mailcontent);
                     mail($correo, $titulo, $mailcontent);
                     mail('rvelezpantoja@gmail.com',$titulo, $mailcontent,$headers);
              }else{
                     echo "<h2>Disculpe, Hubo un problema publicando su comentario</h2>\n";
       }

}
?>

