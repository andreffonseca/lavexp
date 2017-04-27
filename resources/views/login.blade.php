<!-- app/views/login.blade.php -->

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Monitor: Login</title>
<link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
</head>
<body>
<form id="login" action="" method="post">
<div>
<h1>Login</h1>
<div class="body">
@if ($err)
  <p class="err visible"> {{ htmlentities($err->getMessage()) }} </p>
@endif
<p><label for="login-usr">Username</label> <span><input id="login-usr" name="user" type="text" placeholder="username"<?php if ($user['defined']) echo ' value="', htmlentities($user['value']), '"'; ?> required></span></p>
<p><label for="login-pwd">Password</label> <span><input id="login-pwd" name="pass" type="password" placeholder="password" required></span></p>
</div>
<p><button id="login-submit" type="submit"><span>Login</span></button></p>
</div>
</form>
</body>
</html>