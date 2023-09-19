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
    <h1 class="Apptitle">MeetMeToday</h1>

    <div class="container">
      <div class="login form">
        <header>Sign Up</header>
        <form action="/register" method="POST">
          @csrf
          <input name="username" type="text" placeholder="Enter your username" value="{{old('username')}}"/>
          @error('username')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input name="email" type="text" placeholder="Enter your email" value="{{old('email')}}"/>
          @error('email')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input name="password" type="password" placeholder="Create a password" />
          @error('password')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input name="password_confirmation" type="password" placeholder="Confirm your password" />
          @error('password_confirmation')
          <p style="color:red">{{$message}}</p>
          @enderror
          <input type="submit" class="button" value="Signup" />
        </form>
      <div class="signup">
        <span class="signup"
          >Already have an account?
          <a href="/"><label>Sign In</label></a>
        </span>
      </div>
     </div>
    </div>
  </body>
</html>
