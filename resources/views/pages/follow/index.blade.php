@section('nav_topbar')
	@include('widgets.common.nav_topbar', 
	['breadcrumb' => [
						['name' => $data['name'], 'route' => route('hr.organisations.show', [$data['id'], 'org_id' => $data['id']]) ], 
						['name' => $branch['name'], 'route' => route('hr.branches.show', ['id' => $branch['id'], 'branch_id' => $branch['id'],'org_id' => $data['id'] ])], 
						['name' => $chart['name'], 'route' => route('hr.branch.charts.index', ['id' => $branch['id'], 'branch_id' => $branch['id'],'org_id' => $data['id'] ])], 
						['name' => 'Kalender', 'route' => route('hr.chart.calendars.index', ['id' => $branch['id'], 'branch_id' => $branch['id'],'org_id' => $data['id'] ])], 
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
											'per_page'			=> 12
										]
									]
	])
@overwrite

@section('content_body')

			@include('widgets.follow.table', [
				'widget_template'		=> 'panel',
				'widget_title'			=> $chart['name'],
				'widget_options'		=> 	[
												'followlist'		=>
												[
													'search'			=> ['chartid' => $chart['id'], 'withattributes' => ['calendar']],
													'sort'				=> [],
													'page'				=> 1,
													'per_page'			=> 12
												]
											]
			])
@overwrite

@section('content_filter')
@overwrite

@section('content_footer')
@overwrite