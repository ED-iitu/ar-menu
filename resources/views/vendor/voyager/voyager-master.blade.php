<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', 'Voyager')</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    @yield('css')
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('javascript')
</head>
<body class="@yield('body_class')" style="@yield('body_style')">
@yield('page_header')
<div class="wrapper">
    @yield('content')
</div>
@yield('page_footer')
@stack('javascript')
<script src="{{ asset('js/dropzone.js') }}"></script>
<script>
    Dropzone.options.form = {
        parallelUploads: 3,
        paramName: 'file', // имя поля файла
        maxFilesize: 10, // максимальный размер файла в МБ
        //acceptedFiles: 'image/*', // разрешенные типы файлов
        init: function() {
            this.on('success', function(file, response) {
                console.log(response); // обработка ответа от сервера
            });
        }
    };
</script>
</body>
</html>
