<?php
include "includes/config.php";
session_start();

if (isset($_SESSION["user_email"])) {
  header("Location: todos.php");
  die();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <?php getHead(); ?>
  </head>
  <body class="bg-light">
    
  <div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="display-4 fw-bold lh-1 mb-3 text-primary">
            ToDo_List
        </h1>
        <p class="col-lg-10 fs-4">
            Create your account or LogIn
        </p>
      </div>

      <div class="col-md-10 mx-auto col-lg-5">
        <form action="login.php" method="POST" class="p-4 p-md-5 border rounded-3 bg-secondary">
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">
                Email address
            </label>
          </div>

          <div class="form-floating mb-3">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">
                Password
            </label>
          </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">
              Continue
            </button>
            <hr class="my-4">
            <small class="text-dark">
              By clicking this, you agree to the terms of use.
            </small>
        </form>
      </div>
    </div>
  </div>

    <script src="http://localhost/ToDo_List/bootstrap/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>