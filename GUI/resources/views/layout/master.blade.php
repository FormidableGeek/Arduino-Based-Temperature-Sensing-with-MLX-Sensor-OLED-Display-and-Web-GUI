
@auth
<header class="grid shadow width border-radius5">
  <div class="grid">
    <a class="logo"href="{{route('diary.index')}}"><img class="logo"src='{{asset("images/thermometer_logo.svg")}}'>
      </a>
    <div class="grid"><p class="logo-heading">Welcome {{auth()->user()->name}}</p></div>
  </div>
  <nav>
    <ul class="grid">
      <li id="icon" title="profile">
        <a href="{{route('diary.profile')}}" id="icon"><i class="fas fa-user"></i></a>
      </li>
      <li id="icon">
        <a href="{{route('diary.trash')}}" title="trash" id="icon"><i class="fas fa-trash"></i></a>
      </li>
       <li>
       <form class="search-form grid-mobile" action="{{route('diary.search')}}" method="get">
         @csrf
<input style="@error('search') border:2px solid red; @enderror" 
placeholder="search" name="search" type="text" value="{{request()->query('search')}}" required>
<button class="search" type="submit">
  <i id="search-icon"class="fas fa-search"></i>
</button><br>
<p class="form-text-error">
@if ($errors->any())
@foreach ($errors->all() as $error)
{{$error}}
@endforeach
@endif
@if (session('delete'))
<span style="color:rgb(18, 231, 53);"> <i class="fas fa-bell"></i>{{session('delete')}}<span>
@endif
@if (session('restore'))
<span style="color:rgb(18, 231, 53);"> <i class="fas fa-bell"></i>{{session('restore')}}<span>
@endif

</p>
</form>
</li>
    </ul>
  </nav>



 <form action="{{route('auth.logout')}}" method="post">
 @csrf
          <button class="button" title="logout">
          <i class="fas fa-sign-out-alt"></i> </button>
        </form>
</header>
@if(Request::route()->getName()=='diary.create')
<form  action="{{route('diary.index')}}" method="get">
          <button  class="add-form" class="button">
          <i class="fas fa-home"></i> </button>
        </form>
        @else
        <form  action="{{route('diary.create')}}" method="get">
          <button  class="add-form" class="button">
          <i class="fas fa-plus"></i> </button>
        </form>
@endif
      @endauth
      @guest
<header class="grid shadow   border-radius5">
    <img class="logo" src='{{asset("images/thermometer_logo.svg")}}'>
    <p class="logo-heading">Infrared thermometer GUI</p></div>

  <nav>
    <ul class="grid">
      <li id="icon">
        <a href="{{route('login')}}" title="trash" id="icon"><i class="fas fa-sign-in"></i></a>
      </li>
    </ul>
  </nav>
  @if(Request::route()->getName()=='home')
  <form  action="{{route('auth.create')}}" method="get">
          <button  class="add-form" class="button">
          <i class="fas fa-plus"></i> </button>
        </form>
        @else
        <form  action="{{route('home')}}" method="get">
          <button  class="add-form" class="button">
          <i class="fas fa-home"></i> </button>
        </form>
      
@endif
      @endguest

      </header>
