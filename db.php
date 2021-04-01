<?php 

error_reporting(E_ERROR | E_PARSE);
class DB{
    private $connection;

    public function __construct($host,$dbUser, $dbPass, $dbName)
    {
        try{
            $this->con = new mysqli($host, $dbUser, $dbPass, $dbName);

            if ($this->con->connect_errno) {
                trigger_error($this->con->connect_error);
                printf("Connect failed: %s\n", $this->con->connect_error);
                exit();
            }else{
                echo "Connected successfully <br/>";
            }

        }catch (Exception $e){
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function insert($tableName, $coloumns, $values){

        $sql = "INSERT INTO ".$tableName."(".implode(',', $coloumns).") VALUES('".implode("','", $values)."')";
        if($this->con->query($sql)){
            echo "New record created successfully using oop"."<br>";
        }else{
            echo "Error: " . $sql . "<br>" .$this->con->connect_error;
        }
    }


    public function select($tableName, ...$args){

        if ($sql = $this->con->query("select * from ".$tableName)) {
            while ($row = $sql -> fetch_assoc()) {
                for ($i=0; $i<count($args); $i++){
                    echo $row[$args[$i]] . "<br/>";
                }
            }
        }else{
            echo "Error: " . $sql . "<br>" .$this->con->error;
        }

    }


    public function update($tableName, $id, $fields){

        $fieldsWithNewValue = '';
        foreach($fields as $key => $value){
            $fieldsWithNewValue .= $key . "='".$value."', ";
        }
        $fieldsWithNewValue = substr($fieldsWithNewValue,0, -2);
        $sql = "UPDATE ".$tableName." SET ".$fieldsWithNewValue." WHERE id=".$id."";

        if($this->con->query($sql)){
            echo "Record updated successfully </br>";
        }else{
            echo "Error: " . $sql . "<br>" .$this->con->error;
        }

    }

    public function delete($tableName,$id)
    {
        $sql = "DELETE from ".$tableName." WHERE id=".$id;
        if($this->con->query($sql)){
            echo "Record deleted successfully </br>";
        }else{
            echo "Error: " . $sql . "<br>" .$this->con->error;
        }
    }

    public function deleteDataFromTable($tableName)
    {
        $sql = "DELETE from ".$tableName;
        if($this->con->query($sql)){
            echo "table deleted successfully </br>";
        }else{
            echo "Error: " . $sql . "<br>" .$this->con->error;
        }
    }
}