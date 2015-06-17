<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => ''], function()
{
	// ------------------------------------------------------------------------------------
	// LOGIN PAGE
	// ------------------------------------------------------------------------------------

	Route::group(['namespace' => 'Auth\\'], function() 
	{
		Route::get('/',		 				['uses' => 'LoginController@getLogin',				'as' => 'hr.login']);
		Route::get('/login', 				['uses' => 'LoginController@getLogin',				'as' => 'hr.login']);
		Route::post('/login',				['uses' => 'LoginController@postLogin',				'as' => 'hr.postlogin']);
		Route::get('/logout',				['uses' => 'LoginController@getLogout',				'as' => 'hr.logout']);
	});

	// ------------------------------------------------------------------------------------
	// LANDING PAGE (CHOOSE ORGANISATION OR CREATE ORGANISATION), SHOW ORGANISATION (STARTED WITH DASHBOARD)
	// ------------------------------------------------------------------------------------

	Route::resource('organisations',		'OrganisationController',							['names' => ['index' => 'hr.organisations.index', 'create' => 'hr.organisations.create', 'store' => 'hr.organisations.store', 'show' => 'hr.organisations.show', 'edit' => 'hr.organisations.edit', 'update' => 'hr.organisations.update', 'destroy' => 'hr.organisations.delete']]);

	Route::group(['namespace' => 'Organisation\\'], function() 
	{

	// ------------------------------------------------------------------------------------
	// BRANCHES RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('branches',				'BranchController',									['names' => ['index' => 'hr.branches.index', 'create' => 'hr.branches.create', 'store' => 'hr.branches.store', 'show' => 'hr.branches.show', 'edit' => 'hr.branches.edit', 'update' => 'hr.branches.update', 'destroy' => 'hr.branches.delete']]);

	// ------------------------------------------------------------------------------------
	// CALENDARS RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('calendars',			'CalendarController',								['names' => ['index' => 'hr.calendars.index', 'create' => 'hr.calendars.create', 'store' => 'hr.calendars.store', 'show' => 'hr.calendars.show', 'edit' => 'hr.calendars.edit', 'update' => 'hr.calendars.update', 'destroy' => 'hr.calendars.delete']]);

	// ------------------------------------------------------------------------------------
	// WORKLEAVES RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('workleaves',			'WorkleaveController',								['names' => ['index' => 'hr.workleaves.index', 'create' => 'hr.workleaves.create', 'store' => 'hr.workleaves.store', 'show' => 'hr.workleaves.show', 'edit' => 'hr.workleaves.edit', 'update' => 'hr.workleaves.update', 'destroy' => 'hr.workleaves.delete']]);

	// ------------------------------------------------------------------------------------
	// DOCUMENTS RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('documents',			'DocumentController',								['names' => ['index' => 'hr.documents.index', 'create' => 'hr.documents.create', 'store' => 'hr.documents.store', 'show' => 'hr.documents.show', 'edit' => 'hr.documents.edit', 'update' => 'hr.documents.update', 'destroy' => 'hr.documents.delete']]);

	// ------------------------------------------------------------------------------------
	// PERSONS RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('persons',				'PersonController',									['names' => ['index' => 'hr.persons.index', 'create' => 'hr.persons.create', 'store' => 'hr.persons.store', 'show' => 'hr.persons.show', 'edit' => 'hr.persons.edit', 'update' => 'hr.persons.update', 'destroy' => 'hr.persons.delete']]);

	// ------------------------------------------------------------------------------------
	// REPORTS RESOURCE
	// ------------------------------------------------------------------------------------

	Route::resource('reports',				'ReportController',									['names' => ['index' => 'hr.reports.index', 'create' => 'hr.reports.create', 'store' => 'hr.reports.store', 'show' => 'hr.reports.show', 'edit' => 'hr.reports.edit', 'update' => 'hr.reports.update', 'destroy' => 'hr.reports.delete']]);

	Route::group(['namespace' => 'Branch\\', 'prefix' => 'branch'], function() 
	{

		// ------------------------------------------------------------------------------------
		// CONTACTS FOR BRANCH RESOURCE
		// ------------------------------------------------------------------------------------

		Route::resource('contacts',			'ContactController',								['names' => ['index' => 'hr.branch.contacts.index', 'create' => 'hr.branch.contacts.create', 'store' => 'hr.branch.contacts.store', 'show' => 'hr.branch.contacts.show', 'edit' => 'hr.branch.contacts.edit', 'update' => 'hr.branch.contacts.update', 'destroy' => 'hr.branch.contacts.delete']]);

		// ------------------------------------------------------------------------------------
		// CHARTS FOR BRANCH RESOURCE
		// ------------------------------------------------------------------------------------

		Route::resource('charts',			'ChartController',									['names' => ['index' => 'hr.branch.charts.index', 'create' => 'hr.branch.charts.create', 'store' => 'hr.branch.charts.store', 'show' => 'hr.branch.charts.show', 'edit' => 'hr.branch.charts.edit', 'update' => 'hr.branch.charts.update', 'destroy' => 'hr.branch.charts.delete']]);

		// ------------------------------------------------------------------------------------
		// APIS FOR BRANCH RESOURCE
		// ------------------------------------------------------------------------------------

		Route::resource('apis',				'ApiController',									['names' => ['index' => 'hr.branch.apis.index', 'create' => 'hr.branch.apis.create', 'store' => 'hr.branch.apis.store', 'show' => 'hr.branch.apis.show', 'edit' => 'hr.branch.apis.edit', 'update' => 'hr.branch.apis.update', 'destroy' => 'hr.branch.apis.delete']]);

		// ------------------------------------------------------------------------------------
		// FINGER FOR BRANCH RESOURCE
		// ------------------------------------------------------------------------------------

		Route::resource('fingers',			'FingerController',									['names' => ['index' => 'hr.branch.fingers.index', 'create' => 'hr.branch.fingers.create', 'store' => 'hr.branch.fingers.store', 'show' => 'hr.branch.fingers.show', 'edit' => 'hr.branch.fingers.edit', 'update' => 'hr.branch.fingers.update', 'destroy' => 'hr.branch.fingers.delete']]);
	
	Route::group(['namespace' => 'Chart\\', 'prefix' => 'chart'], function() 
	{

		// ------------------------------------------------------------------------------------
		// AUTHENTICATIONS FOR CHART RESOURCE
		// ------------------------------------------------------------------------------------

		Route::resource('authentications',	'AuthenticationController',							['names' => ['index' => 'hr.chart.authentications.index', 'create' => 'hr.chart.authentications.create', 'store' => 'hr.chart.authentications.store', 'show' => 'hr.chart.authentications.show', 'edit' => 'hr.chart.authentications.edit', 'update' => 'hr.chart.authentications.update', 'destroy' => 'hr.chart.authentications.delete']]);

	});

	});

	});
});	

Blade::extend(function ($value, $compiler)
{
	$pattern = $compiler->createMatcher('time_indo');
	$replace = '<?php echo date("H:i", strtotime($2)); ?>';

	return preg_replace($pattern, '$1'.$replace, $value);
});
