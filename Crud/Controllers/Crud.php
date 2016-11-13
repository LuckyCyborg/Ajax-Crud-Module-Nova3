<?php
namespace App\Modules\Crud\Controllers;

use App\Core\BackendController;
use App\Modules\Crud\Models\Crud as CrudModel;
use Input;
use Request;
use Response;
use Assets;

class Crud extends BackendController
{
	public function index()
	{
		//all all recods and paginate the results
		$rows = CrudModel::orderby('id', 'desc')->paginate(1);
		
		//is there is an ajax call pass back the records as json
		if (Request::ajax()) {
            return Response::json($rows);
        }

        //set css paths
        ob_start();
        Assets::css('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css');
        $css = ob_get_clean();

        //set js paths
        ob_start();
        Assets::js([
        	resource_url('js/crud.js', 'crud'),
        	'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'
        ]);
        $js = ob_get_clean();

        //load view and pass in css and js paths
	    return $this->getView()
	    ->shares('title', 'Crud')
	    ->shares('css', $css)
	    ->shares('js', $js);
	}

	public function loadRecords()
	{
		//all all recods and paginate the results
	    $rows = CrudModel::orderby('id', 'desc')->paginate(1);

	    //set the table layout
	    echo "<table class='table table-striped table-hover table-bordered'>	
        <tr>
        	<th>Title</th>
        	<th>Comment</th>
        	<th>Action</th>
        </tr>";
        
        //loop through records the edit and delete link needs id for js to use then a edit / delete class used in crud.js
	    foreach ($rows as $row) {
	    	echo "<tr class='record'>";
	    		echo "<td>$row->title</td>";
	    		echo "<td>$row->comment</td>";
	    		echo "<td>
	    		<a href='#' id='$row->id' class='edit btn btn-warning btn-xs' data-toggle='modal' data-target='#edit'><i class='fa fa-edit'></i> Edit</a>
	    		<a href='#' id='$row->id' class='delete btn btn-danger btn-xs'><i class='fa fa-times'></i> Delete</a
	    		</td>";
	    	echo "</tr>";
	    }

	    echo "</table>";

	    //show page links
	    echo $rows->links();
	}

	/* Post methods: */

	public function store()
	{
		//only respond if ajax call
		if (Request::ajax()) {

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
			echo json_encode($data);
		}
	}

	public function edit($id)
	{
		if (Request::ajax()) {
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
			echo json_encode($data);
		}
		
	}

	public function update($id)
	{
		if (Request::ajax()) {
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
			echo json_encode($data);
		}
	}
	
	public function destroy($id)
	{
		if (Request::ajax()) {
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
			echo json_encode($data);
		}
		
	}

}