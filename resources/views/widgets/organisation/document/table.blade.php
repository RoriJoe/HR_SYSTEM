@extends('widget_templates.'.($widget_template ? $widget_template : 'plain'))

@if (!$widget_error_count)
	@section('widget_title')
	<h1> {!! $widget_title  or 'Template Dokumen' !!} </h1>
	<small>Total data {{$DocumentComposer['widget_data']['documentlist']['document-pagination']->total()}}</small>
	
	<div class="clearfix">&nbsp;</div>
	@if(!is_null($DocumentComposer['widget_data']['documentlist']['active_filter']))
		@foreach($DocumentComposer['widget_data']['documentlist']['active_filter'] as $key => $value)
			<span class="active-filter">{{$value}}</span>
		@endforeach
	@endif

	@overwrite

	@section('widget_body')
		<a href="{{ $DocumentComposer['widget_data']['documentlist']['route_create'] }}" class="btn btn-primary">Tambah Data</a>
		@if(isset($DocumentComposer['widget_data']['documentlist']['document']))
			<div class="clearfix">&nbsp;</div>
			<table class="table table-hover table-affix">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Dokumen</th>
						<th>Kategori</th>
						<th>&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = $DocumentComposer['widget_data']['documentlist']['document-display']['from'];?>
					@forelse($DocumentComposer['widget_data']['documentlist']['document'] as $key => $value)
						<tr>
							<td>
								{{$i}}
							</td>
							<td>
								{{$value['name']}}
							</td>
							<td>
								{{$value['tag']}}
							</td>
							<td class="text-right">
								@if((int)Session::get('user.menuid') <= 2)
									<a href="javascript:;" class="btn btn-default" data-toggle="modal" data-target="#delete" data-delete-action="{{ route('hr.documents.delete', [$value['id'], 'org_id' => $data['id']]) }}"><i class="fa fa-trash"></i></a>
								@endif
								@if((int)Session::get('user.menuid') <= 3)
									<a href="{{route('hr.documents.edit', [$value['id'], 'org_id' => $data['id']])}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
								@endif
								<a href="{{route('hr.documents.show', [$value['id'], 'org_id' => $data['id']])}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
							</td>
						</tr>
						<?php $i++;?>
					@empty 
						<tr>
							<td class="text-center" colspan="4">Tidak ada data</td>
						</tr>
					@endforelse
				</tbody>
			</table>

			<div class="row">
				<div class="col-sm-12 text-center">
					<p>Menampilkan {!!$DocumentComposer['widget_data']['documentlist']['document-display']['from']!!} - {!!$DocumentComposer['widget_data']['documentlist']['document-display']['to']!!}</p>
					{!!$DocumentComposer['widget_data']['documentlist']['document-pagination']->appends(Input::all())->render()!!}
				</div>
			</div>

			<div class="clearfix">&nbsp;</div>
		@endif
	@overwrite
@else
	@section('widget_title')
	@overwrite

	@section('widget_body')
	@overwrite
@endif