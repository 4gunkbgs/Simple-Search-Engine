<!DOCTYPE html>
<html>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animsearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/searchpage.css') }}">
    <link rel="icon" href="{{ URL::asset('img/Logo.png') }}" type = "image/x-icon">
</head>

<body>
    <div class="logos">
        <a href="/">
            <img class="rounded mx-auto d-block" alt="Animsearch" src="{{ URL::asset('img/Logo.png') }}">
        </a>
    </div>
    <div class="bar">
        <form method="get" action="/search">
            <input class="searchbar" id="q" name="search" type="text" title="Search">
        </form>
    </div>
    <br>
    <div id="result">
        @foreach ($hasil as $h)        
    
        <div class="container">
            <div class="item">
                <a href="{{ $h['id'] }}"><div class="title">{{ $h ['title_txt_en'] }} </div></a>
                <div><img src="{{$h['pic_txt_en']}}" class="ml-1 float-start" alt="..." style="width:150px;height:200px;border-style:none"></div>
                <div class="rating">Rating: {{ $h['rating_txt_en']}}</div>
                <div class="description">
                    <div class="kategori">Synopsis: </div> {{ $h['body_txt_en']}}
                </div>
                <div class="link"><a href="{{ $h['id'] }}">{{ $h['id'] }}</a> </div>
                <div class="genre">
                    <div class="kategori">Genre: </div> {{ $h['genre_txt_en']}}
                </div>
                <div class="studio">
                    <div class="kategori">Studio: {{ $h['studio_txt_en']}}</div> 
                </div>
            </div>
        </div>
        
        @endforeach
    </div>
    
    {{-- Links() --}}
    {{-- menampilkan angka yang menunjukkan hasil pagination --}}

    <center>
    <div class="pagination">
        @if ($banyakHalaman > 1)
            @for ($i = 1; $i <= $banyakHalaman; $i++)
        
                <a href="/search?halaman={{$i}}&search={{$prevSearch}}">{{$i}}</a>
            
            @endfor
        @endif
    </div>
    </center>

</body>

</html>