<?php

namespace Model;

class ActiveRecord{
        //BD
        protected static $db;
        protected static $columnasDB = [];
        protected static $tabla = '';
    
        //Errores
        protected static $errores = [];
        

    
        //definir conexion a db
        public static function setDB($database){
            self::$db = $database;
        }
    

    
        public function guardar(){
            if(!is_null($this->id)){
                $this->actualizar();
            }
            else{
                $this->crear();
            }
        }
    
        public function crear(){
    
            //sanitizar los datos
            $atributos = $this->sanitizarAtributos();
    
            $query = "INSERT INTO " . static::$tabla . " ( "; 
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES (' "; 
            $query .= join("', '", array_values($atributos));
            $query .= " ') ";
        
            $resultado = self::$db->query($query);
    
            if($resultado){
                //redireccionar al usuario una vez enviado correctamente
                //aparte hacer un query string (url con parametros)
                header('Location: /admin?resultado=1');
            }
        }
    
        public function actualizar(){
            //sanitizar los datos
            $atributos = $this->sanitizarAtributos();
            $valores = [];
            foreach($atributos as $key => $value){
                $valores[] = "{$key} ='{$value}'";
            }
    
            $query= "UPDATE " . static::$tabla . " SET ";
            $query .=  join(', ', $valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . " ' ";
            $query .= " LIMIT 1 ;";
    
            $resultado = self::$db->query($query);
    
            if($resultado){
                //redireccionar al usuario una vez enviado correctamente
                //aparte hacer un query string (url con parametros)
                header('Location: /admin?resultado=2');
            }
        }
    
        public function eliminar(){
            //Eliminar el registro
            $query = "DELETE FROM " . static::$tabla . " WHERE id= " . self::$db->escape_string($this->id) . " LIMIT 1";
            $resultado = self::$db->query($query);
    
            if($resultado){
                $this->borrarImagen();
                header('location: /admin?resultado=3');
            }
        }
    
        public function atributos(){
            $atributos = [];
            foreach(static::$columnasDB as $columna){
                if($columna === 'id') continue;
                $atributos[$columna] = $this->$columna;
            }
            return $atributos;
        }
    
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
    
            foreach($atributos as $key => $value){
                $sanitizado[$key] = self::$db->escape_string($value);
            }
    
            return $sanitizado;
        }
    
        //subida de archivos
        public function setImagen($imagen){
            if(!is_null($this->id)){
                $this->borrarImagen();
            }
    
            if($imagen){
                $this->imagen = $imagen;
            }
        }
    
        //eliminar archivo
        public function borrarImagen(){
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }
        }
    
        //validacion
        public static function getErrores(){

            return static::$errores;
        }
    
        public function validar(){
    
            static::$errores = [];
            return static::$errores;
        }
    
    
        public static function all(){
            $query = "SELECT * FROM " . static::$tabla;
            $resultado = self::consultarSQL($query);
    
            return $resultado;
        }
    
        public static function consultarSQL($query){
            //consultar base de datos
            $resultado = self::$db->query($query);
            //iterar resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }
            
            //liberar la memoria
            $resultado->free();
            //retornar los resultados
            return $array;
        }
    
        protected static function crearObjeto($registro){
            $objeto = new static();
    
            foreach($registro as $key => $value){
                if(property_exists($objeto, $key)){
                    $objeto->$key = $value;
                }
            }
            return $objeto;
        }
    
        //obtiene determinado numero de registros
        public static function get($cantidad){
            $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
            $resultado = self::consultarSQL($query);
    
            return $resultado;
        }

    
        //busca propiedad por id
        public static function find($id){
            $query = "SELECT * FROM " . static::$tabla . " WHERE id=" . $id;
            $resultado = self::consultarSQL($query);
    
            return array_shift($resultado);
        }
    
        //actualziar datos del objeto 
        public function sincronizar($args = []){
            foreach($args as $key => $value){
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value;
                }
            }
        }
}