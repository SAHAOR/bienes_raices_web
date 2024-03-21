<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){

        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        //muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ] );
    }

    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //arrego con mshjs de errores
        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $propiedad = new Propiedad($_POST['propiedad']);
        
        
            //crear carpeta
            $carpetaImagenes = '../../imagenes/';
        
        
            if(!is_dir($carpetaImagenes) ){
                mkdir($carpetaImagenes);
                }
            
            //generar nombre unico para las imagenes subidas
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            //setear la imagen
            //realiza un resize a la imagen con intervention
        
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
        
            $errores = $propiedad->validar();
        
        
            if(empty($errores)){
        
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
        
                //guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                $propiedad->guardar();
        
            }
        
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);

    }

    public static function actualizar(Router $router){

        $id = Redireccionar('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::find($id);

        $errores = Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //asignar atributos
            $args =$_POST['propiedad'];
        
            $propiedad->sincronizar($args);
            
            //validacion
            $errores = $propiedad->validar();
        
            //generar nombre unico para las imagenes subidas
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
        
            //subida de archivos
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
            //revisar si arreglo de errores esta vacio para realizar insercion
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                //almacenbar la imagen en HDD
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
        
                $propiedad->guardar();        
         
            }
        
        }

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }


    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id){
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido(($tipo))){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
    
            }
        }
    }

}