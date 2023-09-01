<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>


<div class="container">
    <div class="main">
        <div class="loader js__loader"></div>
        <button class="btn__import js__btn__import">импортировать пользователей </button>
        <span style="margin-left: 10px">Всего: <span class="info_users js__all_users">0</span></span>,
        <span>Добавлена: <span class="info_users js__created_users">0</span></span>,
        <span>Обнавлено: <span class="info_users js__updated_users">0</span></span>

    </div>
</div>

<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
