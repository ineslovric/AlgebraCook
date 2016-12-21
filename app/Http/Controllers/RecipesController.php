<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Recipe2;
use App\Ingredient2;
use Illuminate\Auth\AuthManager;

class RecipesController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function index(Request $request)
	{
		return view('recipes.index')->with('recipes', Recipe2::get());
	}
	
	public function add()
	{
		return view('recipes.add');
	}
	
	public function view($id)
	{
		return view('recipes.view')->with('recipe', Recipe2::find($id));
	}
	
	public function edit($id)
	{
		return view('recipes.edit')->with('recipe', Recipe2::find($id));
	}
	
	public function update(Request $request)
	{
		$data=$request->all();
		$recipe = Recipe2::find($data['id']);
		
		if($recipe->creator_id !== auth()->user()->id)
			return recirect()->action('RecipesController@index');
		
		foreach($recipe->ingredients as $ingredient)
			$ingredient->delete();
			
		$recipe->ime = $data['name'];
		$recipe->description = $data['description'];
		
		if($recipe->save())
		{
			foreach($data['ingredient'] as $key => $value)
			{
				$sastojak = new Ingredient2;
				$sastojak->name = $value;
				$sastojak->recipe2_id = $recipe->id;
				$sastojak->save();
			}
		}
		return redirect()->action('RecipesController@index');
	}
	
	public function save(Request $request)
	{
		$data = $request->all();
		$noviRecept = new Recipe2;
		$noviRecept->ime = $data['name'];
		$noviRecept->description = $data['description'];
		$noviRecept->creator_id = auth()->user()->id;
		
		if($noviRecept->save())
		{
			foreach($data['ingredient'] as $key => $value)
			{
				$sastojak = new Ingredient2;
				$sastojak->name = $value;
				$sastojak->recipe2_id = $noviRecept->id;
				$sastojak->save();
			}
		}
		return redirect()->action('RecipesController@index');
	}
}
