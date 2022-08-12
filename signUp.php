
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up | BetaBlogs</title>

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
                    <form method="post" id="signup-form" class="signup-form" action="signUpCheck.php" >
                        <?php
                        if (isset($_GET['error']))
                        echo "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";
                        if (isset($_GET['message']))
                        echo "<div class='alert alert-seccess' role='alert'>".$_GET['message']."</div>";
                        ?>
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="Username" maxlength="20" id="name" placeholder="Your Username" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="First_name" id="name" maxlength="20" placeholder="Your First name" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="Last_name" id="name" maxlength="20" placeholder="Your Last name" required/>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" maxlength="30" placeholder="Your Email" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" maxlength="20" id="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least
                            one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" maxlength="20" id="re_password" placeholder="Repeat your password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number
                            and one uppercase and lowercase letter, and at least 8 or more characters" required/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="secretq" maxlength="70" id="secretq" placeholder="Your Secret Question" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-input" name="secreta" maxlength="20" id="secreta" placeholder="Your Secret Answer" required/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-check-inline">
                            <p>Sign Up As:</p>
            <input class="form-check-input" type="radio" name="Blogger" id="Blogger" value="blogger" required>
            <label class="form-check-label" for="Blogger">Blogger</label>
          </div>
          <div class="form-check-inline">
            <input class="form-check-input" type="radio" name="Blogger" id="User" value="user" required>
            <label class="form-check-label" for="User">User</label>
          </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="signIn.php" class="loginhere-link">Login here</a>
                        <br>Continue as a guest? <a href="index.php" class="loginhere-link">Click here</a>
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
