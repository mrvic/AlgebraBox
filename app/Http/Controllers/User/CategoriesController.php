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
<<<<<<< HEAD
<<<<<<< HEAD
		$user_categories=category::orderBy('name','desc'->get()
        return view('user.categories.index', 'user_categories'=>$user_categories);
=======
=======
		$user = Sentinel::getUser();
>>>>>>> 3376077e95d2882cc30a2885a42d1478178e50b3
		
		$categories = Users::findOrFail($user->id);
		
        return view('user.categories.index', ['categories' => $categories]);
>>>>>>> defd0b7a732eeee3f74b1c8b113c7cac6c66369f
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		
    	$sections = Sections::all();
		
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
		$user = Sentinel::getUser();
		
		$category = Categories::where('name', $request->name)->get();
		
		foreach ($category as $cat){
			$user = CategorieUser::where('categorie_id',$cat->id)->where('user_id', $user->id);
		}
		
		if($category->count() > 0){
			if($user->count() > 0){
				return redirect()->route('categories.index');
			}
			else{
				$category_user = new CategorieUser;
				$category_user->user_id = $user->id;
				$category_user->categorie_id = $request->categorie_id;
				$category_user->save();
			}
		}
		else{
			$categories = new Categories();
			$categories->name = $request->name;
			$categories->sections_id = $request->sections_id;
			$categories->save();
			$categories->users()->sync([$user->id]);
		}		
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
