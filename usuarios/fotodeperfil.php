    <?php
    session_start();
    ?>
    <?php
    include("../../modelos/class_paginas.php");
    $main = new pagina();
    $main->entrar();
    $usuarioid = $_SESSION['usuario'];
    $imgsrc = $main->con_casilla(foto,usuarios_fotos,usuarioid,$usuarioid);
        if (empty($imgsrc))
            $imgsrc = 'assets/img/team/img1-md.jpg';
        else
            $imgsrc = 'fotosperfiles/'.$imgsrc;
    ?>
    <img class="img-responsive md-margin-bottom-10" src="<?php echo $imgsrc; ?>" alt="Foto de Perfil" id="fotoDePerfil">