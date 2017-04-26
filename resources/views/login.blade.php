<!-- app/views/login.blade.php --><

<!doctype html>
<html>
<head>
<title>Please Login</title>
</head>
<body><

{{ Form::open(array('url' => 'loginpage')) }}
<h1>Login</h1>

<!-- if there are login errors, show them here -->
<p>
    {{ $errors->first('user') }}
    {{ $errors->first('pass') }}
</p>

<p>
    {{ Form::label('user', 'Username') }}
    {{ Form::text('user', Input::old('user'), array('placeholder' => 'awesome@awesome.com')) }}
</p>

<p>
    {{ Form::label('pass', 'Password') }}
    {{ Form::password('pass') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}