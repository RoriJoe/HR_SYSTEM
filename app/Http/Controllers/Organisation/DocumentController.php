<?php namespace App\Http\Controllers\Organisation;

use Input, Session, App, Paginator, Redirect, DB;
use App\Http\Controllers\BaseController;
use Illuminate\Support\MessageBag;
use App\Console\Commands\Saving;
use App\Console\Commands\Getting;
use App\Models\Organisation;
use App\Models\Document;
use App\Models\Template;

class DocumentController extends BaseController 
{

	protected $controller_name 						= 'dokumen';

	public function index()
	{		

		if(Input::has('org_id'))
		{
			$org_id 								= Input::get('org_id');
		}
		else
		{
			$org_id 								= Session::get('user.organisation');
		}

		// if(!in_array($org_id, Session::get('user.orgids')))
		// {
		// 	App::abort(404);
		// }

		$search['id']								= $org_id;
		$sort 										= ['name' => 'asc'];
		$results 									= $this->dispatch(new Getting(new Organisation, $search, $sort , 1, 1));
		$contents 									= json_decode($results);		

		if(!$contents->meta->success)
		{
			App::abort(404);
		}

		$data 										= json_decode(json_encode($contents->data), true);

		$this->layout->page 						= view('pages.document.index', compact('data'));

		return $this->layout;
	}

	public function create($id = null)
	{
		if(Input::has('org_id'))
		{
			$org_id 							= Input::get('org_id');
		}
		else
		{
			$org_id 							= Session::get('user.organisation');
		}

		// if(!in_array($org_id, Session::get('user.orgids')))
		// {
		// 	App::abort(404);
		// }

		$search['id']							= $org_id;
		$sort 									= ['name' => 'asc'];
		$results 								= $this->dispatch(new Getting(new Organisation, $search, $sort , 1, 1));
		$contents 								= json_decode($results);		

		if(!$contents->meta->success)
		{
			App::abort(404);
		}

		$data 									= json_decode(json_encode($contents->data), true);

		$this->layout->page 					= view('pages.document.create', compact('id', 'data'));

		return $this->layout;
	}

	public function store($id = null)
	{
		if(Input::has('id'))
		{
			$id 								= Input::get('id');
		}
		
		$attributes 							= Input::only('name', 'tag', 'template');

		if(Input::has('org_id'))
		{
			$org_id 							= Input::get('org_id');
		}
		else
		{
			$org_id 							= Session::get('user.organisation');
		}

		// if(!in_array($org_id, Session::get('user.orgids')))
		// {
		// 	App::abort(404);
		// }

		$errors 								= new MessageBag();

		DB::beginTransaction();
		
		$content 								= $this->dispatch(new Saving(new Document, $attributes, $id, new Organisation, $org_id));

		$is_success 							= json_decode($content);
		if(!$is_success->meta->success)
		{
			$errors->add('Document', $is_success->meta->errors);
		}

		if(isset($attributes['templates']))
		{
			foreach ($attributes['templates'] as $key => $value) 
			{
				$template['field']				= $value['field'];
				$template['type']				= $value['type'];
				if(isset($value['id']) && $value['id']!='' && !is_null($value['id']))
				{
					$template['id']				= $value['id'];
				}
				else
				{
					$template['id']				= null;
				}

				$saved_template 				= $this->dispatch(new Saving(new Template, $template, $template['id'], new Document, $is_success->data->id));
				$is_success_2 					= json_decode($saved_template);
				if(!$is_success_2->meta->success)
				{
					$errors->add('Document', $is_success_2->meta->errors);
				}
			}
		}

		if(!$errors->count())
		{
			DB::commit();
			return Redirect::route('hr.documents.show', [$is_success->data->id, 'org_id' => $is_success->data->id])->with('alert_success', 'Dokumen "' . $is_success->data->name. '" sudah disimpan');
		}

		DB::rollback();
		return Redirect::back()->withErrors($errors)->withInput();
	}

	public function show()
	{
		$this->layout->page 	= view('pages.document.show');

		return $this->layout;
	}

	public function edit($id)
	{
		return $this->create($id);
	}

}