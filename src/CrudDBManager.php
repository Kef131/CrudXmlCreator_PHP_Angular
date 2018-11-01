<?php
include("config.php");

class CrudDBManager{
    var $servername = DBHOST;
    var $username = DBUSER;
    var $password = DBPWD;
    var $conn = null;
    var $crudModel = null;
    var $insertSql = array();
    var $insVal = "";

    function __construct($crudModel){
        $this->conn = new mysqli($this->servername, $this->username, $this->password);
        if ($this->conn->connect_error) {
            die("<p>Connection failed: " . $this->conn->connect_error."</p>");
        }
        $this->crudModel = $crudModel;
    }

    function createDbCrud() {
        $sql = "CREATE DATABASE ". $this->crudModel->mainEntity;
        if ($this->conn->query($sql) === TRUE) {
            echo "<p>Database created successfully</p>";
        } else {
            echo "<p>Error creating database: " . $this->conn->error."</p>";
        }
    }
    
    function createTableCrud(){
        mysqli_select_db($this->conn, $this->crudModel->mainEntity);
        $sql = "CREATE TABLE IF NOT EXISTS  ". $this->crudModel->mainEntity ." ( ";
        $sql = $sql ."id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY ";
        // $this->insVal =  $this->insVal."id ";


        foreach($this->crudModel->featurizer as $feature){
            if( $feature->type == 'number'){
                // $this->insVal =  $this->insVal. " , ".$feature->name;
                if($feature->lenght != 0 ){
                    $sql = $sql . ", ".$feature->name ." INT(".$feature->lenght.")";
                    array_push($this->insertSql, 0);
                }
                else{
                    $sql = $sql . ", ".$feature->name ." INT(10)";
                    array_push($this->insertSql, 0);
                }
                if($feature->default != "" ){
                    $sql = $sql." DEFAULT '".$feature->default."' ";
                }
            }
            if( $feature->type == 'string'){
                // $this->insVal =  $this->insVal. " , ".$feature->name;                
                if($feature->lenght != 0 ){
                    $sql = $sql . ", ".$feature->name ." VARCHAR(".$feature->lenght.")";
                    array_push($this->insertSql, '"-"');
                    if($feature->default != "" ){
                        $sql = $sql." DEFAULT '".$feature->default."' ";
                    }
                }
                else{
                    $sql = $sql . ", ".$feature->name ." TEXT";
                    array_push($this->insertSql, '"-"');
                }                
            }            
        }
        $sql = $sql . ") ";
        if (mysqli_query($this->conn, $sql)) {
            echo "<p>Table and Columns/Atributes created successfully</p>";
        } else {
            echo "Error creating table: " . mysqli_error($this->conn);
        }
    }

    function insertExample(){
        $sql = "INSERT INTO ".$this->crudModel->mainEntity;
        // $sql = $sql ."( ";
        // $sql = $sql .$this->insVal.") ";
        $sql = $sql ." VALUES(NULL ";
        // array_shift($this->insertSql);
        foreach($this->insertSql as $val){
            $sql = $sql .", ".$val." ";
        }
        $sql = $sql ." )";
        
        if(mysqli_query($this->conn, $sql)){
            echo "<p>Test element inserted successfully</p>";
        } else{
            echo "Error inserting element: " . mysqli_error($this->conn);
          }

                  
        $sql = str_replace('"','', $sql);
        setcookie('ins', $sql);

        
    }

    

}



?>