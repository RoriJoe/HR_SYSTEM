<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Database\Schema\Blueprint;
use Schema;
use App\Models\Calendar;
use App\Models\Chart;
use App\Models\ChartWorkleave;
use App\Models\PersonWorkleave;
use DB, Hash;

class HRSUpdateCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'hr:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update HR System.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$result 		= $this->update29122015();
		
		return true;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['example', InputArgument::REQUIRED, 'An example argument.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [
			['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}

	/**
	 * update 1st version
	 *
	 * @return void
	 * @author 
	 **/
	public function update29122015()
	{
		Schema::table('tmp_queues', function(Blueprint $table) 
		{
			$table->index(['deleted_at', 'process_number', 'process_name']);
		});

		Schema::table('logs', function(Blueprint $table) 
		{
			$table->index(['deleted_at', 'on']);
		});

		Schema::table('error_logs', function(Blueprint $table) 
		{
			$table->index(['deleted_at', 'on']);
		});
		
		return true;
	}
}
