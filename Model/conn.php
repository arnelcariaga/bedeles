<?php

    /**
     * Conección base de datos clase Conexion
     */
    class Conexion {
    	
    	private $myServer;
        private $myUser;
        private $myPass;
        private $myDB;

    	function __construct(){

    		$this->myServer = "IGT-LENOVO";
            $this->myUser = "developer";
            $this->myPass = "CTE2020@";
            $this->myDB = "unioym";

    		try {
				    $conn = new PDO("sqlsrv:server=$this->myServer;database=$this->myDB","$this->myUser","$this->myPass");
				    // set the PDO error mode to exception
				    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    //echo "Conección establecida";

				    $this->conn = $conn;

			}catch(PDOException $e){
			    	echo "Connection failed: " . $e->getMessage();
			}

    	}

    	public function return_conn(){
    		$conn = $this->conn;

		 	return $conn;
		}

    }

?>