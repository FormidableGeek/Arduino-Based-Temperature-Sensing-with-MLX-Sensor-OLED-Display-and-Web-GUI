<!DOCTYPE html>
<head>
    
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Search for beautiful memories</title>
</head>
<body>
@include('layout.master')
@foreach ($searchs as $search)
 <article class="grid-2 border-radius10 margin-20 shadow-10">
<img class="image" src='{{asset("/images/$search->picture") }}'>
    <div>
    <h2 class="margin-10 break-anywhere">  {{$search->readings}}°C </h2>
    <p class="margin-20 color fade-p8 break-anywhere"> Created  {{$search->created_at->diffForHumans()}}<p>
    <div class="flex-2 margin-20">
        <form class="margin-10" action="{{route('diary.view')}}" method="get">
<input value="{{$search->id}}" name="view" type="hidden">
<button id="icon" type="submit"><i class="fas fa-eye"></i></button>
</form>
<form class="margin-10" action="{{route('diary.delete')}}" method="POST">
@csrf
@method('DELETE')
<input value="{{$search->title}}" name="title" type="hidden">
<input value="{{$search->id}}" name="view" type="hidden">
<button id="icon" type="submit" title="delete"><i id="icon" class="fas fa-trash-alt"></i></button>
</form>
</div>
</div>
  </article>
@endforeach
<div class="links">{{$searchs->appends(['search'=>request()->query('search')])->links()}}</div>
@if(empty($search))
<div class="flex margin-100">
<p class="color margin-10">

Search term "{{request()->query('search')}}" not found</p>
</div>
@endif
@include('layout.footer')

</body>

</html>

