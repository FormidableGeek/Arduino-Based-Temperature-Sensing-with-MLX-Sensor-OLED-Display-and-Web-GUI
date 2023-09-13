<!DOCTYPE html>
<head>
    
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/solid.min.css') }}" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Memory lane</title>
</head>
<body>
    @include('layout.master')
<div>
 <article class="grid-2 border-radius10 margin-20 shadow-10">
<img class="image" src='{{asset("/img/$index->picture") }}'>
    <div>
    <h2 class="margin-10 break-anywhere"> Username: {{$index->name}} </h2>
    <p class="margin-20 color fade-p8 break-anywhere"> Email: {{$index->email}} </p>
    <p class="margin-20 color fade-p8 break-anywhere"> Registered at :{{$index->created_at->diffForHumans()}}<p>
    <p class="margin-20 color fade-p8 break-anywhere"> Diary entries : {{$entry}}<p>

  </article>
</div>

@include('layout.footer')
</body>

</html>