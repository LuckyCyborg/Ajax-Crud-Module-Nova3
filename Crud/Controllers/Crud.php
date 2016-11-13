<?php
namespace App\Modules\Crud\Controllers;

use App\Core\BackendController;
use App\Modules\Crud\Models\Crud as CrudModel;
use Input;
use Request;
use Response;
use Assets;
use View;

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

	    $content = View::fetch('Crud/LoadRecords', ['rows' => $rows], 'Crud');
	    return Response::make($content);
	}
}