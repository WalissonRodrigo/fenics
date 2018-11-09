@extends('backpack::layout_vocational')

@section('header')
	<section class="content-header">
	  <h1>
			<span class="text-capitalize">Teste Vocacional</span>
	  </h1>
	</section>
@endsection

@section('style')
    <style>
        .screensave {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
        }
    </style>
    <style>
        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }
        
        .stepwizard-row {
            display: table-row;
        }
        
        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }
        
        .stepwizard-step button[disabled] {
            /*
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
            */
        }
        
        .stepwizard .btn.disabled,
        .stepwizard .btn[disabled],
        .stepwizard fieldset[disabled] .btn {
            opacity: 1 !important;
            color: #bbb;
        }
        
        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-index: 0;
        }
        
        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }
        
        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }
    </style>
@endsection

@section('screensave')
    <div id="screensave_{{$screensave['name']}}" class="hidden" >
        <video controls id="{{$screensave['name']}}" class="screensave" width="screen.width;" height="screen.height;" >
            <source src="{{$screensave['value']}}" loop="true" autoplay preload="auto" type="video/mp4"></source>
        </video>
    </div>
@endsection

@section('content')
    <div class="container">
    @if ($errors->any())
        <div class="callout callout-danger">
            <h4>{{ trans('backpack::crud.please_fix') }}</h4>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="stepwizard hidden">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Dados Pessoais</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-5" type="button" class="btn btn-default btn-circle" disabled="disabled">5</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-6" type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-7" type="button" class="btn btn-default btn-circle" disabled="disabled">7</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-8" type="button" class="btn btn-default btn-circle" disabled="disabled">8</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-9" type="button" class="btn btn-default btn-circle" disabled="disabled">9</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-10" type="button" class="btn btn-default btn-circle" disabled="disabled">10</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-11" type="button" class="btn btn-default btn-circle" disabled="disabled">11</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-12" type="button" class="btn btn-default btn-circle" disabled="disabled">12</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-13" type="button" class="btn btn-default btn-circle" disabled="disabled">13</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-14" type="button" class="btn btn-default btn-circle" disabled="disabled">14</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-15" type="button" class="btn btn-default btn-circle" disabled="disabled">15</a>
                    <p><small>Pergunta</small></p>
                </div>
                <div class="stepwizard-step col-xs-3">
                    <a href="#step-16" type="button" class="btn btn-default btn-circle" disabled="disabled">16</a>
                    <p><small>Pergunta</small></p>
                </div>
            </div>
        </div>

            
        <form method="post" action="{{ route('vocational.store') }}" onsubmit="return submitVal;" id="form-vocational">
        {!! csrf_field() !!}
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                <h3 class="panel-title">Dados Pessoais</h3>
            </div>
            <div class="panel-body required">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Nome Completo</label>
                        <input maxlength="100" name="name" type="text" required="required" class="form-control" placeholder="Digite seu nome completo" value="{{ old('name') }}"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">E-mail</label>
                        <input type="text" name="email" value="{{ old('email') }}" required="required" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Telefone Contato</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required="required" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Data de Nascimento</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" required="required" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Nível de Escolaridade</label>
                        <select name="schooling_id" style="width: 100%" required="required" class="form-control select2_field" placeholder="Selecione um Nível de Escolaridade">
                        <option value="1">Analfabeto</option>
                        <option value="2">Ensino Fundamental Completo</option>
                        <option value="3" selected>Ensino Médio Completo</option>
                        <option value="4">Ensino Superior Completo</option>
                        <option value="5">Pós Graduado Completo</option>
                        <option value="6">Mestrado Completo</option>
                        <option value="7">Doutorado Completo</option>
                        <option value="8">Ensino Fundamental Incompleto</option>
                        <option value="9">Ensino Médio Incompleto</option>
                        <option value="10">Ensino Superior Incompleto</option>
                        <option value="11">Pós Graduado Incompleto</option>
                        <option value="12">Mestrado Incompleto</option>
                        <option value="13">Doutorado Incompleto</option>
                    </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
                </div>
            </div>
        </div>
        @php($step = 1)
        @foreach($questions as $question)
        <div class="panel panel-primary setup-content" id="step-{{$step+1}}">
            <div class="panel-heading">
                <h3 class="panel-title">Pergunta {{$step}}/15</h3>
            </div>
            <div class="panel-body required">
                <div class="description" >
                    <div>
                        <label class="control-label">{!! $question->description !!}</label>
                    </div>
                    @php ($pointer = 1)
                    @foreach ($answers->where('question_id', $question->id) as $answer)
                    <div class="radio"> 
                        <label for="profile[{{$question->id}}]_{{$pointer}}">
                            <input type="radio" id="profile[{{$question->id}}]_{{$pointer}}" name="profile[{{$question->id}}]" value="{{$answer->profile_id}}" required >{{$answer->description}}
                        </label>
                    </div>
                    @php ($pointer++)                               
                    @endforeach
                </div>
                @if($step == $questions->count())
                <input type="hidden" name="save_action" value="save_and_new">
                @endif                
                <div class="col-md-12">
                    <button class="btn btn-default backBtn pull-left" type="button">Anterior</button>
                    @if($step == $questions->count())
                    <button class="btn btn-success pull-right" id="saveActions" type="submit">Finalizar <span class="fa fa-save" role="presentation" aria-hidden="true"></span></button>
                    @else
                    <button class="btn btn-primary nextBtn pull-right" type="button">Próximo</button>
                    @endif
                </div>
            </div>
        </div>
        @php ($step++)  
        @endforeach
        
        </form>
    </div>
@endsection

@section('after_scripts')
    <script src="{{ asset('js') }}/jquery.maskedinput.min.js"></script>
    <script src="{{ asset('js') }}/phone.js"></script>
    <script src="{{ asset('js') }}/steps-manager.js"></script>
    <script>
        var elem = document.getElementById("{{$screensave['name']}}");
        var divElem = document.querySelector("#screensave_{{$screensave['name']}}");
        var tQuest = {{$questions->count()}};
    </script>
@endsection

@section('after_styles')
    <link rel="stylesheet" href="{{ asset('/vendor/backpack') }}/crud/css/crud.css">
    <link rel="stylesheet" href="{{ asset('/vendor/backpack') }}/crud/css/form.css">
    <link rel="stylesheet" href="{{ asset('/vendor/backpack') }}/crud/css/create.css">
    <!-- CRUD FORM CONTENT - crud_fields_styles stack -->
    <!-- include select2 css-->
    <link href="{{ asset('/vendor/adminlte/bower_components/select2/dist') }}/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css') }}/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection