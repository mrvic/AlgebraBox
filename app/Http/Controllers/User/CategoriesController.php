<?php

namespace App\Http\Controllers\User;
use Session;
use Sentinel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sections;
use App\Models\Categories;
use App\Models\Users;
use App\Models\CategorieUser;



class CategoriesController extends Controller
{
	
	
	public function __construct()
    {
        // Middleware
        $this->middleware('sentinel.auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
	
    {
		
		$categories = Categories::all();
		
		
        return view('user.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    	$sections = sections::all();
		
        return view('user.categories.create', ['sections' => $sections]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		 // Unos u tablicu categories
        $categories = new Categories();
        $categories->name = $request->name;
		$categories->sections_id = $request->sections_id;
        $categories->save();
		
		// Unos u pivot tablicu users_categories
		
	    $user = Sentinel::getUser()->id;
		
		$users_categories = new CategorieUser();
		$users_categories->user_id = $user;
		$users_categories->categorie_id = $categories->id;
		$users_categories->save();
		
		
		// return na list
		
       session()->flash('success', "New category '{$categories->name}' has been created.");
       return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$categories = Categories::find($id);
		$sections = Sections::all();
		
        return view('user.categories.edit', compact('categories', 'sections')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
		$categories = Categories::find($id);
		$categories->name = $request->name;
		$categories->sections_id = $request->sections_id;
		$categories->save();
		
      
      
      //redirect page after save data
      return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $categories = Categories::find($id);
        $categories->delete();

        // redirect
		//session()->flash('success', "Category '{$categories->name}' has been deleted.");
        return redirect()->route('categories.index');
    }
}
