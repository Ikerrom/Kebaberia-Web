<?php

class Base {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "kebaberia";


    private function connection(){
        try {
            $conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname",$this->username ,$this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            throw $e;
        }catch (Exception $e) {
			throw $e;
		}
    }

    protected function insert($table,$data){
        try {
            $conn = $this->connection();
            $keys = array_keys($data);
            $sql = "REPLACE INTO $table (".implode(", ", $keys).") VALUES ( :".implode(", :",$keys).")";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $conn = null;
            return $stmt->rowCount();
        } catch(PDOException $e) {
            $conn = null;
            throw $e;
        }catch (Exception $e) {
            $conn = null;
			throw $e;
		}
    }

    protected function update($table, $id, $data) {
        try{
            $conn = $this->connection();

		    $fields = array();
			foreach ($data as $keys => $element) {
				$fields[] = " ". $keys ."=:". $keys;
			}
			$chain = implode(", ", $fields);

			$sql = "UPDATE $table SET $chain WHERE id=$id";
            $stmt = $conn->prepare($sql);
            $stmt->execute($data);
            $conn = null;
            return $stmt->rowCount();
        } catch(PDOException $e) {
            $conn = null;
            throw $e;
        }catch (Exception $e) {
            $conn = null;
			throw $e;
		}
	}

    protected function delete($table, $id) {
        try{
            $conn = $this->connection();
            $sql = "DELETE FROM $table WHERE id = $id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $conn = null;
            return $stmt->rowCount();
        }catch(PDOException $e) {
            $conn = null;
            throw $e;
        }catch (Exception $e) {
            $conn = null;
			throw $e;
		}
     
	}

    protected function selectFilter($table,$column,$value){
        $result = [];
        try{
            $conn = $this->connection();
            $sql;
            if($column == "" || $value == ""){
                $sql = "SELECT * FROM $table";
            }else{
                $sql = "SELECT * FROM $table WHERE $column ='".$value."'";
            }
            $result = $conn->query($sql)->fetchAll();
            $conn = null;
            return $result;
        }catch(PDOException $e) {
            $conn = null;
            throw $e;
        }catch (Exception $e) {
            $conn = null;
			throw $e;
		}
	}

    protected function select($table,$column,$value) {
        $result = [];
		try {
            $conn = $this->connection();
            $sql = "SELECT * FROM $table WHERE $column ='".$value."'";
            $result = $conn->query($sql);
            $result = $result->fetch(PDO::FETCH_ASSOC);
            $conn = null;
            return $result;
		} catch (PDOException $e){
            $conn = null;
			throw $e;
		}catch (Exception $e) {
            $conn = null;
			throw $e;
		}
	}
}

?>