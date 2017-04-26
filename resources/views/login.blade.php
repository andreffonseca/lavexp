<!-- app/views/login.blade.php --><

<!doctype html>
<html>
<head>
<title>Please Login</title>
</head>
<body>
<div class="row">
        <div class="page-header">
            <h2>{!! trans('site/user.login_to_account') !!}</h2>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            {!! Form::open(array('url' => url('auth/loginpage'), 'method' => 'post', 'files'=> true)) !!}
            <div class="form-group  {{ $errors->has('user') ? 'has-error' : '' }}">
                {!! Form::label('user', "Username", array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::text('user', null, array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('user', ':message') }}</span>
                </div>
            </div>
            <div class="form-group  {{ $errors->has('pass') ? 'has-error' : '' }}">
                {!! Form::label('pass', "Password", array('class' => 'control-label')) !!}
                <div class="controls">
                    {!! Form::password('pass', array('class' => 'form-control')) !!}
                    <span class="help-block">{{ $errors->first('pass', ':message') }}</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                        Login
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
</div>