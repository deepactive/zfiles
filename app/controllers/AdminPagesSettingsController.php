<?php

namespace app\Controllers;

use View;
use DB;
use Settings;
use Pages;
use Input;
use Validator;
use Session;
use Redirect;

class AdminPagesSettingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $data = array(
            'title' => 'Pages Settings',
            'active' => 'pages',
            'settings'=> Settings::find(1),
            'pages'=> DB::table('pages')
                    ->orderBy('id','asc')
                    ->paginate(40)
        );
        
        return View::make('admin.pages')->with('data',$data);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $data = array(
            'title' => ' Create Page ',
            'active' => 'pages',
            'settings'=> Settings::find(1)        
        );
        
        return View::make('admin.createPage')->with('data',$data);

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        
        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'pageName' => $input['pageName'], 
                'pageOrder' => $input['pageOrder'],
                'pageTitle' => $input['pageTitle'],
                'pageContent' => $input['pageContent']
            ),
            
            array(
                'pageName' => 'required|min:3|',
                'pageOrder' => 'required|numeric',
                'pageTitle' => 'required|min:3',
                'pageContent' => 'required|min:10'
                
            )
        );
            
        if ($validator->fails()){

            return Redirect::back()->withInput()->withErrors($validator);
            
        }else{
            
            $save = new Pages;
            
            $save->pageName       = $input['pageName'];
            $save->pageOrder      = $input['pageOrder'];
            $save->pageTitle    = $input['pageTitle'];
            $save->pageContent       = $input['pageContent'];
            

            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::to('admin/pages');
            }
        }

        
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($name)
	{
		//
        
        $page = DB::table('pages')
            ->where('pageName','=',$name)
            ->first();
        
        if(count($page) == ''){
            return View::make('home.404');
        }
        
        $data = array(
            'title' => ' Edit Page ',
            'active' => 'pages',
            'settings'=> Settings::find(1),
            'page'=> $page
        );
        
        return View::make('home.page')->with('data',$data);

	
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $data = array(
            'title' => ' Edit Page ',
            'active' => 'pages',
            'settings'=> Settings::find(1),
            'page'=> Pages::find($id)
        );
        
        return View::make('admin.editPage')->with('data',$data);

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		        
        $input = Input::all();
        
        $validator = Validator::make( 
            array(
                'pageName' => $input['pageName'], 
                'pageOrder' => $input['pageOrder'],
                'pageTitle' => $input['pageTitle'],
                'pageContent' => $input['pageContent']
            ),
            
            array(
                'pageName' => 'required|min:3|',
                'pageOrder' => 'required|numeric',
                'pageTitle' => 'required|min:3',
                'pageContent' => 'required|min:10'
                
            )
        );
            
        if ($validator->fails()){

            return Redirect::back()->withInput()->withErrors($validator);
            
        }else{
            
            $save = Pages::find($id);
            
            $save->pageName       = $input['pageName'];
            $save->pageOrder      = $input['pageOrder'];
            $save->pageTitle    = $input['pageTitle'];
            $save->pageContent       = $input['pageContent'];
            

            if( $save->save() ){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Your Action has been Successfully Updated.
                </div>
                ');
                
                return Redirect::to('admin/pages');
            }
        }

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $delete = Pages::destroy($id);
        
        if($delete){
                
                Session::flash('Message','
                <div id="message-alert" class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <strong>Well!</strong> 
                  Page Action has been Successfully Deleted.
                </div>
                ');
                
                return Redirect::to('admin/pages');
        }
	}


}
