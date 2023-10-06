<?php
require_once 'Base.php';

class Curso extends Base {
	public $tablename = 'cursos';

	public function selectCursos($column,$value) {
		try {
			$db = new Base();
			return $result = $db->selectFilter($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function selectCurso($column, $value) {
		try {
			$db = new Base();
			return $result = $db->select($this->tablename,$column,$value);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function insertCurso($data) {
		try {
			$db = new Base();
			return $db->insert($this->tablename, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function updateCurso($id, $data) {
		
		try {
			$db = new Base();
			return $db->update($this->tablename, $id, $data);
		} catch (PDOException $e) {
			throw $e;
		}catch (Exception $e) {
			throw $e;
		}
	}

	public function deleteCurso($id) {
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