<?php namespace App\Models;

/* ----------------------------------------------------------------------
 * Document Model:
 * 	ID 								: Auto Increment, Integer, PK
 * 	organisation_id 				: Required, Integer, FK from Organisation
 * 	name 							: Varchar, 255, Required
 *	created_at						: Timestamp
 * 	updated_at						: Timestamp
 * 	deleted_at						: Timestamp
 * 
/* ----------------------------------------------------------------------
 * Document Relationship :
 * 	//this package
 	1 Relationship belongsTo 
	{
		Organisation
	}

 	1 Relationship hasMany 
	{
		Charts
	}

 * 	//other package
 	1 Relationship morphMany 
	{
		Contacts
	}
 * ---------------------------------------------------------------------- */

use Str, Validator, DateTime, Exception;

class Branch extends BaseModel {

	use \App\Models\Traits\HasMany\HasChartsTrait;
	use \App\Models\Traits\HasMany\HasApisTrait;
	use \App\Models\Traits\HasOne\HasFingerPrintTrait;
	use \App\Models\Traits\BelongsTo\HasOrganisationTrait;
	use \App\Models\Traits\MorphMany\HasOfficeContactsTrait;

	public 		$timestamps 		= 	true;

	protected 	$table 				= 	'branches';

	protected 	$fillable			= 	[
											'name' 							,
										];
										
	protected	$dates 				= 	['created_at', 'updated_at', 'deleted_at'];

	protected 	$rules				= 	[
											'name' 							=> 'required|max:255',
										];

	public $searchable 				= 	[
											'id' 							=> 'ID', 
											'organisationid'	 			=> 'OrganisationID',
											'name' 							=> 'Name', 
											'currentcontact' 				=> 'CurrentContact',
											'checkcreate' 					=> 'CheckCreate',
											'countresign' 					=> 'CountResign',
											'countworkerbystatus'			=> 'CountWorkerByStatus',
											'countworkerbybranchbystatus'	=> 'CountWorkerByBranchByStatus',
											'structure' 					=> 'Structure',
											'structurebydepartment' 		=> 'StructureByDepartment',
											'displaydepartments' 			=> 'DisplayDepartments',
											'groupcontacts' 				=> 'GroupContacts',
											'withattributes' 				=> 'WithAttributes'
										];

	public $sortable 				= 	['id', 'name', 'created_at', 'branches.created_at'];
	
	protected $appends				= 	['has_contacts', 'has_charts'];

	/* ---------------------------------------------------------------------------- CONSTRUCT ----------------------------------------------------------------------------*/
	/**
	 * boot
	 *
	 * @return void
	 * @author 
	 **/
	static function boot()
	{
		parent::boot();

		Static::saving(function($data)
		{
			$validator = Validator::make($data->toArray(), $data->rules);

			if ($validator->passes())
			{
				return true;
			}
			else
			{
				$data->errors = $validator->errors();
				return false;
			}
		});
	}

	/* ---------------------------------------------------------------------------- ERRORS ----------------------------------------------------------------------------*/
	/**
	 * return errors
	 *
	 * @return MessageBag
	 * @author 
	 **/
	function getError()
	{
		return $this->errors;
	}

	/* ---------------------------------------------------------------------------- QUERY BUILDER ---------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- MUTATOR ---------------------------------------------------------------------------------*/

	/* ---------------------------------------------------------------------------- ACCESSOR --------------------------------------------------------------------------------*/
	public function getHasContactsAttribute($value)
	{
		if(isset($this->getRelations()['contacts']) && count($this->getRelations()['contacts']))
		{
			return true;
		}
		return false;
	}

	public function getHasChartsAttribute($value)
	{
		if(isset($this->getRelations()['charts']) && count($this->getRelations()['charts']))
		{
			return true;
		}
		return false;
	}
	/* ---------------------------------------------------------------------------- FUNCTIONS -------------------------------------------------------------------------------*/
	
	/* ---------------------------------------------------------------------------- SCOPE -------------------------------------------------------------------------------*/

	public function scopeID($query, $variable)
	{
		return $query->where('id', $variable);
	}

	public function scopeName($query, $variable)
	{
		return $query->where('name', 'like' ,'%'.$variable.'%');
	}

	public function scopeOrganisationID($query, $variable)
	{
		if(is_null($variable))
		{
			return $query;
		}
		
		return $query->where('organisation_id', $variable);
	}

	public function scopeCheckCreate($query, $variable)
	{
		if(!is_array($variable))
		{
			return $query->where('created_at', '>=', $variable);
		}
		return $query->where('created_at', '>=', $variable[0])
					->where('created_at', '<=', $variable[1]);
	}

	public function scopeWithAttributes($query, $variable)
	{
		if(!is_array($variable))
		{
			$variable 			= [$variable];
		}
		return $query->with($variable);
	}
}
