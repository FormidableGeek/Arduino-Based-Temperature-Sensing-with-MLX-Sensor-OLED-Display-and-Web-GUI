<!DOCTYPE html>
<head>
    
<link href="{{asset('/css/app.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/all.css') }}" type="text/css" rel="stylesheet">
<link href="{{asset('web/css/solid.min.css') }}" type="text/css" rel="stylesheet">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Temperature|Dashboard</title>
</head>
<body>
    @include('layout.master')
<div>
 @forelse($index as $memory)
 <article class="grid-2 border-radius10 margin-20 shadow-10">
<img class="image" src='{{asset("/images/$memory->picture") }}'>
    <div>
    <h2 class="margin-10 break-anywhere">  {{$memory->readings}}°C </h2>
    <p class="margin-20 color fade-p8 break-anywhere"> Created  {{$memory->created_at->diffForHumans()}}<p>
    <div class="flex-2 margin-20">
        <form class="margin-10" action="{{route('diary.view')}}" method="get">
<input value="{{$memory->id}}" name="view" type="hidden">
<button id="icon" type="submit"><i class="fas fa-eye"></i></button>
</form>
<form class="margin-10" action="{{route('diary.delete')}}" method="POST">
@csrf
@method('DELETE')
<input value="{{$memory->title}}" name="title" type="hidden">
<input value="{{$memory->id}}" name="view" type="hidden">
<button id="icon" type="submit" title="delete"><i id="icon" class="fas fa-trash-alt"></i></button>
</form>
</div>
</div>
      
  </article>
 
 @empty
 <div class="flex margin-100">
 <a href="{{route('diary.create')}}">Haven't created any memory yet? <br>Click here to create one</a>
 @endforelse
</div>
</div>
<div class="links">{{$index->appends(['search'=>request()->query('search')])->links()}}</div>

@include('layout.footer')
</body>

</html>