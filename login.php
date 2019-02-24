<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Savings club</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/">

    <!-- Bootstrap core CSS -->

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cosmo/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="./assets/css/landing-page.css" rel="stylesheet">
</head>

<body>


    <div class="container">
    <div class="header clearfix">
    <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="register.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Signup</a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">SAVINGS CLUB</h3>
      </div>
    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h1>Login</h1>

        <form action="includes/login-handler.php" method="post" class="login-form">
            
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <button type="submit" name="login_user" class="btn btn-success">Login</button>
            
        </form>
        
    </div>
</div>


        <footer class="footer">
            <p>&copy; Allan 2019</p>
        </footer>

    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>