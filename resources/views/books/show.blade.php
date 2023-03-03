<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>
<body>
<h1>{{$book->title}}</h1>
{{$book->isbn}}
<p>
    {{$book->description}}
</p>
<hr />
<a href="../books">Zurück zur Buchliste</a>
</body>
</html>
