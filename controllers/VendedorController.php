<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{



    public static function crear(Router $router){

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //instanciar vendedor
                $vendedor = new Vendedor($_POST['vendedor']);
            
                $errores = $vendedor->validar();
            
                if(empty($errores)){
                    $vendedor->guardar();
                }
            }

        $router->render('vendedores/crear', [
            'errores'=> $errores,
            'vendedor'=> $vendedor
        ]);
    }




    public static function actualizar(Router $router){

        $errores = Vendedor::getErrores();
        $id = Redireccionar('/admin');

        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //asignar los valores
            $args = $_POST['vendedor'];
        
            //sincronizar objeto en memoria con lo que usuario escribio
            $vendedor->sincronizar($args);
        
            //validacion
            $errores = $vendedor->validar();
        
            if(empty($errores)){
                $vendedor->guardar();
            }            
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }




    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                $tipo = $_POST['tipo'];

                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }

        }
    }
}