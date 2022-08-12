<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In | BetaBlogs</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="signIn/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="post" id="signup-form" class="signup-form" action="signInCheck.php">
                    <?php
                        if (isset($_GET['error']))
                        echo "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";
                        if (isset($_GET['message']))
                        echo "<div class='alert alert-seccess' role='alert'>".$_GET['message']."</div>";
                        ?>
                        <h2 class="form-title">Login</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" maxlength="20" id="name" placeholder="Your Username" required/>
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-input" name="password" maxlength="20" id="password" placeholder="Password" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>

                        <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="Identity" id="Blogger" value="Blogger" checked>
            <label class="form-check-label" for="Blogger">Blogger</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="Identity" id="User" value="User">
            <label class="form-check-label" for="User">User</label>
          </div>

                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>

                    <p class="loginhere">
                        Don't have an account ? <a href="signUp.php" class="loginhere-link">sign Up here</a>
                    <br><br>
                        Forget Your Password? <a href="forgetPass.php" class="loginhere-link">Reset Your Password here</a>
                        <br><br>Continue as a guest? <a href="index.php" class="loginhere-link">Click here</a>
                    </p>

                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
