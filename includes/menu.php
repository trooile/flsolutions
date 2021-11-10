<input type="checkbox" id="menu">
<label for="menu" id="labelmenu" ><img src="/images/icon-menu.svg" id="imgmenu"></span></label>
<?php
  if(isset($_GET['language'])){
    include '../languages/'.$_GET['language'];
    $_SESSION['language'] = $_GET['language'];
    }else if(!isset($_SESSION['language'])){
        $_SESSION['language'] = 'en-us.php';
        include '../languages/en-us.php';
    }   
?>
<body id="bodymenu">
    <nav id="navmenu">
        <ul id="ulmenu">
            <li><a href="../user/home.php"><?=$_SESSION['home']?></a></li>
            <li><a href="../user/profile.php"><?=$_SESSION['profile']?></a></li>
            <li><a href="../user/settings.php"><?=$_SESSION['settings']?></a></li>
            <li><a href="../user/deslogar.php"><?=$_SESSION['logout']?></a></li>
        </ul>
    </nav>
</body>
