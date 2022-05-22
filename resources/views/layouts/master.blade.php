<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title' , 'unknown page')</title>
</head>
<body>
    @yield('content')
    @section('sec')
    this is sec
        
    @show 
    
</body>
</html>