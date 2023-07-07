<?php
class conexion {
    private $serverAndBBDD = "mysql:host=localhost;dbname=MarriotJW_Proyect";
    private $username = "Viloria";
    private $password = "8080";
    private $connection;
    private static $instance;
    
    private function __construct() {
        try {
            $this->connection = new PDO($this->serverAndBBDD, $this->username, $this->password);
            $this->connection->exec("SET NAMES utf8mb4");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Error al conectar BBDD<br>";
            echo $e->getMessage();
        }
    }
    
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new conexion();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
}

/**Patron Singleton */
/*Para obtener la conection hay que instanciar la clase y llamar al metodo getConnection,*/
/**Pero oara poder instanciar, hay que llamr al metodo publico y estatico getInstance en ves del constructor, porque es privado */


?>


