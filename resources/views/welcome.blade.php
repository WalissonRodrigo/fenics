<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        
        .full-height {
            height: 100vh;
        }
        
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
        
        .position-ref {
            position: relative;
        }
        
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }
        
        .content {
            text-align: center;
        }
        
        .title {
            font-size: 84px;
        }
        
        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }
        
        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        @section('content')
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <!-- Default box -->
                @include('crud::inc.grouped_errors')
                <form method="post" action="{{ url($crud->route) }}" @if ($crud->hasUploadFields('createVocational')) enctype="multipart/form-data" @endif > {!! csrf_field() !!}
                    <div class="box">

                        <div class="box-header with-border">
                            <h3 class="box-title">Preencha Todos os Campos</h3>
                        </div>
                        <div class="box-body row display-flex-wrap" style="display: flex; flex-wrap: wrap;">
                            <!-- load the view from the application if it exists, otherwise load the one in the package -->
                            @if(view()->exists('vendor.backpack.crud.form_content')) @include('vendor.backpack.crud.form_content', [ 'fields' => $crud->getFields('create'), 'action' => 'create' ]) @else @include('crud::form_content', [ 'fields' => $crud->getFields('create'), 'action'
                            => 'create' ]) @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">

                            @include('crud::inc.form_save_button_vocational')

                        </div>
                        <!-- /.box-footer-->

                    </div>
                    <!-- /.box -->
                </form>
            </div>
        </div>
        @endsection
    </div>
</body>

</html>