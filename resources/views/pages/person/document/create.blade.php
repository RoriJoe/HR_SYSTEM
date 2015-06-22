@section('nav_topbar')
	@include('widgets.common.nav_topbar', 
	['breadcrumb' => [
						['name' => $data['name'], 'route' => route('hr.organisations.show', [$data['id'], 'org_id' => $data['id']]) ], 
						['name' => $person['name'], 'route' => route('hr.persons.show', ['id' => $person['id'], 'person_id' => $person['id'],'org_id' => $data['id'] ])], 
						['name' => 'Dokumen', 'route' => route('hr.person.documents.index', ['id' => $person['id'], 'person_id' => $person['id'],'org_id' => $data['id'] ])], 
					]
	])
@stop

@section('nav_sidebar')
	@include('widgets.common.nav_sidebar', [
		'widget_template'		=> 'plain',
		'widget_title'			=> 'Structure',		
		'widget_title_class'	=> 'text-uppercase ml-10 mt-20',
		'widget_body_class'		=> '',
		'widget_options'		=> 	[
										'sidebar'				=> 
										[
											'search'			=> [],
											'sort'				=> [],
											'page'				=> 1,
											'per_page'			=> 12,
										]
									]
	])
@overwrite

@section('content_filter')
@overwrite

@section('content_body')	
	@include('widgets.person.document.form', [
		'widget_template'	=> 'panel',
		'widget_options'	=> 	[
									'documentlist'			=>
									[
										'form_url'			=> route('hr.person.documents.store', ['id' => $id, 'person_id' => $person['id'], 'org_id' => $data['id']]),
										'search'			=> ['id' => $id, 'withattributes' => ['document', 'details', 'details.template']],
										'sort'				=> [],
										'page'				=> 1,
										'per_page'			=> 1,
										'route_back'	 	=> route('hr.persons.show', [$person['id'], 'org_id' => $data['id']])
									]
								]
	])

@overwrite

@section('content_footer')
@overwrite