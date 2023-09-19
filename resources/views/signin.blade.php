<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MeetMeToday</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="/app.css"/>
  </head>
  <body class="sign-body">

    @if(session()->has('failure'))
    <div>
      <div style="background: red; text-align: center;">
            {{session('failure')}}
      </div>
    </div>
    @endif
    
    <h1 class="Apptitle">MeetMeToday</h1>

    <div class="container">
      <div class="login form">
        <header>Login</header>
        <form action="/" method="POST">
          @csrf
          <input name="loginusername" type="text" placeholder="Enter your username" />
          @error('loginusername')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input name="loginpassword" type="password" placeholder="Enter your password" />
          @error('loginpassword')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input type="submit" class="button" value="Login" />
        </form>
        <div class="signup">
          <span class="signup"
            >Don't have an account?
            <a href="/signup"><label>Sign Up</label></a>
          </span>
        </div>
      </div>
    </div>
  </body>
</html>
