<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('panel.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/@coreui/coreui@3.2/dist/css/coreui.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css" rel="stylesheet" />
    <link href="{{ asset('css/custom-v7.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body class="c-app">
    @include('partials.menu')
    <div id="qr-reader-box" style="position:absolute;width:100%;height:100%; background:white;z-index:10000;" class="d-none">
        <div id="qr-reader" style="width:100%; margin:20px auto"></div>
        <div id="qr-reader-results"></div>
        <div style="margin:0 auto;width:50px">
            <a href="javascript:void(1)" id="btn-qrcode-reader-close" class="btn btn-danger"><i class="fa fa-close"></i> Fechar</a>
        </div>
    </div>
    <div class="c-wrapper">
        <header class="c-header c-header-fixed px-3">
            <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <a class="c-header-brand d-lg-none" href="<?= url('/') ?>">{{ trans('panel.site_title') }}</a>

            <button class="c-header-toggler mfs-3 d-md-down-none" type="button" responsive="true">
                <i class="fas fa-fw fa-bars"></i>
            </button>

            <ul class="c-header-nav ml-auto">
                @if(count(config('panel.available_languages', [])) > 1)
                <li class="c-header-nav-item dropdown d-md-down-none">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
                @endif
                @canany(['io_veiculo_create', 'io_pessoa_create'])
                <li>
                    <a href="javascript:void(1)" id="btn-qrcode-reader" style="font-size: 30px;color: green;"><i class="fa fa-qrcode"></i></a>
                </li>
                @endcan
            </ul>
        </header>

        <div class="c-body">
            <main class="c-main">


                <div class="container-fluid">

                    @if(session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                    @endif
                    @if($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @yield('content')

                </div>


            </main>
            <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
    <script src="https://unpkg.com/@coreui/coreui@3.2/dist/js/coreui.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script src="{{ asset('js/main-v7.js') }}"></script>
    <script>
        $(function() {
            let copyButtonTrans = '{{ trans('
            global.datatables.copy ') }}'
            let csvButtonTrans = '{{ trans('
            global.datatables.csv ') }}'
            let excelButtonTrans = '{{ trans('
            global.datatables.excel ') }}'
            let pdfButtonTrans = '{{ trans('
            global.datatables.pdf ') }}'
            let printButtonTrans = '{{ trans('
            global.datatables.print ') }}'
            let colvisButtonTrans = '{{ trans('
            global.datatables.colvis ') }}'
            let selectAllButtonTrans = '{{ trans('
            global.select_all ') }}'
            let selectNoneButtonTrans = '{{ trans('
            global.deselect_all ') }}'

            let languages = {
                'pt-br': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['{{ app()->getLocale() }}']
                },
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                    orderable: false,
                    searchable: false,
                    targets: -1
                }],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                /*buttons: [
                  {
                    extend: 'selectAll',
                    className: 'btn-primary',
                    text: selectAllButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    },
                    action: function(e, dt) {
                      e.preventDefault()
                      dt.rows().deselect();
                      dt.rows({ search: 'applied' }).select();
                    }
                  },
                  {
                    extend: 'selectNone',
                    className: 'btn-primary',
                    text: selectNoneButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'copy',
                    className: 'btn-default',
                    text: copyButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'csv',
                    className: 'btn-default',
                    text: csvButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'excel',
                    className: 'btn-default',
                    text: excelButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'pdf',
                    className: 'btn-default',
                    text: pdfButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'print',
                    className: 'btn-default',
                    text: printButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  },
                  {
                    extend: 'colvis',
                    className: 'btn-default',
                    text: colvisButtonTrans,
                    exportOptions: {
                      columns: ':visible'
                    }
                  }
                ]*/
            });

            $.fn.dataTable.ext.classes.sPageButton = '';
            $('.searchable-field').select2({
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route("admin.globalSearch") }}',
                    dataType: 'json',
                    type: 'GET',
                    delay: 200,
                    data: function(term) {
                        return {
                            search: term
                        };
                    },
                    results: function(data) {
                        return {
                            data
                        };
                    }
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
                templateResult: formatItem,
                templateSelection: formatItemSelection,
                placeholder: '{{ trans('
                global.search ') }}...',
                language: {
                    inputTooShort: function(args) {
                        var remainingChars = args.minimum - args.input.length;
                        var translation = '{{ trans('
                        global.search_input_too_short ') }}';

                        return translation.replace(':count', remainingChars);
                    },
                    errorLoading: function() {
                        return '{{ trans('
                        global.results_could_not_be_loaded ') }}';
                    },
                    searching: function() {
                        return '{{ trans('
                        global.searching ') }}';
                    },
                    noResults: function() {
                        return '{{ trans('
                        global.no_results ') }}';
                    },
                }

            });

            function formatItem(item) {
                if (item.loading) {
                    return '{{ trans('
                    global.searching ') }}...';
                }
                var markup = "<div class='searchable-link' href='" + item.url + "'>";
                markup += "<div class='searchable-title'>" + item.model + "</div>";
                $.each(item.fields, function(key, field) {
                    markup += "<div class='searchable-fields'>" + item.fields_formated[field] + " : " + item[field] + "</div>";
                });
                markup += "</div>";

                return markup;
            }

            function formatItemSelection(item) {
                if (!item.model) {
                    return '{{ trans('
                    global.search ') }}...';
                }
                return item.model;
            }
            $(document).delegate('.searchable-link', 'click', function() {
                var url = $(this).attr('href');
                window.location = url;
            });
        });
    </script>
    @canany(['io_veiculo_create', 'io_pessoa_create'])
    <script src="https://scanapp.org/assets/js/html5-qrcode.min.v2.2.0.js"></script>
    <script>
        $(function() {
            $("#btn-qrcode-reader-close").on('click', function(e) {
                e.preventDefault();
                $('#qr-reader-box').addClass('d-none');
                html5QrCode.stop().then((ignore) => {
                    // QR Code scanning is stopped.
                }).catch((err) => {
                    // Stop failed, handle it.
                });
            });


            $("#btn-qrcode-reader").on('click', function(e) {
                e.preventDefault();
                //$('#qr-code-action').remove(); 
                //acao=1 = entrada
                //acao=0 saida
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success btn-100',
                        denyButton: 'btn btn-danger btn-100'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: '<strong>O que deseja fazer?</strong>',
                    showDenyButton: true,
                    showCancelButton: false,
                    showConfirmButton: true,
                    confirmButtonText: "Registrar entrada",
                    denyButtonText: "Registrar saída",
                    cancelButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        qrCodeReader(1);
                    } else if (result.isDenied) {
                        qrCodeReader(0);
                    }

                });

            });

            function qrCodeReader(action) {
                $('#qr-reader-box').removeClass('d-none');
                var resultContainer = document.getElementById('qr-reader-results');
                var lastResult, countResults = 0;

                function onScanSuccess(decodedText, decodedResult) {
                    if (decodedText !== lastResult) {
                        ++countResults;
                        lastResult = decodedText;
                        // Handle on success condition with the decoded message.
                        var reader = decodedText.split("-");
                        if (reader[0] == "veiculo") {
                            window.location = '{{url("admin/io-veiculos/create?veiculo=")}}' + reader[1] + "&acao=" + action;
                        } else if (reader[0] == "user") {
                            window.location = '{{url("admin/io-pessoas/create?pessoa=")}}' + reader[1] + "&acao=" + action;
                        } else {
                            alert("Nada encontrado");
                            $("#btn-qrcode-reader-close").trigger("click");
                        }
                    }
                }

                var html5QrcodeScanner = new Html5QrcodeScanner(
                    "qr-reader", {
                        fps: 10,
                        qrbox: 250
                    });
                html5QrcodeScanner.render(onScanSuccess);
            }
        });
    </script>
    @endcan
    @yield('scripts')
</body>

</html>