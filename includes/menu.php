<input type="checkbox" id="menu">
<script src="../includes/java/bootstrap/bootstrap.min.js"></script>
<label for="menu" id="labelmenu" >MENu</span></label>
<?php 
  if(!isset($_SESSION['language'])){
    $_SESSION['language'] = 'en-us.php';
    include '../languages/en-us.php';
    }else if(isset($_GET['language'])){
    include '../languages/'.$_GET['language'];
    $_SESSION['language'] = $_GET['language'];
    }
?>
<body id="bodymenu">
    <nav id="navmenu">
        <ul id="ulmenu">
            <li><a href=""><?=$_SESSION['home']?></a></li>
            <li><a href=""><?=$_SESSION['profile']?></a></li>
            <li><a href=""><?=$_SESSION['settings']?></a></li><br>
            <li><a href=""><?=$_SESSION['logout']?></a></li>
        </ul>
    </nav>
</body>
