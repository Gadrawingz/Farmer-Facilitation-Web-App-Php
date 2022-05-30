<?php
class DBConnection {
    public    $host = "localhost";
    protected $dbase= "id17618255_farmer_app";
    private   $user = "id17618255_thierry";
    private   $pass = "But&Chris2021";
    public    $con;

    public function connect(){
        try {
            $dsn= "mysql:host=$this->host; dbname=$this->dbase";
            $this->con = new PDO($dsn, $this->user, $this->pass );
            return $this->con;

        } catch(PDOException $error) {
            echo "OOPS! ERROR OCCURED".$error->getMessage();
        }
    }
}
?>  