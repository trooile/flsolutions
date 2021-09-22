<?php include "../includes/include_view.php";
      include "../includes/configDB.php";
      $sql = "SELECT name FROM school_unit";
      $names = mysqli_query($conn,$sql);
?>

<div class="container-fluid" style="text-align:center;">
  <a href="../index.php"><img src="../images/logo.png" class="w-15 p-3"></a>
  <div class="panel panel-default" style="margin:auto;width:50%;border:3px;padding:10px;">
    <div class="panel-body">   
      <form>
        <div class="mb-3">
          <input type="text" class="form-control" id="name"  placeholder="Complete Name">
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email address">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="passwd" placeholder="Password">
        </div>
        <div class="mb-3">
          <input type="password" class="form-control" id="confirmpasswd" placeholder="Confirm Password">
        </div>
        <div class="mb-3">
          <select type="text" class="form-control" id="unit">
              <option value="" selected disabled>Select your unit</option>
              <?php while($valor = mysqli_fetch_array($names)){?>
                <option><?php echo $valor['name'] ?></option>
                <?php } ?>
          </select>
        </div>
        <button type="submit" class="btn btn-default btn-lg btn-orange ">Create account</button>
      </form>
    </div>
  </div>
  <label>Already have an account? </label>
  <a class="text-orange" href="./login.php"><b>Sign up</b></a>
</div>
<img src="../images/signin-background.png" class="w-15 p-3" style="float:left">
<?php include_once "../includes/footer.php" ?>

