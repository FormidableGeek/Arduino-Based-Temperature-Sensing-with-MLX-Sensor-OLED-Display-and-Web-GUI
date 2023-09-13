<!DOCTYPE html>
<head>
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">

 
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>Take a temperature reading</title>
</head>
<body>

<div class="bottom-sheet-background">
<div class="bottom-sheet">
  <div class="circular-div">
    <p>
    <span class="temp"></span> °C
         

    </p>
  </div>
  <div class="flex">
<form class="save" method="post" action="{{route('diary.store')}}" >
   @csrf
<input type="hidden" class="reading" name="reading">
    <button type="submit" class="save-form" class="button">
          <i class="fas fa-save"></i> </button>
     
</form>

    <button  class="home" class="button">

        <a href="{{route('diary.index')}}"  <i class="fas fa-home"></i></a> </button>

<form class="email" method="post" action="{{route('diary.send')}}" >
   @csrf
<input type="hidden" name="reading" class="reading">
    <button type="submit" class="email-form" class="button">

          <i class="fa fa-envelope"></i> </button>

     

</form>

</div>
<p class="color error" style=" font-size:1em; position:fixed; bottom:2%;">
  <span style="color:red; " class="error"></span>


@if ($errors->any())
@foreach ($errors->all() as $error)
{{$error}}
@endforeach
@endif
</p>
</div>
</div>
</body>
     <script src="{{asset('/js/jquery.js')}}"></script>

    <script src="{{asset('/js/ajax-call-save.js')}}"></script>
       <script src="{{asset('/js/ajax-call-email.js')}}"></script>

      <script src="{{asset('/js/temp-ajax-sync.js')}}"></script>
</html>
