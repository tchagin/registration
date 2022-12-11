<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/front/img/favicon.png') }}" type="image/x-icon">
    <title></title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/dd.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/select2.min.css') }}">

    <link href="{{ asset('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/front/css/style.min.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">

    <header class="header">
        <div class="container">
            <div class="header__body">
                <a href="{{ route('home') }}" class="header__logo">
                    <img src="{{ asset('assets/front/img/logo.png') }}" alt="">
                </a>
                <div class="header__burger">
                    <span></span>
                </div>
                <nav class="header__menu">
                    <ul class="header__list">
                        <li>
                            <a href="{{ url('http://ieg.uz') }}" class="header__link" target="_blank">{{ __('customlang.Организаторы') }}</a>
                        </li>
                        <li class="lang">
                            @php
                                $lang = Lang::locale();
                            @endphp
                            <div class="current-lang">
                                @if(Lang::locale() == 'ru')
                                    Рус
                                @elseif(Lang::locale() == 'en')
                                    Eng
                                @elseif(Lang::locale() == 'uz')
                                    Uzb
                                @endif
                            </div>
                            <div class="other-lang">
                                <ul>
                                    @foreach(\App\Http\Middleware\Localization::LOCALS as $locale)
                                        @if($locale != $lang)
                                            <li><a href="/lang/{{$locale}}">{{ $locale }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                        <div class="mobile-menu">
                            <li><a href="#" class="header__link"><img src="{{ asset('assets/front/img/ru.svg') }}" alt=""> Русский</a></li>
                            <li><a href="#" class="header__link"><img src="{{ asset('assets/front/img/uz.svg') }}" alt=""> O'zbekcha</a></li>
                            <li><a href="#" class="header__link"><img src="{{ asset('assets/front/img/en.svg') }}" alt=""> English</a></li>
                        </div>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div id="content">

        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        @yield('content')

        <div id="footer">
            <div class="container">
                <div class="footer">
                    <p>Powered by <a href="{{ url('https://knock.agency/') }}" target="_blank"><img src="{{ asset('assets/front/img/knock.png') }}" alt=""></a></p>
                    <p>© All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="ico">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="result_form"></div>
                {{--Ошибки --}}
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="modal-footer">
                    <style>
                        .modal-footer button{
                            background-color: #989898;
                            text-transform: uppercase;
                            font-size: 24px;
                            padding: 2px 45px;
                            border: none;
                            border-radius: 15px;
                            color: #fff;
                            cursor: pointer;
                            transition: .3s;
                            margin: 0 5px;
                            max-width: 250px;
                        }
                    </style>
                    <button type="button" data-dismiss="modal">ОК</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/front/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/dd.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.js"></script>

    <script src="{{ asset('assets/front/js/select2.js') }}"></script>

    <script src="{{ asset('assets/front/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/script.js') }}"></script>

    <script>
        function generatePDF() {
            const element = document.getElementById('invoice');
            html2pdf()
                .from(element)
                .save();
        }
    </script>
    <script>
        function printBadge(){
            var body = $('body').html,
                el = $('.badge-cart');
            $('body').html(el);
            window.print();
            $('body').html(body);
        }
    </script>

    <script>
        $('#callForm').on('submit', function(e){
            e.preventDefault();
            var $this = $(this);

            $.ajax({
                url: $this.prop('action'),
                method: 'POST',
                data: $this.serialize(),
                success:function(data){
                    $('#result_form').html('Ваши данные отправлены.').show();
                    $('#myModal').modal('show');
                    $("#callForm")[0].reset();
                },error:function(data){
                    $('#result_form').html('Ошибка. Данные не отправлены.').show();
                    $('#myModal').modal('show');
                }
            })
        });
    </script>

    <script>
        function formatState (state) {
            if (!state.id) {
                return state.text;
            }
            var baseUrl = "{{ asset('assets/front/img/flags') }}";
            var $state = $(
                '<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
            );
            return $state;
        };

        $(".js-example-templating").select2({
            templateResult: formatState
        });
    </script>
</body>
</html>
