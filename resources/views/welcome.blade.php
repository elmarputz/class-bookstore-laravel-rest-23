<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <ul>
            @foreach ($books as $book)
                <li><h3>{{$book->isbn}}</h3>{{$book->title}}</li>
            @endforeach
        </ul>
    </body>
</html>
