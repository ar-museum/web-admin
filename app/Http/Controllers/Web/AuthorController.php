<?php


namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
            return view('author.index',[
                'authors'=>Author::all(),
            ]);
    }

    public function create()
    {
        return view('author.index.blade.php');
    }
    public function store(Request $request){
        $this->validate($request,[
            'full_name' => 'required',
            'born_year' => 'required',
            'died_year' => 'required',
            'location' => 'required',
            'staff_id' => 'required',
            'photo_id' => 'required',
            ]);
        $author = new Author();
        $author->full_name = $request->get('full_name');
        $author->born_year = $request->get('born_year');
        $author->died_year = $request->get('died_year');
        $author->location = $request->get('location');
        $author->staff_id = $request->get('staff_id');
        $author->photo_id = $request->get('photo_id');
        $author->save();
        return redirect('/author')->with('success', 'Autor adaugat');
    }

    public function edit($author_id){

    }
    public function destroy($author_id)
    {
        try {
            $author = Author::findOrFail($author_id);
            $author->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('author');
            }

            return error($e->getMessage());
        }


        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-author', ['author_id' => $author_id]);
        }

        return response()->json(['message' => 'Autorul ' . $author->full_name . ' a fost sters cu succes!']);
    }

}