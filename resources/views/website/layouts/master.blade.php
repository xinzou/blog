<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="{{ systemConfig('description') }}">
    <meta name="author" content="{{ systemConfig('author') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ systemConfig('title') }}</title>
    <link href="{{asset('assets/website/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/website/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('assets/website/css/index.css')}}">

    <style type="text/css">
        body { padding-top: 50px; }
    </style>
</head>
<body>

@include("website.layouts.nav")
@yield('content')
@include("website.layouts.footer")
<script src="{{asset('assets/website/js/jquery-2.0.3.min.js')}}"></script>
<script src="{{asset('assets/website/js/tagscloud.js')}}"></script>
<script src="{{asset('assets/website/js/bootstrap.min.js')}}"></script>
</body>
</html>