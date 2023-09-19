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
    <script type="text/javascript">
         function showRangeValue(c){
               document.getElementById("range_val").innerHTML=c.value;
         }
    </script>
  </head>

  <!-- Body -->

  <body style="background-color: white">
    <div class="my-pro-container">
      <div>
        <a href="/home" class="App-name">MeetMeToday</a>
      </div>
      <div class="my-pro-right">
        <a href="/myprofile/{{auth()->user()->username}}">
           <img src="{{auth()->user()->avatar}}"/>
        </a>
        <a href="#" class="DM"
          ><i class="fa-solid fa-square-envelope fa-2x"></i
        ></a>
        <form action="/logout" method="POST">
            @csrf
          <input type="submit" class="submit-button" value="Sign Out"/>
        </form>
      </div>
    </div>

    <!-- Set distance -->
    <h1 class="People-around">Hello {{auth()->user()->username}}!</h1>
    <h1 class="People-around">People Around {{auth()->user()->Cityname}},{{auth()->user()->Regionname}}</h1>
    <div class="set-distance">
        <div>
            <h1>Set Distance :</h1>
        </div>
        <div>   
            <form action="/home" method="POST">
            @csrf
            <div>
                <input type="range" oninput="showRangeValue(this)" min="0" max="100" class="slider" value="{{$userdistance}}" name="slider"/>
            </div>
            <span class="range_val" id="range_val">{{$userdistance}}</span><span>KM</span>
            <input type="submit" value="Set" class="submit" />
            </form>
        </div>
    </div>


    <!-- Show users within distance -->

    @php
    $count = 0;
    @endphp
    @foreach ($otherUsers as $user)
     @php  
        $count1 =0;
        $count2 = 0; 
     @endphp
     @php if(count($user->followers) > 0){
        foreach($user->followers as $follow){
          if($follow->user_id == auth()->user()->id){
             $count1 = 1;
          }
        }
      }
      @endphp
      @php if(count($user->following) > 0){
        foreach($user->following as $follow){
          if($follow->followeduser == auth()->user()->id){
             $count2 = 1;
          }
        }
      }
      @endphp
      
    @if($count1 ==0 && $count2 == 0)
        @php
          $deltaLatitude = 6137*deg2rad($user->latitude - auth()->user()->latitude);
          $deltaLongitude = 6137*deg2rad($user->longitude - auth()->user()->longitude);
          $otherdistance = intval(sqrt($deltaLatitude*$deltaLatitude + $deltaLongitude*$deltaLongitude));
        @endphp
        @if($otherdistance <= $userdistance)
           <a class="home-profile" href="/otherprofile/{{$user->username}}">
              <div>
                @if (isset($user->avatar))
                  <img src="{{$user->avatar}}"/>
                @else
                  <img src="/fallback-avatar.jpg"/>
                @endif
              </div>
              <div>
                 <h2>{{$user->username}}</h2>
                 <h2>Location : {{$user->Cityname}},{{$user->Regionname}},{{$user->Countryname}}</h2>
                 <h2>Distance : {{$otherdistance}} Km</h2>
              </div>
           </a>
           @php
             $count = $count +1
           @endphp 
         @endif
     @endif
    @endforeach
    <!-- No result -->
    @if($count == 0)
    <h1 class="No-People-around">No available users found</h1>
    @endif


    <!-- footer begins -->
    <footer class="pro-footer">
      <p class="">
        Copyright &copy; 2022 <a href="/" class="text-muted">MeetMeToday</a>.
        All rights reserved.
      </p>
    </footer>
  </body>
</html>


