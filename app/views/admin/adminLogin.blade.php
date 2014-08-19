<!DOCTYPE html>
<html>
<head>
    <title> Admin Login </title>
    {{ HTML::style('assets/css/foundation.css') }}
</head>
<body>
 <div class="row">

    <div class="small-centered small-4 medium-4 large-8 columns login" align="center">
       <h1> Admin Login</h1>
       {{ Form::open(array('url' => 'admin/login')) }}
       <fieldset>
           <legend> Log in </legend>
           <label for="username">Username:</label>
           <input type="text" size="20" id="username" name="username" />
           <br/>
           <label for="password">Password:</label>
           <small class="error">During development, username is admin and password is admin</small>
           <input type="password" size="20" id="password" name="password" />
           <?php
            if($errors != "None") {
            echo '<small class="error">Invalid username or password</small>';
            }
           ?>
        <br/>
        <button type="submit" class="button-medium radius"> Log In </button>
    </fieldset>
{{ Form::close() }}
</div>

</div>
</body>
</html>
