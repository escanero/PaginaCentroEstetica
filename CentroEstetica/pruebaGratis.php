<?php

class pruebaGratis {
    private $id;
    private $nombre;
    private $email;
    private $telefono;

    // Constructor
    public function __construct($nombre, $email, $telefono) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    // Getter para el ID
    public function getId() {
        return $this->id;
    }

    // Getter para el nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Setter para el nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Getter para el email
    public function getEmail() {
        return $this->email;
    }

    // Setter para el email
    public function setEmail($email) {
        $this->email = $email;
    }

    // Getter para el teléfono
    public function getTelefono() {
        return $this->telefono;
    }

    // Setter para el teléfono
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
}
