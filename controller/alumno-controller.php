<?php
    require_once '../model/alumno.php';
    require_once '../controller/base-controller.php';
    
    class AlumnoController extends BaseController {
        private $type = "alumno";

        public function insertAlumno($data) {
            try{
                $e =  $this->insertError . $this->type;
                $alumno = new Alumno();
                if($alumno->insertAlumno($data)){   
                    header('Location: index.php');
                }else{
                    require_once("../view/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../view/error.php");
            } catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../view/error.php");
            }
        }
    
        public function updateAlumno($id, $data) {
            try{
                $e =  $this->updateError . $this->type;
                $alumno = new Alumno();
                if($alumno->updateAlumno($id,$data)){
                    header('Location: index.php');
                }else{
                    require_once("../view/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../view/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../view/error.php");
            }
        }
    
        public function deleteAlumno($id) {
            try{
                $e =  $this->deleteError . $this->type;
                $alumno = new Alumno();
                if($alumno->deleteAlumno($id)){
                    header('Location: index.php');
                }else{
                    require_once("../view/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../view/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../view/error.php");
            }
        }
    
        public function selectAlumnos($column,$value) {
            try{
                $alumno = new Alumno();
                return $alumno->selectAlumnos($column,$value);
                header('Location: index.php');
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../view/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../view/error.php");
            }
        }
    
        public function selectAlumno($column, $value) {
            try{
                $e =  $this->selectError . $this->type;
                $alumno = new Alumno();
                $result= $alumno->selectAlumno($column, $value);
                if ($result != false) {
                    return $result;
                    header('Location: index.php');
                }else{
                    require_once("../view/error.php");
                } 
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../view/error.php");
            } catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../view/error.php");
            }
        }
    }
?>
