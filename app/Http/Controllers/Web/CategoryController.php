<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all(),
            'categories_no' => Category::all()->count(),
        ]);
    }

    public function create()
    {
        return view('category.index');
    }

    private function activeUser()
    {
        return Staff::find($this->staff->staff_id)->withCount(['expositions', 'exhibits', 'categories', 'authors', 'tags'])->first();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = new Category();
        $category->name = $request->get('name');
        $category->staff_id = $this->activeUser()->staff_id;
        $category->save();

        return redirect('/category')->with('success', 'Categoria "' . $category->name . '" este adăugată!');
    }

    public function edit($category_id)
    {
        return view('category.edit', [
            'category_selected' => Category::where('category_id', '=', $category_id)->first(),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $category_id){
        $category = Category::where('category_id', '=', $category_id)->first();

        $this->validate($request, [
            'category_id' => 'required',
            'name' => 'required'
        ]);

        $category->update($request->all());

        return redirect('/category')->with('success', 'Înregistrarea a fost modificată cu succes!');
    }

    public function destroy($category_id)
    {
        try {
            $category = Category::findOrFail($category_id);
            $category->delete();
        } catch (\Exceptionq $exception) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('category');
            }

            return error($exception->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-category', ['category_id' => $category_id]);
        }

        return response()->json(['message' => 'Categoria "' . $category->name . '" a fost ștearsă!']);
    }
}