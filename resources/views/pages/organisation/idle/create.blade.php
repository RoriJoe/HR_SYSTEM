@section('nav_topbar')
	@include('widgets.common.nav_topbar', 
		['breadcrumb' 			=> 	[
										['name' => $data['name'], 'route' => route('hr.organisations.show', [$data['id'], 'org_id' => $data['id']]) ], 
										['name' => 'Pengaturan Idle', 'route' => route('hr.idles.index', ['org_id' => $data['id']]) ],
										['name' => (is_null($id) ? 'Tambah' : 'Ubah'), 'route' => (is_null($id) ? route('hr.idles.create', ['org_id' => $data['id']]) : route('hr.idles.edit', ['org_id' => $data['id'], 'id' => $id]) )]
									]
		])
@stop

@section('nav_sidebar')
	@include('widgets.common.nav_sidebar', [
		'widget_template'		=> 'plain',
		'widget_title'			=> 'Structure',		
		'widget_title_class'	=> 'text-uppercase ml-10 mt-20',
		'widget_body_class'		=> '',
		'widget_options'		=> [ 'sidebar' 					=>
										[
											'search'			=> [],
											'sort'				=> [],
											'page'				=> 1,
											'per_page'			=> 100,
											'pengaturan'		=> 'yes',
											'active_idle'		=> 'yes'
										]
									]
	])
@overwrite

@section('content_filter')
@overwrite

@section('content_body')	
	@include('widgets.idle.form', [
		'widget_template'		=> 'panel',
		'widget_title'			=> 'Idle',
		'widget_title_class'	=> 'text-uppercase ml-10 mt-20',
		'widget_body_class'		=> '',
		'widget_options'		=> [
									'idlelist' 				=>
										[	
											'form_url' 			=> route('hr.idles.store', ['id' => $id, 'org_id' => $data['id']]),
											'organisation_id'	=> $data['id'],
											'search'			=> ['id' => $id],
											'sort'				=> [],
											'page'				=> 1,
											'per_page'			=> 1,
											'route_edit'		=> route('hr.idles.index', ['org_id' => $data['id']])
										]
									]
	])

@overwrite

@section('content_footer')
@overwrite