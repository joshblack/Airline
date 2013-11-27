<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="CIS4301 Project 3" content="">
    <meta name="Josh Black and Justin Rafanan" content="">
    <link rel="shortcut icon" href="ico/favicon.png">

    <title>Fly JJ Airlines</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbatron-narrow.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li><a href="/">Home</a></li>
          <li class="active"><a href="flights">Book a Flight</a></li>
          <li><a href="login">Login</a></li>
        </ul>
        <h3 class="text-muted">JJ Airlines</h3>

      </div>

      <form role="form" action="flights" method="post">
        <div class="form-group">
          <label for="date">Date</label>
          <input type="datetime-local" name="flight-date" class="form-control" id="date" placeholder="Select a Date" required>
        </div>
        <div class="form-group">
          <label for="Departure">Departure</label>
          <input type="text" class="form-control" name="departure" id="Departure" placeholder="Atlanta" required>
        </div>
        <div class="form-group">
          <label for="Destination">Destination</label>
          <input type="text" class="form-control" name="destination" id="Destination" placeholder="Gainesville" required>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="flexible-date" value="true">
            Select for flexible dates
          </label>
        </div>
        <button type="submit" class="btn btn-success">Look for flights</button>
      </form>

      <div class="footer" style="margin-top: 25px">
        <p>&copy; JJ Airlines 2013</p>
      </div>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
