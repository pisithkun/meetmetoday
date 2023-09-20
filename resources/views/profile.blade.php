<x-layout>

  <body style="background-color: white">
    <div class="my-pro-container">
      <div>
        <a href="/home" class="App-name">MeetMeToday</a>
      </div>
      <div class="my-pro-right">
        <a href="/myprofile/{{$user->username}}">
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
      <form action="/myprofile/{{$user->username}}/edit" method="POST">
        @csrf
        <button class="edit-button">Edit Profile</button>
      </form>
    </div>
    <div class="profile-detail">
        <h1>My Profile</h1>
        <div class="my-from">
          <h3 name="from">From :</h3> 
          <h3>{{$user->from}}</h3>
        </div>
        <div class="my-hobby">
          <h3 name="hobby">Hobby :</h3> 
          <h3>{{$user->hobby}}</h3>
        </div>
        <div class="my-whatsapp">
          <h3 name="whatsapp">Whatsapp :</h3> 
          <h3>{{$user->whatsapp}}</h3>
        </div>
        <div class="my-about-me">
          <h3>About Me :</h3>
          <p name="Aboutme">{{$user->Aboutme}}</p>
        </div>
      </div>


    <h1 class="request_received">Request received</h1>
    @php
    $count = 0;
    @endphp
    @foreach ($followers as $follow)
      @if($follow->match != 'match')
      @php
      $deltaLatitude = 6137*deg2rad($follow->userDoingTheFollowing->latitude - auth()->user()->latitude);
      $deltaLongitude = 6137*deg2rad($follow->userDoingTheFollowing->longitude - auth()->user()->longitude);
      $otherdistance = intval(sqrt($deltaLatitude*$deltaLatitude + $deltaLongitude*$deltaLongitude));
      @endphp
      <a class="home-profile" href="/otherprofile/{{$follow->userDoingTheFollowing->username}}">
        <div>
          @if (isset($follow->userDoingTheFollowing->avatar))
            <img src="{{$follow->userDoingTheFollowing->avatar}}"/>
          @else
            <img src="/fallback-avatar.jpg"/>
          @endif
        </div>
        <div>
          <h2>{{$follow->match}}</h2>
          <h2>{{$follow->userDoingTheFollowing->username}}</h2>
          <h2>Location : {{$follow->userDoingTheFollowing->Cityname}},{{$follow->userDoingTheFollowing->Regionname}},{{$follow->userDoingTheFollowing->Countryname}}</h2>
          <h2>Distance : {{$otherdistance}} Km</h2>
        </div>
      </a>  
      @php
      $count = $count +1
      @endphp 
      @endif
    @endforeach
    
    @if($count == 0)
    <h1 class="No-People-around">No available users found</h1>
    @endif


    <h1 class="request_sent">Request sent</h1>
    @php
    $count = 0;
    @endphp
    @foreach ($following as $follow)
      @if($follow->match != 'match')
      @php
      $deltaLatitude = 6137*deg2rad($follow->userBeingFollowed->latitude - auth()->user()->latitude);
      $deltaLongitude = 6137*deg2rad($follow->userBeingFollowed->longitude - auth()->user()->longitude);
      $otherdistance = intval(sqrt($deltaLatitude*$deltaLatitude + $deltaLongitude*$deltaLongitude));
      @endphp
      <a class="home-profile" href="/otherprofile/{{$follow->userBeingFollowed->username}}">
        <div>
          @if (isset($follow->userBeingFollowed->avatar))
            <img src="{{$follow->userBeingFollowed->avatar}}"/>
          @else
            <img src="/fallback-avatar.jpg"/>
          @endif
        </div>
        <div>
          <h2>{{$follow->match}}</h2>
          <h2>{{$follow->userBeingFollowed->username}}</h2>
          <h2>Location : {{$follow->userBeingFollowed->Cityname}},{{$follow->userBeingFollowed->Regionname}},{{$follow->userBeingFollowed->Countryname}}</h2>
          <h2>Distance : {{$otherdistance}} Km</h2>
        </div>
      </a>  
      @php
      $count = $count +1
      @endphp 
      @endif
    @endforeach


    @if($count == 0)
    <h1 class="No-People-around">No available users found</h1>
    @endif


    <h1 class="Matched">Matched</h1>
    @php
    $count = 0;
    @endphp
    @foreach ($followers as $follow)
      @if($follow->match == 'match')
      @php
      $deltaLatitude = 6137*deg2rad($follow->userDoingTheFollowing->latitude - auth()->user()->latitude);
      $deltaLongitude = 6137*deg2rad($follow->userDoingTheFollowing->longitude - auth()->user()->longitude);
      $otherdistance = intval(sqrt($deltaLatitude*$deltaLatitude + $deltaLongitude*$deltaLongitude));
      @endphp
      <a class="home-profile" href="/otherprofile/{{$follow->userDoingTheFollowing->username}}">
        <div>
          @if (isset($follow->userDoingTheFollowing->avatar))
            <img src="{{$follow->userDoingTheFollowing->avatar}}"/>
          @else
            <img src="/fallback-avatar.jpg"/>
          @endif
        </div>
        <div>
          <h2>{{$follow->match}}</h2>
          <h2>{{$follow->userDoingTheFollowing->username}}</h2>
          <h2>Location : {{$follow->userDoingTheFollowing->Cityname}},{{$follow->userDoingTheFollowing->Regionname}},{{$follow->userDoingTheFollowing->Countryname}}</h2>
          <h2>Distance : {{$otherdistance}} Km</h2>
        </div>
      </a>  
      @php
      $count = $count +1
      @endphp 
      @endif
    @endforeach
    
    @if($count == 0)
    <h1 class="No-People-around">No available users found</h1>
    @endif
      
</x-layout>
