@section('area')
	@include('widgets.form.organisation_list', [
		'widget_template'	=> 'panel',
		'widget_options'	=> ['widget_title'		=> 'Pilih Organisasi :',
								'form_url'			=> route('hr.organisations.show', 1),
								'search'			=> [],
								'sort'				=> [],
								'page'				=> 1,
								'per_page'			=> 12,
								]
	])	
@stop