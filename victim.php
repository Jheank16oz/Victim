<?php
class Victim{

    // database connection and table name
    private $conn;
    private $table_name = "victima";

    // object properties
    public $idVictima;
    public $primerNombreV;
    public $segundoNombreV;
    public $primerApellidoV;
    public $segundoApellidoV;
    public $direccionV;     
    public $telefonoV;
    public $emailV;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function create(){

    // query to insert record
        $query = "INSERT INTO
        " . $this->table_name . "
        SET
        idVictima=:idVictima, primerNombreV=:primerNombreV, segundoNombreV=:segundoNombreV, primerApellidoV=:primerApellidoV, segundoApellidoV=:segundoApellidoV, direccionV=:direccionV, telefonoV=:telefonoV, emailV=:emailV";

    // prepare query
        $stmt = $this->conn->prepare($query);

    // sanitize
        $this->idVictima=htmlspecialchars(strip_tags($this->idVictima));
        $this->primerNombreV=htmlspecialchars(strip_tags($this->primerNombreV));
        $this->segundoNombreV=htmlspecialchars(strip_tags($this->segundoNombreV));
        $this->primerApellidoV=htmlspecialchars(strip_tags($this->primerApellidoV));
        $this->segundoApellidoV=htmlspecialchars(strip_tags($this->segundoApellidoV));
        $this->direccionV=htmlspecialchars(strip_tags($this->direccionV));
        $this->telefonoV=htmlspecialchars(strip_tags($this->telefonoV));
        $this->emailV=htmlspecialchars(strip_tags($this->emailV));

    // bind values
        $stmt->bindParam(":idVictima", $this->idVictima);
        $stmt->bindParam(":primerNombreV", $this->primerNombreV);
        $stmt->bindParam(":segundoNombreV", $this->segundoNombreV);
        $stmt->bindParam(":primerApellidoV", $this->primerApellidoV);
        $stmt->bindParam(":segundoApellidoV", $this->segundoApellidoV);
        $stmt->bindParam(":direccionV", $this->direccionV);
        $stmt->bindParam(":telefonoV", $this->telefonoV);
        $stmt->bindParam(":emailV", $this->emailV);

    // execute query
        if($stmt->execute()){
            return true;
        }

        return false;

    }


    function get($idVictima){

         // query to insert record
        $query = "SELECT * FROM " . $this->table_name . " WHERE idVictima =:id";

        // prepare query
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $idVictima);

        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row > 0) {
            $this->idVictima = $row['idVictima'];
            $this->primerNombreV = $row['primerNombreV'];
            $this->segundoNombreV = $row['segundoNombreV'];
            $this->primerApellidoV = $row['primerApellidoV'];
            $this->segundoApellidoV = $row['segundoApellidoV'];
            $this->direccionV = $row['direccionV'];
            $this->telefonoV = $row['telefonoV'];
            $this->emailV = $row['emailV'];
        }
    }
}