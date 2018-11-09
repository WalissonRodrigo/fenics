@extends('backpack::layout_vocational')

@section('content-header')
	<section class="content-header">
	  <h1>
        <span class="text-capitalize">{{ $crud->entity_name_plural }}</span>
      </h1>
@endsection

@section('content')
	<!-- Default box -->
	  <div class="box">
	    <div class="box-header with-border">
	    	<span class="pull-right m-l-20 m-r-20 m-t-5"><a href="javascript: window.print();"><i class="fa fa-print"></i></a></span>

          @if ($crud->model->translationEnabled())
			    	<!-- Single button -->
					<div class="btn-group pull-right">
					  <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    {{trans('backpack::crud.language')}}: {{ $crud->model->getAvailableLocales()[$crud->request->input('locale')?$crud->request->input('locale'):App::getLocale()] }} <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					  	@foreach ($crud->model->getAvailableLocales() as $key => $locale)
						  	<li><a href="{{ url($crud->route.'/'.$entry->getKey()) }}?locale={{ $key }}">{{ $locale }}</a></li>
					  	@endforeach
					  </ul>
					</div>
					<h3 class="box-title" style="line-height: 30px;">{{ trans('backpack::crud.preview') .' '. $crud->entity_name }}</h3>
				@else
					<h3 class="box-title">{{ trans('backpack::crud.preview') .' '. $crud->entity_name }}</h3>
				@endif
	    </div>
	    <div class="box-body no-padding">
			<table class="table table-striped table-bordered">
		        <tbody>
		        @foreach ($crud->columns as $column)
		            <tr>
		                <td>
		                    <strong>{{ $column['label'] }}</strong>
		                </td>
                        <td>
							@if (!isset($column['type']))
		                      @include('crud::columns.text')
		                    @else
		                      @if(view()->exists('vendor.backpack.crud.columns.'.$column['type']))
		                        @include('vendor.backpack.crud.columns.'.$column['type'])
		                      @else
		                        @if(view()->exists('crud::columns.'.$column['type']))
		                          @include('crud::columns.'.$column['type'])
		                        @else
		                          @include('crud::columns.text')
		                        @endif
		                      @endif
		                    @endif
                        </td>
		            </tr>
		        @endforeach
				{{-- @if ($crud->buttons->where('stack', 'line')->count())
					<tr>
						<td><strong>{{ trans('backpack::crud.actions') }}</strong></td>
						<td>
							@include('crud::inc.button_stack', ['stack' => 'line'])
						</td>
					</tr>
				@endif --}}
		        </tbody>
			</table>
	    </div><!-- /.box-body -->
	  </div><!-- /.box -->

@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
	<script>
		var timeSleep = setInterval(() => {
			clearInterval(timeSleep);
			window.location.href = "{{ url('/') }}";
		}, 210000);
		document.addEventListener('keyup', e => {
			switch (e.key) {
				case "F2":
						resetInterval();
						window.location.href = "{{ url('/') }}";
						break;
				case "Enter":
						resetInterval();
						window.location.href = "{{ url('/') }}";
						break;
				default:
						resetInterval();
						break;
			}
		});
		document.addEventListener("mousemove", e => {
			resetInterval();
		});
		function resetInterval() {
			timeSleep = setInterval(() => {
				clearInterval(timeSleep);
					window.location.href = "{{ url('/') }}";
				}, 210000);
		}

	</script>
@endsection
