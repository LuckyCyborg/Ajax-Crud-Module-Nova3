<?php
namespace App\Modules\Crud\Controllers;

use Nova\Routing\Controller;
use App\Modules\Crud\Models\Crud as CrudModel;
use Input;
use Request;
use Response;

class Ajax extends Controller
{
	/* Post methods: */

	public function store()
	{
		//get form data
		$input = Input::all();

		//if title is less then 3 chars create an error key in array
		if (strlen($input['title']) < 3) {
			$error['title'] = 'Title is too short.';
		}

		//if comment is less then 3 chars create an error key in array
		if (strlen($input['comment']) < 3) {
			$error['comment'] = 'Please enter a comment.';
		}
	
	    if (! isset($error)) {

	    	$model = new CrudModel;
	    	$model->title = $input['title'];
	    	$model->comment = $input['comment'];
	    	$model->save();

	    	$data['success'] = true;
	    	$data['message'] = 'Success!';
	    	
	    } else {

	    	$data['success'] = false;
	    	$data['errors'] = $error;
		}

		// return all our data to an AJAX call
	    return Response::json($data);
		
	}

	public function edit($id)
	{
	    $crud = CrudModel::find($id);

	    if ($crud === null) {
	    	$data['success'] = false;
	    	$error['error'] = 'record not found!.';
		} else {
	    	$data['success'] = true;
	    	$data['message'] = 'Success!';
	    	$data['title'] = $crud->title;
	    	$data['comment'] = $crud->comment;
		}

		// return all our data to an AJAX call
	    return Response::json($data);
	}

	public function update($id)
	{
		$crud = CrudModel::find($id);

		if ($crud === null) {
	    	$data['success'] = false;
	    	$error['error'] = 'record not found!.';
		} else {

			$input = Input::all();

			if (strlen($input['title']) < 3) {
				$error['title'] = 'Title is too short.';
			}

			if (strlen($input['comment']) < 3) {
				$error['comment'] = 'Please enter a comment.';
			}
		
		    if (! isset($error)) {

				$crud->title = $input['title'];
		    	$crud->comment = $input['comment'];
		    	$crud->save();

	    		$data['success'] = true;
	    		$data['message'] = 'Success!';

	    	} else {

		    	$data['success'] = false;
		    	$data['errors'] = $error;
			}
		}
	    
	    // return all our data to an AJAX call
	    return Response::json($data);
	}
	
	public function destroy($id)
	{
	    $crud = CrudModel::find($id);

	    if ($crud === null) {
	    	$data['success'] = false;
	    	$error['error'] = 'record not found!.';
		} else {
			$crud->delete();
	    	$data['success'] = true;
	    	$data['message'] = 'Success!';
		}

		// return all our data to an AJAX call
	    return Response::json($data);	
	}
}