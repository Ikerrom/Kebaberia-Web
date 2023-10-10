<?php
    require_once '../model/curso.php';
    require_once '../controller/base-controller.php';
    
    class CursoController extends BaseController {
        private $type = "curso";

        public function insertCurso($data,$url) {
            try{
                $e =  $this->insertError . $this->type;
                $curso = new Curso();
                if($curso->insertCurso($data)){   
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
    
        public function updateCurso($id, $data,$url) {
            try{
                $e =  $this->updateError . $this->type;
                $curso = new Curso();
                if($curso->updateCurso($id,$data)){
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
    
        public function deleteCurso($id,$url) {
            try{
                $e =  $this->deleteError . $this->type;
                $curso = new Curso();
                if($curso->deleteCurso($id)){
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
    
        public function selectCursos($column,$value,$url) {
            try{
                $curso = new Curso();
                return $curso->selectCursos($column,$value);
                header('Location: ' . $url);
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function selectCurso($column, $value,$url) {
            try{
                $e =  $this->selectError . $this->type;
                $curso = new Curso();
                $result= $curso->selectCurso($column, $value);
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
