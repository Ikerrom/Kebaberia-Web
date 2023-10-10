<?php
    require_once '../model/alumno.php';
    require_once '../controller/base-controller.php';
    
    class AlumnoController extends BaseController {
        private $type = "alumno";

        public function insertAlumno($data,$url) {
            try{
                $e =  $this->insertError . $this->type;
                $alumno = new Alumno();
                if($alumno->insertAlumno($data)){   
                    header('Location: ' . $url);
                }else{
                    require_once("../template/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            } catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function updateAlumno($id, $data,$url) {
            try{
                $e =  $this->updateError . $this->type;
                $alumno = new Alumno();
                if($alumno->updateAlumno($id,$data)){
                    header('Location: '. $url);
                }else{
                    require_once("../template/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function deleteAlumno($id,$url) {
            try{
                $e =  $this->deleteError . $this->type;
                $alumno = new Alumno();
                if($alumno->deleteAlumno($id)){
                    header('Location: ' . $url);
                }else{
                    require_once("../template/error.php");
                }
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function selectAlumnos($column,$value,$url) {
            try{
                $alumno = new Alumno();
                return $alumno->selectAlumnos($column,$value);
                header('Location: ' . $url);
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function selectAlumno($column, $value,$url) {
            try{
                $e =  $this->selectError . $this->type;
                $alumno = new Alumno();
                $result= $alumno->selectAlumno($column, $value);
                if ($result != false) {
                    return $result;
                    header('Location: ' . $url);
                }else{
                    require_once("../template/error.php");
                } 
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            } catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    }
?>
