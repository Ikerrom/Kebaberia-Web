<?php
require_once 'base.php';

class Usuario extends Base {
	public $tablename = 'usuarios';

	public function selectUsuarios($column,$value) {
		try {
			$db = new Base();
			return $result = $db->selectFilter($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function selectUsuario($column, $value) {
		try {
			$db = new Base();
			return $result = $db->select($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function insertUsuario($data) {
		try {
			$db = new Base();
			return $db->insert($this->tablename, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function updateUsuario($id, $data) {
		
		try {
			$db = new Base();
			return $db->update($this->tablename, $id, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function deleteUsuario($id) {
		try {
			$db = new Base();
			return $db->delete($this->tablename, $id);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}
}
?>