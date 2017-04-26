<!-- app/views/login.blade.php --><

<!doctype html>
<html>
<head>
<title>Please Login</title>
</head>
<body>
<div class="row">
        <div class="page-header">
            <h2>Please login to your account</h2>
        </div>
    </div>
    <form action=loginpage method="post">
        <label for="username">Name:</label>
        <input type="text" id="username" name="user"><br>
        {{ $errors->has('user') ? 'has-error' : '' }}<br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="pass"><br>
        {{ $errors->has('pass') ? 'has-error' : '' }}<br>
        <input type="submit">
    </form>
</div>