<?php namespace App\Models\Observers;

use Illuminate\Support\Facades\Validator;
use \App\Models\Chart;
use \App\Models\Menu;
use \App\Models\Authentication;

/* ----------------------------------------------------------------------
 * Event:
 * 	Created						
 * 	Saving						
 * 	Updated						
 * 	Deleting						
 * ---------------------------------------------------------------------- */

class ChartObserver 
{
	public function created($model)
	{
		if(!isset($model['attributes']['path']) || ($model['attributes']['path']==$model['attributes']['id']))
		{
			$newparent 						= Chart::where('id',  $model['attributes']['id'])->update(['path' => $model['attributes']['id']]);
		}
		else
		{
			$newparent 						= Chart::where('path',  $model['attributes']['path'])->first();
			$new 							= Chart::where('id', $model['attributes']['id'])->update(['path' => $model['attributes']['path'].','.$model['attributes']['id'], 'chart_id' => $newparent['id']]);
		}
		return true;
	}

	public function saving($model)
	{
		$validator 							= Validator::make($model['attributes'], $model['rules']);

		if ($validator->passes())
		{
			return true;
		}
		else
		{
			$model['errors'] 				= $validator->errors();

			return false;
		}
	}

	public function saved($model)
	{
		//if(isset($model['attributes']['path']) && ($model['attributes']['path']==$model['attributes']['id']))
		//{
			//$apps 								= Menu::get(['id']);
			//foreach ($apps as $key => $value) 
			//{
			//	$updates 						= $model->menus()->attach($value->id, ['create' => true, 'read' => true, 'update' => true, 'delete' => true]);
			//}
		//}
	}

	public function updated($model)
	{
		//
		if(isset($model->getDirty()['path']))
		{
			$updates 						= Chart::where('path', 'like', $model->getOriginal('path').'%')->get();
			$newparent 						= Chart::where('path',  $model['attributes']['path'])->first();
			foreach ($updates as $key => $value) 
			{
				$new 						= Chart::where('id', $value['id'])->update(['path' => (str_replace($model['attributes']['path'], $model->getOriginal('path'), $value['path']))]);
			}
			$updatechartid 					= Chart::where('id',  $model['attributes']['id'])->update(['chart_id' => $newparent['id'], 'path' => $newparent['path'].','.$model['attributes']['id']]);
		}
		return true;
		
	}

	public function deleting($model)
	{
		//
		if(count(explode(',', $model['attributes']['path']))==1 && $model['attributes']['tag']!='admin')
		{
			$model['errors'] 				= ['Tidak dapat menghapus posisi/departemen tertinggi diperusahaan'];

			return false;
		}

		//$deletes 							= Chart::where('path', 'like', $model['attributes']['path'].'%')->where('current_employee','>', 0)->get(['id']);
		//if(count($deletes)  && $model['attributes']['tag']!='admin')
		//{
		//	$model['errors'] 				= ['Tidak dapat menghapus posisi/departemen dengan pekerja yang masih aktif bekerja'];

		//	return false;
		//}
		$deletes 							= Chart::where('path', 'like', $model['attributes']['path'].'%')->with(['menus'])->get();

		//$apps 								= Menu::get(['id']);
		foreach ($deletes as $key => $value) 
		{
			if($value['attributes']['current_employee']>0&& $model['attributes']['tag']!='admin')
			{
				$model['errors'] 				= ['Tidak dapat menghapus posisi/departemen dengan pekerja yang masih aktif bekerja'];

				return false;
			}
			
			foreach($value['menus'] as $key2 => $value2)
			{
				$auth 	 	= new Authentication;
				$delete 		= $auth->find($value2['pivot']['id']);

				if($delete && !$delete->delete())
				{
					$model['errors']	= $delete->getError();
						
					return false;
				}
			}
		}
		return true;
	}
}