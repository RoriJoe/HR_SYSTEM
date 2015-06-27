<?php namespace App\Providers;

use View;
use Illuminate\Support\ServiceProvider;

class WidgetComposerServiceProvider extends ServiceProvider {

	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->admin_widget();
		$this->web_widget();
	}

	/**
	 * Register
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	private function admin_widget()
	{
		// -----------------------------------------------------------------------------
		// COMMON
		// -----------------------------------------------------------------------------
		// View::composer(['admin.widgets.common.logo'], 'App\Http\ViewComposers\Admin\Common\LogoComposer');
		// View::composer(['admin.widgets.common.nav.menu'], 'App\Http\ViewComposers\Admin\Common\MenuComposer');

		// -----------------------------------------------------------------------------
		// LOGIN
		// -----------------------------------------------------------------------------
		View::composer(['widgets.form.form_login'], 'App\Http\ViewComposers\Common\LoginFormComposer');

		// -----------------------------------------------------------------------------
		// ORGANISATION
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.select', 'widgets.common.sidebar', 'widgets.organisation.form'], 	'App\Http\ViewComposers\OrganisationComposer');

		// -----------------------------------------------------------------------------
		// BRANCH
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.branch.table', 'widgets.organisation.branch.form', 'widgets.organisation.branch.stat.total_branch'], 	'App\Http\ViewComposers\BranchComposer');

		// -----------------------------------------------------------------------------
		// CALENDAR
		// -----------------------------------------------------------------------------
		View::composer(['widgets.calendar.table', 'widgets.calendar.form', 'widgets.calendar.calendar', 'widgets.calendar.select'], 	'App\Http\ViewComposers\CalendarComposer');

		// -----------------------------------------------------------------------------
		// WORKLEAVE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.workleave.table', 'widgets.workleave.form', 'widgets.workleave.select'], 	'App\Http\ViewComposers\WorkleaveComposer');

		// -----------------------------------------------------------------------------
		// DOCUMENT
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.document.table', 'widgets.organisation.document.form', 'widgets.organisation.document.select', 'widgets.organisation.person.document.form', 'widgets.organisation.document.stat.total_document'], 	'App\Http\ViewComposers\DocumentComposer');

		// -----------------------------------------------------------------------------
		// IDLE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.idle.table', 'widgets.idle.form'], 	'App\Http\ViewComposers\IdleComposer');

		// -----------------------------------------------------------------------------
		// PERSON
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.person.table', 'widgets.organisation.person.form', 'widgets.organisation.person.select', 'widgets.report.attendance.table', 'widgets.report.wage.table', 'widgets.organisation.person.stat.total_employee', 'widgets.organisation.person.stat.average_loss_rate'], 	'App\Http\ViewComposers\PersonComposer');

		// -----------------------------------------------------------------------------
		// CONTACT
		// -----------------------------------------------------------------------------
		View::composer(['widgets.contact.table', 'widgets.contact.form'], 	'App\Http\ViewComposers\ContactComposer');

		// -----------------------------------------------------------------------------
		// CHART
		// -----------------------------------------------------------------------------
		View::composer(['widgets.chart.list', 'widgets.chart.form', 'widgets.chart.stat', 'widgets.chart.select'], 	'App\Http\ViewComposers\ChartComposer');

		// -----------------------------------------------------------------------------
		// API
		// -----------------------------------------------------------------------------
		View::composer(['widgets.api.table', 'widgets.api.form'], 	'App\Http\ViewComposers\ApiComposer');

		// -----------------------------------------------------------------------------
		// FINGERPRINT
		// -----------------------------------------------------------------------------
		View::composer(['widgets.fingerprint.table', 'widgets.fingerprint.form', 'widgets.fingerprint.block'], 	'App\Http\ViewComposers\FingerPrintComposer');

		// -----------------------------------------------------------------------------
		// AUTHENTICATION
		// -----------------------------------------------------------------------------
		View::composer(['widgets.authentication.table', 'widgets.authentication.form'], 	'App\Http\ViewComposers\ApplicationComposer');

		// -----------------------------------------------------------------------------
		// FOLLOW
		// -----------------------------------------------------------------------------
		View::composer(['widgets.follow.table', 'widgets.follow.form', 'widgets.calendar.chart.table', 'widgets.calendar.chart.form'], 	'App\Http\ViewComposers\FollowComposer');

		// -----------------------------------------------------------------------------
		// SCHEDULE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.schedule.table', 'widgets.schedule.form'], 	'App\Http\ViewComposers\ScheduleComposer');

		// -----------------------------------------------------------------------------
		// WORK
		// -----------------------------------------------------------------------------
		View::composer(['widgets.work.table', 'widgets.work.form', 'widgets.work.experience.form'], 	'App\Http\ViewComposers\WorkComposer');

		// -----------------------------------------------------------------------------
		// PERSON WORKLEAVE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.person.workleave.table', 'widgets.organisation.person.workleave.form', 'widgets.workleave.chart.form'], 	'App\Http\ViewComposers\PersonWorkleaveComposer');

		// -----------------------------------------------------------------------------
		// PERSON DOCUMENT
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.person.document.table'], 	'App\Http\ViewComposers\PersonDocumentComposer');

		// -----------------------------------------------------------------------------
		// RELATIVE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.person.relative.table', 'widgets.organisation.person.relative.form', 'widgets.organisation.person.relative.employee.form'], 	'App\Http\ViewComposers\RelativeComposer');

		// -----------------------------------------------------------------------------
		// TEMPLATE
		// -----------------------------------------------------------------------------
		View::composer(['widgets.organisation.document.template.table', 'widgets.organisation.document.template.form'], 	'App\Http\ViewComposers\TemplateComposer');
	}

	private function web_widget()
	{
		// -----------------------------------------------------------------------------
		// 
		// -----------------------------------------------------------------------------
		// View::composer('web.widgets.headline_carousel', 'App\Http\ViewComposers\Web\HeadlineComposer');
		// View::composer('web.widgets.tour_list', 'App\Http\ViewComposers\Web\TourListComposer');
		// View::composer('web.widgets.latest_blog', 'App\Http\ViewComposers\Web\BlogListComposer');
		// View::composer('web.widgets.trending_destination', 'App\Http\ViewComposers\Web\TrendingDestinationComposer');
		// View::composer('web.widgets.supported_by', 'App\Http\ViewComposers\Web\VendorListComposer');
		// View::composer('web.widgets.search_tour', 'App\Http\ViewComposers\Web\TourFilterComposer');
	}

}