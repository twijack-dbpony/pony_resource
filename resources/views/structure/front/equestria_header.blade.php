<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightbox.css')}}" rel="stylesheet">
    <link href="{{asset('css/main.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/cropper.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/ImgCropping.css')}}" rel="stylesheet">
    <link href="{{asset('slick-1.8.1/slick/slick.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('slick-1.8.1/slick/slick-theme.css')}}"/>
    @yield('stylesheet')
    <link rel="shortcut icon" href="{{asset('images/PearButter.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/144x144.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/114x114.jpg')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/72x72.jpg')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/57x57.jpg')}}">
    <script>
        /*
        This function replaces all <textareas> on a page with
        instances of Textbox.io.
        */
        var instantiateTextbox = function () {
            textboxio.replaceAll('textarea', {
                paste: {
                    style: 'clean'
                },
                css: {
                    // stylesheets: ['example.css']
                }
            });
        };
    </script>
</head>
<!--/head-->