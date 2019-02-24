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
          </ul>
        </nav>
        <h3 class="text-muted">SAVINGS CLUB</h3>
      </div>
    <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <h1>SignUp</h1>

        <!-- {{#if message}}
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            {{message}}
        </div>
        {{/if}} -->
        <!-- Send error message -->
        <?php 
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo ' <div class="alert alert-danger alert-dismissible">Fill in all fields
                <button type="button" class="close" data-dismiss="alert" aria-label="close">      
                <span aria-hidden="true">&times;</span>
                </button>
        
            </div>';
            }elseif ($_GET['error'] == "invalidemail") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid email
                <button type="button" class="close" data-dismiss="alert" aria-label="close">       
                <span aria-hidden="true">&times;</span>
                </button>
        
            </div>';
            } elseif ($_GET['error'] == "invalidname") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid name
                <button type="button" class="close" data-dismiss="alert" aria-label="close">   
                <span aria-hidden="true">&times;</span>
                </button>
        
            </div>';
            }elseif ($_GET['error'] == "usertaken") {
                echo ' <div class="alert alert-danger alert-dismissible">Email is taken
                <button type="button" class="close" data-dismiss="alert" aria-label="close">  
                <span aria-hidden="true">&times;</span>
                </button>
        
            </div>';
            }
            elseif ($_GET['error'] == "success") {
                echo ' <div class="alert alert-success role="alert">Registration successful
                <button type="button" class="close" data-dismiss="alert" aria-label="close">   
                <span aria-hidden="true">&times;</span>
                </button>
        
            </div>';
            }
        }
        
        ?>

        <form action="includes/signup-handler.php" method="post" class="signup-form">
            <div class="form-group">
                <label for="firstName">First Name: </label>
                <input type="text" name="firstName" id="firstName" class="form-control">
            </div>
        <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="form-control">
            </div>

            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password">Confirm password: </label>
                <input type="password" name="repeatPassword" id="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-success" name="submit">Sign up</button>
            
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