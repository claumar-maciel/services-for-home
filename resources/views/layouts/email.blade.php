<!DOCTYPE html>
<html> 
    <head>
        <title>{{env('APP_NAME')}}</title>
        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="{{env('APP_NAME')}}">   

        <style>
            * {
                box-sizing: border-box;
                padding: 0;
                margin: 0;
            }

            .email_template_body {
                width: 100%;
                background: #0051ff;
                padding-top: 20px;
                padding-bottom: 20px;
                text-align: center;
                border: 1px solid white;
            }
            .card__container {
                box-shadow: 0 0 1em rgb(177, 177, 177);
                width: 600px;
                margin: auto;
            }
            @media (max-width: 600px) {
                .card__container {
                    width: 100% !important;
                }
            }

            .card__container__header {
                background: #ffffff;
                color: #2d2d2d;
                padding: 24px 32px;
                border-radius: 8px 8px 0px 0px;
                text-align: center;
                font-family: "Roboto"
            }

            .card__container__header img {
                width: 120px;
                margin-bottom: 16px;
            }

            .card__container__header h2 {
                margin: 1rem 0px;
                font-weight: 800;
                font-size: 32px;
                background: white;
                width: 100%;
                padding: 20px;
                border-radius: 6px;
            }

            .card__container__header h2 span {
                color: #0051ff;
            }

            .card__container__header p {
                margin: 16px 0px;
                font-weight: 500;
                font-size: 22px;
                color: gray;
            }
            .card__container__body {
                color: #2d2d2d;
                background: whitesmoke;
                padding: 40px 32px;
                font-size: 18px;
            }
            .footer {
                height: auto;
                background-color: #3c3c3c;
                color: white;
                padding: 32px 16px;
            }
        </style>

        @yield('styles')
    </head> 

    <body class="email_template_body">
        <div class="card__container">
            <div class="card__container__header">
                <img src="{{asset('img/logo.png')}}" alt="{{env('APP_NAME')}}">
        
                <h2>A <span>MAIOR</span> plataforma de prestação de serviços</h2>
            </div>

            <div class="card__container__body">
                @yield('content')
            </div>

            <div class="footer">
                {{env('APP_NAME')}}
            </div>
        </div>
    </body>
</html> 
