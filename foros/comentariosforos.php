<!--
* la lecion aqui es que los enlaces aqui de include los debo manejar como enlaces desde la posicion
* local de este documento comentariosforos.php, que esta adentro del folder foros que esta dentro del
* folder vistas, entonces para unirme a los docuemnto de los modelos, debo moverme dos folderes mas arriba.
* me muevo dos folderes mas arriba usando ../../
-->
<!-- CSS Page Style -->
<link rel="stylesheet" href="assets/css/pages/profile.css">
<?php
	$productoid = $_GET['foroid'];
	//echo 'El foroid es '.$productoid;
	include("../../modelos/class_paginas.php");
	include("../../modelos/class_buscados.php");
	$main = new pagina();
	$main->login(); //entrar a base de datos

 		$comentarios = $main->con_donde_order_limit(comentarios,foroid,$productoid,hora,0,8); 
       	$respuestas = array();
       	$id = 0;
       	foreach ($comentarios as $comentario) {
        	$comentarioid = $comentario['productoid'];//este es el comentarioid
        	$foroid = $comentario['foroid'];
        	$userid = $comentario['usuarioid'];
        	$comment = $comentario['comentario'];
        	$comment = nl2br($comment);
        	$respuestas[$id]['productoid'] =  $comentarioid;
        	$respuestas[$id]['foroid'] = $foroid;
        	$respuestas[$id]['comentario'] = $comment;
        	$respuestas[$id]['fecha'] = $main->get_fecha(comentarios,$comentarioid);
        	//averiguar si el forista tiene una empresa y un logo
	   		$companyid = $main->con_casilla(empresaid,companies,usuarioid,$userid);
            $respuestas[$id]['companyid'] = $companyid;
            if (isset($companyid))
            $respuestas[$id]['empresa'] = $main->con_casilla(empresa,companies,empresaid,$companyid);
        	//ya no se pide al usuario que ponga un alias de forista, hay que eliminar la tabla de foros_usuarios
        	$main->entrar();
        	$respuestas[$id]['forista'] = $main->con_casilla(nombre,usuarios,usuarioid,$userid);
            //conseguir la foto
            $imgsrc = $main->con_casilla(foto,usuarios_fotos,usuarioid,$userid);
            $respuestas[$id]['fotoperfil'] = (empty($imgsrc)) ? 'assets/img/team/avatar-super-simple.jpg' : 'fotosperfiles/'.$imgsrc;
        	$main->login();
        	$id=$id+1;
        } 
?>


				<!-- Comentarios
                hay otra id de de comentario, singular sin s mas abajo en la caja de texto para poner un comentario"
                 -->
                <h3>Comentarios</h3>
                <?php 
                foreach($respuestas as $respuesta){
                    $nombre = $respuesta['forista'];
                    $fecha = $respuesta['fecha'];
                    $logo = $respuesta['logo'];
                    $companyid = $respuesta['companyid'];
                    $fotoperfil = $respuesta['fotoperfil'];
                ?>
                    <a class="pull-left" href="#">
                        <img class="media-object" width="110px" src="<?php echo $fotoperfil; ?>" alt="">
                    </a>
                    <div class="media-body g-brd-around b-brd-gray-light-v4">
                        <h4 class="media-heading">
                                        <strong><?php echo $nombre; ?></strong> 
                                        <small><?php echo $fecha; ?> </small>
                        </h4>
                        <p><?php echo html_entity_decode($respuesta['comentario'], ENT_NOQUOTES); ?></p>
                    </div>
                
                <hr>
                <?php
                }
                ?>
                <!--/termina comentarios-->