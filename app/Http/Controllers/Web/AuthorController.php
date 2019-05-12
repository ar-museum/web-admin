<?php


namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Author;
use App\Models\Media;
use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AuthorController extends Controller
{
    public function index(){
        $currentStaff = Staff::find($this->staff->staff_id)->withCount(['expositions', 'exhibits', 'categories', 'authors', 'tags'])->first();
            return view('author.index',[
                'authors'=>Author::all(),
                'currentStaff' => $currentStaff,
            ]);
    }

    public function create()
    {
        return view('author.index.blade.php');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required',
            'born_year' => 'required',
            'died_year' => 'required',
            'location' => 'required',
            'staff_id' => 'required',
            'photo' => 'required',
        ]);
        $author = new Author();
        $author->full_name = $request->get('full_name');
        $author->born_year = $request->get('born_year');
        $author->died_year = $request->get('died_year');
        $author->location = $request->get('location');
        $author->staff_id = $request->get('staff_id');

        /** upload photo */
        if (request()->hasFile('photo')) {
            $photo        = $request->file('photo');
            $new_filename = md5(time() . $photo->getClientOriginalName()) . '.' . $photo->getClientOriginalExtension();

            try {
                $photo->move(public_path('uploads' . DIRECTORY_SEPARATOR . 'photo' .
                    DIRECTORY_SEPARATOR), $new_filename);
            } catch (FileException $e) {
                return redirect()->back()->withErrors(['photo' => '* ' . $e->getMessage()])->withInput();
            }
        }

        $media = new Media();
        $media->path = 'uploads' . DIRECTORY_SEPARATOR . 'photo' . DIRECTORY_SEPARATOR . $new_filename;

        $full_path = public_path() . DIRECTORY_SEPARATOR . $media->path ;
        $media->save();

        $photo = new Photo();
        $photo->photo_id = $media->media_id;

        $info_image = getimagesize($full_path);
        $photo->width = $info_image[0];
        $photo->height = $info_image[1];

        $photo->save();


        $author->photo_id = $media->media_id;
        $author->save();
        return redirect('/author')->with('success', 'Autor adaugat');
    }

    public function edit($id)
    {
        return view('author.edit', [
            'author' => Author::where('author_id','=', $id)->first(),
            'authors_no' => Author::all()->count(),
            'photos' => Photo::all(),
            'currentStaff' => Staff::all(),
        ]);
    }

    public function update(Request $request, $id){
        $author=Author::where('author_id','=', $id)->first();
        $author->update($request->all());
        return redirect('/author')->with('success', 'Autorul a fost modificat cu succes!');
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