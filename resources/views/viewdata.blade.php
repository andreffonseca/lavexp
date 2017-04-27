<!-- app/views/viewdata.blade.php -->

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Alert List</title>

    <!-- CSS -->
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
        body { padding-top:50px; } /* add some padding to the top of our site */
    </style>
</head>
<body class="container">
<div class="col-sm-8 col-sm-offset-2">
    <legend>Session for user:</legend>
    <strong class="displayname">Welcome {{ htmlentities($_SESSION['name']) }}</strong>
    <div class="mail">{{ htmlentities($_SESSION['username']) }}</div>
    <a href="{{ URL::to('logout') }}">Logout</a>
    <br/>
    <!-- ALERTS -->
    <!-- loop over the alerts and show off some things -->
    @foreach ($itsqd_mon_messages as $alert)

        <!-- GET OUR BASIC ALERT INFORMATION -->
        <h2>ID={{ $alert->message_id }} HOST={{ $alert->host }} SERVICE={{ $alert->service }} <small>OUTPUT={{ $alert->out_1 }}</small></h2>

    @endforeach-->
</div>
</body>
</html>
