<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Make a reservation for JJ Airlines!</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <style type="text/css">
        body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
      }

      .form-signin {
        max-width: 330px;
        padding: 15px;
        margin: 0 auto;
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin .checkbox {
        font-weight: normal;
      }
      .form-signin .form-control {
        position: relative;
        font-size: 16px;
        height: auto;
        padding: 10px;
        -webkit-box-sizing: border-box;
           -moz-box-sizing: border-box;
                box-sizing: border-box;
      }
      .form-signin .form-control:focus {
        z-index: 2;
      }
      .form-signin input[type="text"] {
        margin-bottom: -1px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
      }
      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
    </style>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      @if ($message = Session::get('error'))
      <h4>Errro</h4>
      {{ $message }}  
      @endif

      <form class="form-signin" action="payment" method="POST">
        <h3 class="form-signin-heading">Enter Your Payment Information</h3>
        <input type="text" class="form-control" name="account" placeholder="Account Number" required autofocus>
        <input type="text" class="form-control" name="accountName" placeholder="Name on Account" required autofocus>
       	<input type="hidden" class="form-control" name="reservationNum" value="<?php echo $reservationNum; ?>">
        <input type="hidden" class="form-control" name="tripNum" value="<?php echo $tripNum; ?>">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Make Payment</button>
      </form>

      <hr class="featurette-divider" style="border-top: 1px solid #DDD7D7;">
          
          <div class="footer">
            <div class="pull-right">
              <a href="/"><p>Go back home</p></a>
            </div>
          </div>
        </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
