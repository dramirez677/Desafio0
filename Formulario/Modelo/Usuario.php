<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author DAW2
 */
class Usuario {
    
    private $nombre;
    private $apellidos;
    private $fecha_nac;
    private $email;
    private $tlf;
    private $password;
    
    function __construct($nombre, $apellidos, $fecha_nac, $email, $tlf, $password) {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fecha_nac = $fecha_nac;
        $this->email = $email;
        $this->tlf = $tlf;
        $this->password = $password;
    }
    
    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }



}
