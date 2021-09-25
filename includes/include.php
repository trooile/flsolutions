<header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.3/jquery.mask.min.js'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.js"></script>

<link rel="stylesheet" href="https://use.typekit.net/eda6dmy.css">
<link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link href="../includes/style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-masker/1.1.0/vanilla-masker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6Lcwm4kcAAAAAJDchOGVncUglJZqxgYFBCsa9EAA"></script>
<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1,maximum-scale=1,minimum-scale=1">
<meta charset="utf-8">
</header>
<a href="?language=en-us.php"><img src="../images/us.svg" width="25" height="20"></a>
<a href="?language=pt-br.php"><img src="../images/br.svg" width="30" height="20"></a>
<?php include_once "footer.php"; 
    function encrypt($data) {
        try{     
            $method = "AES-256-CBC";
            $secret_key = gmdate('dmy').'c09275cbd16a911a00c3a077e36f379b';
            $secret_iv = gmdate('dmy').'549d0aad4f261463b179c94c2ea3c736';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $data = openssl_encrypt($data, $method, $key, 0, $iv);
            $data = base64_encode($data);
            return $data;
        }catch(Exception $e){
            throw $e;
        } 
    }
    function decrypt($data){
        try{
            $data = base64_decode($data);
            $method = "AES-256-CBC";
            $secret_key = gmdate('dmy').'c09275cbd16a911a00c3a077e36f379b';
            $secret_iv = gmdate('dmy').'549d0aad4f261463b179c94c2ea3c736';
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16);
            $data = openssl_decrypt($data, $method, $key, 0, $iv);
            return $data;
        }catch(Exception $e){
            throw $e;
        } 
    }
?>
