<?php include "include_view.php";
if (!isset($_SESSION['userLogged']) || empty($_SESSION['userLogged'])) {
  echo "<script>window.location='/user/login.php'</script>";
}
$user = $controller->toUsers->getAll("id_users =" . $_SESSION['userLogged'])[0];
$school = $controller->toSchoolUnit->getAll('id_school_unit = ' . $user["id_school_unit"])[0];
$unit = $controller->toSchoolUnit->getAll();
$course = $controller->toCourses->getAll("id_courses=" . $user["id_courses"]);
$course_name = isset($course[0]) ? $course[0]['name']:'Not Found';

?>
<body class="profile">
<div class="profile-pic-wrapper">
  <div class="pic-holder">
    <img id="profilePic" class="pic" src="../images/profile-img.svg">
    <label for="newProfilePhoto" class="upload-file-block">
      <div class="text-center">
        <div class="mb-2">
          <i class="fa fa-camera fa-2x"></i>
        </div>
        <div class="text-uppercase">
        </div>
      </div>
    </label>
    <Input class="uploadProfileInput" type="file" name="profile_pic" id="newProfilePhoto" accept="image/*" style="display: none;" />
  </div>

  </hr>
  <p class="text-info text-center small">Note: Selected image will not be uploaded anywhere.</p>
</div>
  <div class="container" id="profile">
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['nameProfile'] ?></label><br>
        <p id="profile"><?= $user["name"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['email'] ?></label><br>
        <p id="profile"><?= $user["email"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['college'] ?></label> <br>
        <p id="profile"><?= $school["name"] ?></p>
      </div>
    </div>
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <label id="profile"><?= $_SESSION['course'] ?></label><br>
        <p id="profile"><?= $course_name ?></p>
      </div>
    </div>    
    <div class="row justify-content-md-center">
      <div class="col-md-auto" id="profile">
        <a class="offset-sm-2" id="profile" href="/user/profile_cadastro.php"><button type="button" id="btnprofile" type="submit" class="btn btn-default btn-orange"><?=$_SESSION['change']?></button></a>
      </div>
    </div>
  </div>
</body>
/*
<script type="text/javascript"> 
$(document).on("change", ".uploadProfileInput", function () {
  var triggerInput = this;
  var currentImg = $(this).closest(".pic-holder").find(".pic").attr("src");
  var holder = $(this).closest(".pic-holder");
  var wrapper = $(this).closest(".profile-pic-wrapper");
  $(wrapper).find('[role="alert"]').remove();
  var files = !!this.files ? this.files : [];
  if (!files.length || !window.FileReader) {
    return;
  }
  if (/^image/.test(files[0].type)) {
    var reader = new FileReader(); 
    reader.readAsDataURL(files[0]); 

    reader.onloadend = function () {
      $(holder).addClass("uploadInProgress");
      $(holder).find(".pic").attr("src", this.result);
      $(holder).append(
        '<div class="upload-loader"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
      );

      setTimeout(() => {
        $(holder).removeClass("uploadInProgress");
        $(holder).find(".upload-loader").remove();
        if (Math.random() < 0.9) {
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-check-circle text-success"></i> Profile image updated successfully</div>'
          );

          $(triggerInput).val("");

          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        } else {
          $(holder).find(".pic").attr("src", currentImg);
          $(wrapper).append(
            '<div class="snackbar show" role="alert"><i class="fa fa-times-circle text-danger"></i> There is an error while uploading! Please try again later.</div>'
          );

          $(triggerInput).val("");
          setTimeout(() => {
            $(wrapper).find('[role="alert"]').remove();
          }, 3000);
        }
      }, 1500);
    };
  } else {
    $(wrapper).append(
      '<div class="alert alert-danger d-inline-block p-2 small" role="alert">Please choose the valid image.</div>'
    );
    setTimeout(() => {
      $(wrapper).find('role="alert"').remove();
    }, 3000);
  }
});
</script>

<style>
  .profile-pic-wrapper {
    height: 100vh;
    width: 100%;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
  .pic-holder {
    text-align: center;
    position: relative;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .pic-holder .pic {
    height: 100%;
    width: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: center;
    object-position: center;
  }
  
  .pic-holder .upload-file-block,
  .pic-holder .upload-loader {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(90, 92, 105, 0.7);
    color: #f8f9fc;
    font-size: 12px;
    font-weight: 600;
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }
  
  .pic-holder .upload-file-block {
    cursor: pointer;
  }
  
  .pic-holder:hover .upload-file-block {
    opacity: 1;
  }
  
  .pic-holder.uploadInProgress .upload-file-block {
    display: none;
  }
  
  .pic-holder.uploadInProgress .upload-loader {
    opacity: 1;
  }
  
  .snackbar {
    visibility: hidden;
    min-width: 250px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 2px;
    padding: 16px;
    position: fixed;
    z-index: 1;
    left: 50%;
    bottom: 30px;
    font-size: 14px;
    transform: translateX(-50%);
  }
  
  .snackbar.show {
    visibility: visible;
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
  }
  
  @-webkit-keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }
    to {
      bottom: 30px;
      opacity: 1;
    }
  }
  
  @keyframes fadein {
    from {
      bottom: 0;
      opacity: 0;
    }
    to {
      bottom: 30px;
      opacity: 1;
    }
  }
  
  @-webkit-keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }
    to {
      bottom: 0;
      opacity: 0;
    }
  }
  
  @keyframes fadeout {
    from {
      bottom: 30px;
      opacity: 1;
    }
    to {
      bottom: 0;
      opacity: 0;
    }
  }
</style> */
