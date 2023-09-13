




<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/solid.min.css') }}" type="text/css" rel="stylesheet">
    <title></title>
</head>

<body>
    @include('layout.master')
<section>
  <article class="grid border-radius10 margin-20 shadow-10">
  <img class="image" src='{{asset("/images/$read->picture") }}'>
    <div>
    <h2 class="margin-20 break-anywhere">  {{$read->readings}} °C </h2>
   @if($read->readings>=38)
   Body temperature is too high🥵
  @elseif($read->readings>35 && $read->readings<38)

 Body temperature is okay 😊!
@else
Body temperature is too low🥶
@endif
 <p class="margin-20 color"> Created at:  {{$read->created_at}}<p>
 <div class="flex-2 margin-20">
<form class="margin-10" action="{{route('diary.delete')}}" method="POST">
@csrf
@method('DELETE')
<input value="{{$read->title}}" name="title" type="hidden">
<input value="{{$read->id}}" name="view" type="hidden">
<button id="icon" type="submit" title="delete"><i id="icon" class="fas fa-trash-alt"></i></button>
</form>
</div>
    <div>
        
  </article>
  
  
  
</section>
@include('layout.footer')

</body>

</html>



