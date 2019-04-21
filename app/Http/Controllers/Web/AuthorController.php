<?php


namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
            return view('dashboard.author',[
                'authors'=>Author::lastFive()->get(),
                'author_no'=> Author::all()->count(),
            ]);
    }

    public function create()
    {
        return view('dashboard.author.blade.php');
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

    public function edit($var){

    }

    public function destroy($var){

    }
}