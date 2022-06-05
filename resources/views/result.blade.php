<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Browse</title>
</head>
<body>
    @foreach ($hasil['response']['docs'] as $h)

        ini id {{ $h['id'] }}
        <br>
        title: {{ $h ['title_txt_en']}}
        <br>
        sinopsis: {{ $h['body_txt_en']}}
        <br>
        genre: {{ $h['genre_txt_en']}}

        <br>
        <br>
        
    @endforeach 
    {{-- {{ $hasil }} --}}
    
</body>
</html>