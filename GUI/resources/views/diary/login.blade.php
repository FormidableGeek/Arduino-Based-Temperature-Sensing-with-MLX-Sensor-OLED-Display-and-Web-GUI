<!DOCTYPE html>
<head>
    
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Sign in</title>
</head>
<body>

@include('layout.master')
<div class="form-container">
<form class="form" method="post" enctype="multipart/form-data" action="{{route('auth.login')}}" >
@csrf
  <h1 class="margin-20">
    Sign in
  </h1>
<input style="@error('email')border:2px solid red; @enderror" type="email" 
name="email"  value="{{old('email')}}" placeholder="Enter your email">
<input style="  @error('password')border:2px solid red; @enderror"
 type="password" name="password" placeholder="Enter your password">
<div>
<label for="remember_me">Remember me</label> <input type="checkbox" class="checkbox" name="remember_me">
</div>
<p class="color">
@if ($errors->any())
@foreach ($errors->all() as $error)
{{$error}}
@endforeach 
@endif
<br>
@if (session('error'))
{{session('error')}}
@endif</p>
<button class="form-submit">Sign in</button>

</form>
</div>
@include('layout.footer')
</body>
</html>