<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>
    <!-- Google font -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::asset('/icons/logo.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">

    <!-- Custom stlylesheet -->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
            background-color: #0073b7;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 520px;
            width: 100%;
            line-height: 1.4;
            text-align: center;
        }

        .notfound .notfound-404 {
            position: relative;
            height: 200px;
            margin: 0px auto 20px;
            z-index: -1;
        }

        .notfound .notfound-404 h1 {
            font-family: 'Montserrat', sans-serif;
            font-size: 236px;
            font-weight: 200;
            margin: 0px;
            color: #fff;
            text-transform: uppercase;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound .notfound-404 h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 28px;
            font-weight: 400;
            text-transform: uppercase;
            color: #ffffff;
            background: #f00000;
            padding: 10px 5px;
            margin: auto;
            display: inline-block;
            position: absolute;
            bottom: 0px;
            left: 0;
            right: 0;
        }

        .notfound a {
            font-family: 'Montserrat', sans-serif;
            display: inline-block;
            font-weight: 700;
            text-decoration: none;
            color: #fff;
            text-transform: uppercase;
            padding: 13px 23px;
            background: #ff6300;
            font-size: 18px;
            -webkit-transition: 0.2s all;
            transition: 0.2s all;
        }

        .notfound a:hover {
            color: #f00000;
            background: #211b19;
        }

        @media only screen and (max-width: 767px) {
            .notfound .notfound-404 h1 {
                font-size: 148px;
            }
        }

        @media only screen and (max-width: 480px) {
            .notfound .notfound-404 {
                height: 148px;
                margin: 0px auto 10px;
            }

            .notfound .notfound-404 h1 {
                font-size: 86px;
            }

            .notfound .notfound-404 h2 {
                font-size: 16px;
            }

            .notfound a {
                padding: 7px 15px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>Oops!</h1>
                <h2>404 - La page est Introuvable</h2>
            </div>
            <a href="{{url('/')}}"><i class="fa fa-home" aria-hidden="true"></i> Aller à la page d'accueil</a>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>