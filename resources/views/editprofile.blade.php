<!DOCTYPE html>
<!---Coding By CoderGirl | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MeetMeToday | My Profile</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="/app.css" />
    <script
      src="https://kit.fontawesome.com/776e4f6f1b.js"
      crossorigin="anonymous"
    ></script>
  </head>

  <body style="background-color: white">
    <div class="my-pro-container">
      <div>
        <a href="/home" class="App-name">MeetMeToday</a>
      </div>
      <div class="my-pro-right">
        <a href="/profile/{{$user->username}}">
          <img src="{{auth()->user()->avatar}}"/>
       </a>
        <a href="#" class="DM"
          ><i class="fa-solid fa-square-envelope fa-2x"></i
        ></a>
        <form action="/logout" method="POST">
          @csrf
          <button class="submit-button">Sign Out</button>
        </form>
      </div>
    </div>
    <div class="profile-top">
        <img src="{{auth()->user()->avatar}}"/>
    </div>
    <form action="/profile/{{$user->username}}" method="POST" id="my-profile" class="profile-detail" enctype="multipart/form-data">
      @csrf
      <div class="upload-button">
        <label>Profile Picture : &nbsp; </label><input name="avatar" type="file">
      </div>
      <h1>My Profile</h1>
      <div class="my-from">
        <h3>From :</h3>
        <input type="text" name="from" value="{{old('from',$user->from)}}"/>
      </div>
      <div class="my-hobby">
        <h3>Hobby :</h3>
        <input type="text" name="hobby" value="{{old('hobby',$user->hobby)}}"/>
      </div>
      <div class="my-about-me">
        <h3>About Me :</h3>
        <textarea type="text" form="my-profile" rows="4" name="Aboutme">{{old('Aboutme',$user->Aboutme)}}</textarea>
      </div>
      <input class="submit" type="submit" value="Save Changes" />
    </form>
    <!-- footer begins -->
    <footer class="pro-footer">
      <p class="">
        Copyright &copy; 2022 <a href="/" class="text-muted">MeetMeToday</a>.
        All rights reserved.
      </p>
    </footer>
  </body>
</html>
