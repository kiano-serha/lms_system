<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Servies\GeneralServices;
// use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Str;
use Exception;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $info =  $request->validate([
            'category_id' => ['nullable', 'integer', 'exists:category,id'],
            'title' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);

        try {
            FacadesDB::beginTransaction();
            Categories::create([
                'parent_id' => $info['category_id'],
                'title' => $info['title'],
                'description' => $info['description'],
                'url_title' => $this->generateURLTitle($info['title']),
                'image' => (new GeneralServices())->upload('./uploads/categories')
            ]);
            FacadesDB::commit();

            return redirect()->back()->with('success', 'Category added successfully');
        } catch (Exception $e) {
            dd($e->getMessage());
        //     return redirect()->back()->with('error', $e->getMessage());
        }
    }

    protected function generateURLTitle($title): string
    {
        $slug = Str::slug($title);
        $category = Categories::where('url_title', 'LIKE', $slug . '%')->count();
        return $category > 0 ? $slug . '-' . ($category + 1) : $slug;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
