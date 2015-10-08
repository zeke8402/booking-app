<!DOCTYPE html>
<html>
<head>
    <title> Admin Login </title>
    {{ HTML::style('assets/css/bootstrap-3.3.4/css/bootstrap.css') }}
    {{ HTML::style('assets/css/flatly.css') }}
    {{ HTML::style('assets/css/core.css') }}
</head>
<body>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-primary">
        <div class="panel-heading">Login to Admin Panel</div>
        <div class="panel-body">
          @if ($errors != 'None')
            <div class="alert alert-danger">
              <strong>Invalid Username or Password</strong>
            </div>
          @endif
          
          {{ Form::open(array('url' => 'admin/login', 'class' => 'form-horizontal')) }}
          
          <div class="form-group">
            <label for="username" class="col-lg-2 control-label">Username</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="username" name="username">
            </div>
          </div>
          
          <div class="form-group">
            <label for="password" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-8">
              <input type="password" class="form-control" id="password" name="password">
            </div>
          </div>
          
          <div class="text-center">
            <button type="submit" class="btn btn-primary">Log in</button>
          </div>
          <br><br><br>
          <div class="alert alert-dismissible alert-info">
            During Development, username is admin and password is admin
          </div>
          
        </div>
      </div>
    </div>
  </div>

  </div>
  
{{ Form::close() }}
</body>
</html>
