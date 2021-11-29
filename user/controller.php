<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';
include_once '../includes/models/toCourses.php';
include_once '../includes/models/toCards.php';
include_once '../includes/models/toUserXBoard.php';
include_once '../includes/models/toAppBoard.php';
require_once('../email/sendEmail.php');


class Controller extends DefaultControllers
{

    function __construct()
    {
        try {
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
            $this->toUsers = new ToUsers($this->masterMysqli);
            $this->toCourses = new toCourses($this->masterMysqli);
            $this->toCards = new ToCards($this->masterMysqli);
            $this->toUserXBoard = new ToUserXBoard($this->masterMysqli);
            $this->toAppBoard = new ToAppBoard($this->masterMysqli);
            $this->back = ['error' => false, 'data' => [], 'message' => ''];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function submitNewUser($params){
        try {
            if($params['passwd'] == $params['confirmpasswd']){                    
                $passwd = $params['passwd'];
                $params['id_school_unit'] = $params['unit'];
                unset($params['unit']);
                unset($params['confirmpasswd']);
                unset($params['passwd']);
                $params['passwd'] = $passwd;
                $this->toUsers->insert($params);
            }else{
                $this->back['error'] = true;
            }
            $this->return();
        } catch (Exception $e) {
            $this->return($e);
        }
    }

    public function sendMail($params){
        try{
            $body = $_SESSION['language'] == 'en-us.php' ? '../images/welcome-email-en.png':'../images/welcome-email-pt.png';
            sendEmail($_SESSION['welcome'], $body, $body, $params['email'], 1);
            return; 
        }catch(Exception $e){
            $this->return($e);
        }
    }
    
    public function deleteBoard($params){
        try{
            $this->toAppBoard->delete($params['id_app_board']);
            $this->return();
        }catch(Exception $e){
            $this->return($e);
        }
    }

    public function login($params){
        try {
            $email = $params['email'];
            $passwd = $params['passwd'];
            $login = $this->toUsers->getAll("email ='" . $email . "'");
            if (!empty($login)) {
                $passwdDB = $login[0]['passwd'];
                if ($passwd == $passwdDB) {
                    $_SESSION['userLogged'] = $login[0]['id_users'];
                } else {
                    $this->back['error'] = true;
                }
            } else {
                $this->back['error'] = true;
            }
            $this->return();
        } catch (Exception $e) {
            $this->return($e);
        }
    }

    public function changepw($params)
    {
        
        try {
            $user = isset($_SESSION['userLogged']) ? $_SESSION['userLogged'] : 3;
            $pw = $params['pw'];
            $nwpw = $params['nwpw'];
            $cfpw = $params['cfpw'];
            $user = $this->toUsers->getAll("id_users =" . $user);
            $passwddb = $user[0]['passwd'];
            if ($pw==$passwddb) {
                //verificar se o pw é igual o digitado com o que está no banco
                if ($nwpw == $cfpw) {           
                    $nwpw = $nwpw;
                    $this->toUsers->update(["passwd"=>$nwpw],"id_users=".$_SESSION['userLogged']);
                    $this->back['data'] = "Password changed";
                                   
                } else {
                    // Se o nwpw digitado não for igual cfpw
                    $this->back['error'] = true;
                    $this->back['data'] = "The passwords entered do not match";
                }
            } else {
                // Se o pw digitado não for igual ao do banco
                $this->back['error'] = true;
                $this->back['data'] = "Password Incorrect";
            }
           
            $this->return ();
            
        } catch (Exception $e) {
            $this->return($e);
        }
    }
}
