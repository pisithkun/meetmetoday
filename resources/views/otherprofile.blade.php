<x-layout>

  <body style="background-color: white">
    <div class="my-pro-container">
      <div>
        <a href="/home" class="App-name">MeetMeToday</a>
      </div>
      <div class="my-pro-right">
        <a href="/myprofile/{{auth()->user()->username}}"
          ><img
            src="{{auth()->user()->avatar}}"
        /></a>
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
      <a href="/profile/{{$user->username}}"
        ><img
          src="{{$user->avatar}}"
      /></a>
     @if (count($authSendRequest) > 0 && count($otherSendRequest)==0)
     <form action="/remove-follow/{{$user->username}}" method="POST">
      @csrf
      <button class="edit-button">Cancel Request</button>
     </form>
     @endif
     @if (count($otherSendRequest) > 0 && count($authSendRequest)==0)
     <form action="/match/{{$user->username}}" method="POST">
      @csrf
      <button class="edit-button">Accept Request</button>
     </form>
     <form action="/delete-follow/{{$user->username}}" method="POST">
      @csrf
      <button class="edit-button">Delete Request</button>
     </form>
     @endif
     @if (count($otherSendRequest) == 0 && count($authSendRequest)==0)
     <form action="/create-follow/{{$user->username}}" method="POST">
      @csrf
      <button class="edit-button">Send Request</button>
     </form>
     @endif
     @if (count($otherSendRequest) > 0 && count($authSendRequest)>0)
      @csrf
      <button class="edit-button">Whatapp ID {{$user->username}}</button>
      <form action="/delete-follow/{{$user->username}}" method="POST">
        @csrf
        <button class="edit-button">Unmatch</button>
       </form>
     @endif



    </div>
    <div class="profile-detail">
        <h1>{{$user->username}}</h1>
        <div class="my-from">
          <h3 name="from">From :</h3> 
          <h3>{{$user->from}}</h3>
        </div>
        <div class="my-hobby">
          <h3 name="hobby">Hobby :</h3> 
          <h3>{{$user->hobby}}</h3>
        </div>
        <div class="my-about-me">
          <h3>About Me :</h3>
          <p name="Aboutme">{{$user->Aboutme}}</p>
        </div>
      </div>
</x-layout>
