<!DOCTYPE html>
<head>
    
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Register to begin</title>
</head>
<body>
@include('layout.master')
<div class="form-container">
<form class="form" method="post" enctype="multipart/form-data" action="{{route('auth.register')}}" >
  @csrf
  <h1 class="margin-20">
    Register
  </h1>
 
<input style="  @error('username')border:2px solid red; @enderror" 
type="text" name="username" value="{{old('username')}}" placeholder="Enter your username">
<input style="  @error('email')border:2px solid red; @enderror"
 type="email" name="email"  value="{{old('email')}}" placeholder="Enter your email">
<input style="  @error('password')border:2px solid red; @enderror"
 type="password" name="password" placeholder="Enter your password">
<input style="  @error('password_confirmation')border:2px solid red; @enderror"
 type="password" name="password_confirmation" placeholder="Confirm your password">
<div>
<label for="remember_me">Remember me</label> <input type="checkbox" class="checkbox" name="remember_me">
</div>
<p class="color">
@if ($errors->any())
@foreach ($errors->all() as $error)
{{$error}}
@endforeach
@endif</p>
<button class="form-submit">Register</button>

</form>
</div>
@include('layout.footer')
</body>
</html>