<?php
require_once 'base.php';

class Alumno extends Base {
	public $tablename = 'alumnos';

	public function selectAlumnos($column,$value) {
		try {
			$db = new Base();
			return $result = $db->selectFilter($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function selectAlumno($column, $value) {
		try {
			$db = new Base();
			return $result = $db->select($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function insertAlumno($data) {
		try {
			$db = new Base();
			return $db->insert($this->tablename, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function updateAlumno($id, $data) {
		
		try {
			$db = new Base();
			return $db->update($this->tablename, $id, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function deleteAlumno($id) {
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