<?php namespace App\Models\Traits\BelongsTo;

trait HasBranchTrait {

	/**
	 * boot
	 *
	 * @return void
	 * @author 
	 **/

	function HasBranchTraitConstructor()
	{
		//
	}

	/* ------------------------------------------------------------------- RELATIONSHIP IN ORGANISATION PACKAGE -------------------------------------------------------------------*/

	public function Branch()
	{
		return $this->belongsTo('App\Models\Branch', 'branch_id');
	}

	public function scopeOrBranchName($query, $variable)
	{
		$query =  $query->selectraw('hr_charts.*')->selectraw('hr_branches.name as branchname')->join('branches', 'branches.id', '=', 'charts.branch_id');
		if(is_array($variable))
		{
			foreach ($variable as $key => $value) 
			{
				$query 		= $query->orwhere('branches.name', 'like' ,'%'.$value.'%');
			}

			return $query;
		}
		return $query->orwhere('branches.name', 'like', '%'.$variable.'%');
	}

	public function scopeOrganisationID($query, $variable)
	{
		return $query->WhereHas('branch.organisation', function($q)use($variable){
			if(is_array($variable))
			{
				$q->whereIn('organisations.id', $variable);

				return $q;
			}
			return $q->where('organisations.id', $variable);
		});
	}
}