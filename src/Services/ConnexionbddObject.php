<?php
// src/Services/ConnexionBdd.php
namespace App\Services;

class Connexionbdd
{
    private $etat;
    private $host;
    private $user;
    private $password;

    public function __construct(){
       $this->host = 'localhost'; 
       $this->user = 'root'; 
       $this->password = '';  
    }
    
    public function initialise(){
        $this->etat = 'connecté';
    }

    public function getConnexion(){
        return $this->etat;
    }
}