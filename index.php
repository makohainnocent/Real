<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login V15</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link
      rel="icon"
      type="image/png"
      href="ui/login/images/icons/favicon.ico"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/bootstrap/css/bootstrap.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/animate/animate.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/css-hamburgers/hamburgers.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/animsition/css/animsition.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/select2/select2.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="ui/login/vendor/daterangepicker/daterangepicker.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="ui/login/css/util.css" />
    <link rel="stylesheet" type="text/css" href="ui/login/css/main.css" />
    <!--===============================================================================================-->
  </head>
  <body>
    <div class="limiter">
      <div
        class="container-login100"
        style="display: flex; flex-direction: column;background-color:#f6efe5;"
      >
        <div style="padding:25px;">
          <img src="ui/assets/logo.png" width="199px" />
        </div>
        <div class="wrap-login100" style="max-width:670px;box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;">
          <div>
            <span
              class="login100-form-title-1"
              style="
                color: #000;
                text-align: center;
                display: block;
                padding-top: 50px;
                font-size: 25px;
              text-transform:none;
              font-family"
            >
              Login to RentDash
            </span>
            
            <?php
            if (!empty($_SESSION['id']) and isset($_SESSION['id'])) {
              header('location:estate/screens/view_estates.php');
            }



            if(isset($_GET['error']) and $_GET['error']==1){
              echo '<div
              style="
                background-color: #c4ffd5;
                color: brown;
                padding: 10px;
                text-align:center;
                font-size:15px;
              "
            >
            Empty user name or password.
            </div>';

            unset($_GET['error']);

            }
            elseif (isset($_GET['error']) and $_GET['error']==2) {
              echo '<div
              style="
                background-color: #c4ffd5;
                color: brown;
                padding: 10px;
                text-align:center;
                font-size:15px;
              "
            >
            Details provided were incorrect, try again.
            </div>';
            }

            unset($_GET['error']);


            ?>
          
          </div>

          <form
            class="login100-form validate-form"
            method="post"
            action="login.php"
          >
            <div
              class="wrap-input100 validate-input m-b-26"
              data-validate="Username is required"
            >
              <span class="label-input100">Email</span>
              <input
                class="input100"
                type="text"
                name="email"
                placeholder="Enter email"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 validate-input m-b-18"
              data-validate="Password is required"
            >
              <span class="label-input100">Password</span>
              <input
                class="input100"
                type="password"
                name="pass"
                placeholder="Enter password"
              />
              <span class="focus-input100"></span>
            </div>

            <div class="flex-sb-m w-full p-b-30">
              <div class="contact100-form-checkbox">
                <input
                  class="input-checkbox100"
                  id="ckb1"
                  type="checkbox"
                  name="remember-me"
                />
                <label class="label-checkbox100" for="ckb1" >
                  Remember me
                </label>
              </div>

              <div>
                <a href="#" class="txt1" style="display:none;"> Forgot Password? </a>
              </div>
            </div>

            <div class="container-login100-form-btn">
              <button class="login100-form-btn" style="background-color:#3ab36e;box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
  </body>
</html>
