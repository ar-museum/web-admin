<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return view('tag.index', [
            'tags' => Tag::all(),
            'tags_no' => Tag::all()->count(),
        ]);
    }

    public function create()
    {
        return view('tag.index');
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

        $tag = new Tag();
        $tag->name = $request->get('name');
        $tag->staff_id = $this->activeUser()->staff_id;
        $tag->save();

        return redirect('/tag')->with('success', 'Eticheta "' . $tag->name . '" este adăugată!');
    }

    public function edit($tag_id)
    {
        return view('tag.edit', [
            'tag_selected' => Tag::where('tag_id', '=', $tag_id)->first(),
            'tags' => Tag::all()
        ]);
    }

    public function update(Request $request, $tag_id){
        $tag = Tag::where('tag_id', '=', $tag_id)->first();

        $this->validate($request, [
            'tag_id' => 'required',
            'name' => 'required'
        ]);

        $tag->update($request->all());

        return redirect('/tag')->with('success', 'Înregistrarea a fost modificată cu succes!');
    }

    public function destroy($tag_id)
    {
        try {
            $tag = Tag::findOrFail($tag_id);
            $tag->delete();
        } catch (\Exceptionq $exception) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('tag');
            }

            return error($exception->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-tag', ['tag_id' => $tag_id]);
        }

        return response()->json(['message' => 'Eticheta "' . $tag->name . '" a fost ștearsă!']);
    }
}