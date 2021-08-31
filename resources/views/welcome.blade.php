<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <title>Laravel</title>

        <style>
            .router-link-active {
                font-weight: bold;
            }
        </style>

    </head>
    <body>
        <div id="app">

            {{-- <home-component> </home-component>
            <br>
            <posts-index> </posts-index> --}}
            <app-main> </app-main>

        </div>
        <script src="{{mix('js/app.js')}}"> </script>
    </body>
</html>
