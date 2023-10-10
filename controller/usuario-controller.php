<?php
    require_once '../model/usuario.php';
    require_once '../controller/base-controller.php';
    
    class UsuarioController extends BaseController {
        private $type = "usuario";

        public function insertUsuario($data,$url) {
            try{
                $e =  $this->insertError . $this->type;
                $data['contrasena'] = openssl_encrypt($data['contrasena'] ,"AES-128-ECB","salchichonmelocotondelimon");
                $usuario = new Usuario();
                if($usuario->insertUsuario($data)){   
                    header('Location: '. $url);
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
    
        public function updateUsuario($id, $data,$url) {
            try{
                $e =  $this->updateError . $this->type;
                $usuario = new Usuario();
                if($usuario->updateUsuario($id,$data)){
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
    
        public function deleteUsuario($id,$url) {
            try{
                $e =  $this->deleteError . $this->type;
                $usuario = new Usuario();
                if($usuario->deleteUsuario($id)){
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
    
        public function selectUsuarios($column,$value,$url) {
            try{
                $usuario = new Usuario();
                return $usuario->selectUsuarios($column,$value);
                header('Location: ' . $url);
            }catch(PDOException $e){
                $e = $e->getMessage();
                require_once("../template/error.php");
            }catch (Exception $e) {
                $e = $e->getMessage();
                require_once("../template/error.php");
            }
        }
    
        public function selectUsuario($column, $value,$url) {
            try{
                $e =  $this->selectError . $this->type;
                $usuario = new Usuario();
                $result= $usuario->selectUsuario($column, $value);
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
