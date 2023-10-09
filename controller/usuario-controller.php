<?php
    require_once '../model/usuario.php';
    require_once '../controller/base-controller.php';
    
    class UsuarioController extends BaseController {
        private $type = "usuario";

        public function insertUsuario($data) {
            try{
                $e =  $this->insertError . $this->type;
                $usuario = new Usuario();
                if($usuario->insertUsuario($data)){   
                    header('Location: index.php');
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
    
        public function updateUsuario($id, $data) {
            try{
                $e =  $this->updateError . $this->type;
                $usuario = new Usuario();
                if($usuario->updateUsuario($id,$data)){
                    header('Location: index.php');
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
    
        public function deleteUsuario($id) {
            try{
                $e =  $this->deleteError . $this->type;
                $usuario = new Usuario();
                if($usuario->deleteUsuario($id)){
                    header('Location: index.php');
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
    
        public function selectUsuarios($column,$value) {
            try{
                $usuario = new Usuario();
                return $usuario->selectUsuarios($column,$value);
                header('Location: index.php');
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function selectUsuario($column, $value) {
            try{
                $e =  $this->selectError . $this->type;
                $usuario = new Usuario();
                $result= $usuario->selectUsuario($column, $value);
                if ($result != false) {
                    return $result;
                    header('Location: index.php');
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
