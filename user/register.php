<?php include "include_view.php";
      include "../includes/configDB.php";
      $sql = "SELECT * FROM school_unit";
      $names = mysqli_query($conn,$sql);
?>

<div id='register'>
  <div class="container-fluid" style="text-align:center;">
    <a href="../index.php"><img src="../images/logo.png" class="w-15 p-3"></a>
    <div class="panel panel-default" style="margin:auto;width:50%;border:3px;padding:10px;">
      <div class="panel-body">   
        <form>
          <div class="mb-3">
            <input type="text" class="form-control" id="name"  placeholder="<?php echo $_SESSION['complete-name'];?>">
          </div>
          <div class="mb-3">
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['your-email'];?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="passwd" placeholder="<?php echo $_SESSION['your-passwd'];?>">
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="confirmpasswd" placeholder="<?php echo $_SESSION['confirm-passwd'];?>">
          </div>
          <div class="mb-3">
            <select type="text" class="form-control" id="unit">
                <option value="" selected disabled><?php echo $_SESSION['select-unit'];?></option>
                <?php while($value = mysqli_fetch_array($names)){?>
                  <option value='<?php echo $value['id_school_unit'] ?>'><?php echo $value['name'] ?></option>
                  <?php } ?>
            </select>
          </div>
          <button id="submit" type="submit" class="btn btn-default btn-lg btn-orange "><?php echo $_SESSION['create-account'];?></button>
        </form>
      </div>
    </div>
    <label><?php echo $_SESSION['already-account'];?></label>
    <a class="text-orange" href="./login.php"><b><?php echo $_SESSION['signup'];?></b></a>
  </div>
  <img src="../images/signin-background.png" class="w-15 p-3" style="float:left">
</div>
<?php include_once "../includes/footer.php" ?>
