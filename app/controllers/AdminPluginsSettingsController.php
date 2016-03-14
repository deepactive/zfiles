<?php 

namespace app\Controllers;

use View;
use Settings;


class AdminPluginsSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $data = array(
            'title' => 'Plugins Settings',
            'active' => 'plugins',
            'settings'=> Settings::find(1)

        );
        return View::make('admin.plugins')->with('data',$data);
	}

}
