<?php

namespace Model;

use Model\ActiveRecord;

class Admin extends ActiveRecord{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'usuario', 'password'];

    public $id;
    public $usuario;
    public $password;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuario = $args['usuario'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){

        if(!$this->usuario){
            self::$errores[] = 'El email es obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE usuario = '" . $this->usuario . "' LIMIT 1";
        
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = 'El email o password son incorrectos';
            return;
        }

        return $resultado;
    }

    public function comprobarPassword($resultado){
        
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = 'El email o password son incorrectos';
        }

        return $autenticado;
    }

    public function autenticar(){

        session_start();

        $_SESSION['usuario'] = $this->usuario;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}