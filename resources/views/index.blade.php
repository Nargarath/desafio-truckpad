<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @routes
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Vue App</title>

        <link href="{{ mix('css/build.css') }}" rel="stylesheet">
        <script src="{{ mix('js/build.js') }}"></script>
    </head>
    <body>
        <div id="app">
        </div>
    </body>
</html>
