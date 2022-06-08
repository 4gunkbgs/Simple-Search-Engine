<!DOCTYPE html>
<html>
<center>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Animsearch</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/searchpage.css') }}">
  </head>

  <body>

    <div class="logo">
      <a href="searchpage.php">
        <img alt="Animsearch" src="{{ URL::asset('img/Logo.png') }}">
      </a>
    </div>
    <div class="bar">
      <form method="GET" action="/search">
        <input class="searchbar" id="q" name="search" type="text" title="Search" placeholder="Search Anime">
      </form>
    </div>
    <!-- <div class="buttons">
      <input method="get" action="resultpage.php" class="btn btn-primary" value="Search Anime" role="button" type="submit" id="q" name="q">
    </div> -->
  </body>
</center>

</html>