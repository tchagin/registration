<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('assets/front/img/favicon.png') }}" type="image/x-icon">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="{{ asset('assets/admin/css/chart.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav w-100">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li><a href="{{ route('home') }}" class="nav-link" target="_blank">Перейти на сайт</a></li>
            {{--            <li class="nav-item ml-auto"><a href="{{ route('logout') }}" class="nav-link">Выйти</a></li>--}}
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link">Выйти</a></li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar">

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="logo">
                <img src="{{ asset('assets/admin/img/custom/logo.svg') }}" alt="">
            </div>
            <div class="user-panel d-flex align-items-center">
                <div class="image">
                    <img src="{{ asset('assets/admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
{{--                    <img src="{{ asset('assets/admin/img/custom/admin-logo.png') }}" class="img-circle elevation-2" alt="User Image">--}}
                </div>
                <div class="info">
                    <div class="d-block" style="color: #fff; white-space: normal; font-weight: 700">
                        @if(auth()->user()->position == 'administrator') Администратор @else QR-сканер @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <img src="{{ asset('assets/admin/img/custom/menu-1.png') }}" alt="">
                            <p>Статистика</p>
                        </a>
                    </li>
                    @if(auth()->user()->position == 'administrator' || auth()->user()->position == 'junior_admin')
                        <li class="nav-item">
                            <a href="{{ route('exhibitions.index') }}" class="nav-link">
                                <img src="{{ asset('assets/admin/img/custom/menu-2.png') }}" alt="">
                                <p>Выставки</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('advertising.index') }}" class="nav-link">
                                <img src="{{ asset('assets/admin/img/custom/menu-3.png') }}" alt="">
                                <p>Реклама</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('industries.index') }}" class="nav-link">
                                <img src="{{ asset('assets/admin/img/custom/menu-4.png') }}" alt="">
                                <p>Индустрия</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inputs.index') }}" class="nav-link">
                                <img src="{{ asset('assets/admin/img/custom/menu-5.png') }}" alt="" >
                                <p>Поля для регистрации</p>
                            </a>
                        </li>
                    @endif
                    @if(auth()->user()->position == 'administrator' || auth()->user()->position == 'junior_admin' || auth()->user()->position == 'client')
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <span class="img-wrap">
                                <img src="{{ asset('assets/admin/img/custom/menu-6.png') }}" alt="" >
                            </span>
                                <p>
                                    База данных
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('members.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Зарегистрированные</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('visitors.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Посетители</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('member-list') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Скачать таблицу</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('distribution.index') }}" class="nav-link">--}}
{{--                                <img src="{{ asset('assets/admin/img/custom/menu-8.png') }}" alt="">--}}
{{--                                <p>Рассылка</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
                        @if(auth()->user()->position == 'administrator' and auth()->user()->position != 'junior_admin')
                            <li class="nav-item">
                                <a href="{{ route('admins.index') }}" class="nav-link">
                                    <img src="{{ asset('assets/admin/img/custom/menu-9.png') }}" alt="">
                                    <p>Пользователи</p>
                                </a>
                            </li>
                        <li class="nav-item">
                            <a href="{{ route('entrances.index') }}" class="nav-link">
                                <img src="{{ asset('assets/admin/img/custom/menu-10.png') }}" alt="">
                                <p>Точки входа</p>
                            </a>
                        </li>
                        @endif

                    @if(auth()->user()->position != 'client')
                    <li class="nav-item">
                        <a href="{{ route('panel') }}" class="nav-link">
                            <img src="{{ asset('assets/admin/img/custom/menu-7.png') }}" alt="">
                            <p>QR-Панель</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-12">
                        @if ($errors->any())
                            <div class="alert alert-danger" id="alert">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger" id="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success" id="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>


        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            {{--<b>Version</b> 3.0.5--}}
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="{{ asset('assets/front/js/jquery-3.2.1.min.js') }}"></script>
<script
{{--    src="https://code.jquery.com/jquery-3.6.1.min.js"--}}
{{--    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="--}}
{{--    crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/admin/js/chart.js') }}"></script>
<script src="{{ asset('assets/admin/js/table2Excel.js') }}"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<script src="{{ asset('assets/admin/js/html5-qrcode.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>

{{--<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<script>
    // Для открытия активного меню в админке при переходе
    $('.nav-sidebar a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });

    $(document).ready(function () {
        bsCustomFileInput.init();
    });

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = 2147483647;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (button[0].className.indexOf('buttons-copy') >= 0) {
                    $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                    $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                    $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                    $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                        $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                } else if (button[0].className.indexOf('buttons-print') >= 0) {
                    $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                }
                dt.one('preXhr', function (e, s, data) {
                    // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                    // Set the property to what it was before exporting.
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Requery the server with the new one-time export settings
        dt.ajax.reload();
    };
    //For Export Button
</script>

<script>
    $(document).ready(function() {
        {{--console.log('{{url('admin/emp_list')}}');--}}
        $("#member-list").DataTable({
            serverSide: true,
            ajax: {
                url: '{{url('admin/emp_list')}}',
                data: function (data) {
                    data.params = {
                        sac: "helo"
                    }
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    extend : 'excel',
                    text : 'Скачать Excel',
                    "action": newexportaction
                }
            ],
            searching: true,
            scrollY: 500,
            scrollX: true,
            scrollCollapse: true,
            "pageLength": 50,
            "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
            "language": {
                "search": "Поиск:",
                "info": "Показано от _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Показано от 0 до 0 из 0 записей",
                "paginate": {
                    "first":      "First",
                    "last":       "Last",
                    "next":       "Вперёд",
                    "previous":   "Назад"
                },
                "infoFiltered":   "(отфильтровано из _MAX_ записей)",
            },
            columns: [
                {data: "id", className: 'id'},
                {data: "fullName", className: 'fullName'},
                {data: "email", className: 'email'},
                {data: "title", className: 'title'},
                {data: "phone", className: 'phone'},
                {data: "position", className: 'position'},
                {data: "countryName", className: 'user_country'},
                // {data: "user_country.countryname", className: 'user_country.countryname'},
                {data: "exhibition.title", className: 'exhibition.title'},
            ]
        });

    });

    // $(document).ready( function () {
    //     $('#data-table').DataTable();
    // } );
</script>

<script>
    let button = document.querySelector("#downloadexcel");

    button.addEventListener("click", e => {
        let table = document.querySelector("#data-table");
        TableToExcel.convert(table);
    });
</script>

<script>
    $('#scaner-input').focus();
</script>

<script>
    $(document).ready(function(){
        $("input").attr("autocomplete", "off");
    });
</script>

<script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    // CKEDITOR.replace( 'message' );

    // CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( 'editor1', 'editor2' );
</script>

<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        // document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
        document.getElementById('scaner-code').value = qrCodeMessage;
        document.getElementById('button-click').click();
    }
    function onScanError(errorMessage) {
        //handle scan error
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

<script>
    $('#scanerForm').on('submit', function(e){
        e.preventDefault();
        var $this = $(this);

        $.ajax({
            url: $this.prop('action'),
            method: 'POST',
            data: $this.serialize(),
            success:function(data){
                $('#alert-success').html('Посетитель добавлен.').show().delay(2000).hide(1);
                $("#scanerForm")[0].reset();
            },error:function(data){
                $('#alert-danger').html('Ошибка. Данные не отправлены.').show().delay(2000).hide(1);
            }
        })
    });
</script>

<script>
    // $(function() {
    //     var div = document.getElementById('action-with-selected');
    //     if ($(".checkMembers").is(":checked")) {
    //         div.style.display = 'block';
    //     }
    // })

    $(".checkMembers").on("click", function () {
        if ($(".checkMembers").is(":checked")) {
            $('#action-with-selected').slideDown()
            // $('#action-with-selected').css('display', 'block')
        } else {
            $('#action-with-selected').slideUp()
            // $('#action-with-selected').css('display', 'none')
        }
    })
</script>

</body>
</html>
