<?php
include_once '../includes/defaultControllers.php';
include_once '../includes/models/toSchoolUnit.php';
include_once '../includes/models/toUsers.php';
include_once '../includes/models/toCourses.php';

class Controller extends DefaultControllers
{

    function __construct()
    {
        try {
            parent::__construct();
            $this->toSchoolUnit = new ToSchoolUnit($this->masterMysqli);
            $this->toUsers = new ToUsers($this->masterMysqli);
            $this->toCourses = new toCourses($this->masterMysqli);
            $this->back = ['error' => false, 'data' => [], 'message' => ''];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function submitNewUser($params){
        try {
            if($params['passwd'] == $params['confirmpasswd']){                    
                $passwd = $this->encrypt($params['passwd']);
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

    public function login($params){
        try {
            $email = $params['email'];
            $passwd = $params['passwd'];
            $login = $this->toUsers->getAll("email ='" . $email . "'");
            if (!empty($login)) {
                $passwdDB = $this->decrypt($login[0]['passwd']);
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
            $passwddb = $this->decrypt($user[0]['passwd']);
            if ($pw==$passwddb) {
                //verificar se o pw é igual o digitado com o que está no banco
                if ($nwpw == $cfpw) {           
                    $nwpw = $this->encrypt($nwpw);
                    $this->toUsers->update(["passwd"=>$nwpw],"id_users=".$_SESSION['userLogged']);
                                   
                } else {
                    // Se o nwpw digitado não for igual cfpw
                    $this->back['error'] = true;
                    $this->back['data'] = "Mensagem qualquer 1";
                }
            } else {
                // Se o pw digitado não for igual ao do banco
                $this->back['error'] = true;
                $this->back['data'] = "Mensagem qualquer 2";
            }
           
            $this->return ();
            
        } catch (Exception $e) {
            $this->return($e);
        }
    }
}
