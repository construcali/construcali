/* 
se usa en la pagina de cotizar.inc.php
para escoger la ciudad de la capital cuando escoge un departamento
*/
    $(document).ready(function(){
        $('.departamento').change(function(){
            if($(this).val() == 'Amazonas'){
                $('.ciudad').val('Leticia');
            }
            if($(this).val() == 'Antioquia'){
                $('.ciudad').val('Medellin');
            }
            if($(this).val() == 'Arauca'){
                $('.ciudad').val('Arauca');
            }
            if($(this).val() == 'Atlantico'){
                $('.ciudad').val('Barranquilla');
            }
            if($(this).val() == 'Bolivar'){
                $('.ciudad').val('Cartagena');
            }
            if($(this).val() == 'Boyaca'){
                $('.ciudad').val('Tunja');
            }
            if($(this).val() == 'Caldas'){
                $('.ciudad').val('Manizales');
            }
            if($(this).val() == 'Caqueta'){
                $('.ciudad').val('Florencia');
            }
            if($(this).val() == 'Casanare'){
                $('.ciudad').val('Yopal');
            }
            if($(this).val() == 'Cauca'){
                $('.ciudad').val('Popayan');
            }
            if($(this).val() == 'Cesar'){
                $('.ciudad').val('Valledupar');
            }
            if($(this).val() == 'Choco'){
                $('.ciudad').val('Quibdo');
            }
            if($(this).val() == 'Cordoba'){
                $('.ciudad').val('Monteria');
            }
            if($(this).val() == 'Cundinamarca'){
                $('.ciudad').val('Bogota');
            }
            if($(this).val() == 'Guajira'){
                $('.ciudad').val('Riohacha');
            }
            if($(this).val() == 'Guania'){
                $('.ciudad').val('Inirida');
            }
            if($(this).val() == 'Guaviare'){
                $('.ciudad').val('San Jose del Guaviare');
            }
            if($(this).val() == 'Huila'){
                $('.ciudad').val('Neiva');
            }
            if($(this).val() == 'Magdalena'){
                $('.ciudad').val('Santa Marta');
            }
            if($(this).val() == 'Meta'){
                $('.ciudad').val('Villavicencio');
            }
            if($(this).val() == 'Nariño'){
                $('.ciudad').val('Pasto');
            }
            if($(this).val() == 'Norte de Santander'){
                $('.ciudad').val('Cucuta');
            }
            if($(this).val() == 'Putumayo'){
                $('.ciudad').val('Mocoa');
            }
            if($(this).val() == 'Quindio'){
                $('.ciudad').val('Armenia');
            }
            if($(this).val() == 'Risaralda'){
                $('.ciudad').val('Pereira');
            }
            if($(this).val() == 'San Andres y Providencia'){
                $('.ciudad').val('San Andres');
            }
            if($(this).val() == 'Santander'){
                $('.ciudad').val('Bucaramanga');
            }
            if($(this).val() == 'Sucre'){
                $('.ciudad').val('Sincelejo');
            }
            if($(this).val() == 'Tolima'){
                $('.ciudad').val('Ibague');
            }
            if($(this).val() == 'Valle del Cauca'){
                $('.ciudad').val('Cali');
            }
            if($(this).val() == 'Vaupes'){
                $('.ciudad').val('Mitu');
            }
            if($(this).val() == 'Vichada'){
                $('.ciudad').val('Puerto Carreño');
            }
        });
    });