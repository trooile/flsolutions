<?php
include_once __DIR__.'/configDB.php';
include_once __DIR__.'/mySQL.php';
Class DefaultControllers{
    public $masterMysqli;
    function __construct(){
        try{
            global $_DB_PROFILER;
            $_DB_PROFILER = [];
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $config = new Includes\ConfigDB();
            $this->masterMysqli = new mysqli($config->getDBServer(),$config->getDBUser(),$config->getDBPass(),$config->getDBName());
            $this->masterMysqli->set_charset("utf8");
            $this->back = ['error'=> false, 'data'=> [], 'message'=>''];
	        if (mysqli_connect_errno()) throw new Exception(mysqli_connect_error());
        }catch(Exception $e){
            throw $e;
        }
    }
    public function randomString($qtd = 12) {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = [];
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < $qtd; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function return($exception = null){
        try{
            if($exception == null){
                if($_SERVER['REQUEST_METHOD'] == 'POST'){
                    echo json_encode($this->back);
                }
            }else{
                $this->back['error'] =  true;
                $this->back['message'] =  $exception->getMessage();
                $this->back['errorMessage'] =  $exception->getMessage();
                if($exception->getCode() == -1){
                    $this->back['message'] =  $exception->getMessage();
                }
            }
        }catch(Exception $e){
            throw $e;
        }
    }

    public function encrypt($data) {
        try{
            $method = "AES-256-CBC";
            $secret_key = gmdate('dmy').'hdFNsqZCjttS3RKGb4W7ZGiAeMUYnryj';
            $secret_iv = gmdate('dmy').'8J3rL2b1Nj9yeyKb4twA0Pcu3rOhDY0H';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $data = openssl_encrypt($data, $method, $key, 0, $iv);
            $data = base64_encode($data);
            return $data;
        }catch(Exception $e){
            throw $e;
        }
    }

    public function decrypt($data){
        try{
            $data = base64_decode($data);
            $method = "AES-256-CBC";
            $secret_key = gmdate('dmy').'hdFNsqZCjttS3RKGb4W7ZGiAeMUYnryj';
            $secret_iv = gmdate('dmy').'8J3rL2b1Nj9yeyKb4twA0Pcu3rOhDY0H';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $data = openssl_decrypt($data, $method, $key, 0, $iv);
            return $data;
        }catch(Exception $e){
            throw $e;
        }
    }

}
?>
