<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Photo;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{

    public function index()
    {
        try {
            $authors = Author::with('photo')->get();
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista autori in baza de date.'
            ), 404);
        }

        foreach ($authors as $authorKey =>$author) {
            //$author = $author->toArray();
            $photo = new Photo();
            $photo->photo_id = $author['photo_id'];
            $path = $photo->getPathAttribute();

            $path = str_replace('\\', '/', $path);

            unset($author['photo']);

            $author['photo_path'] = $path;
        }

        return response()->json($authors);
    }

    public function getData($var){
        try {
            $author = Author::findOrFail($var);
        } catch (ModelNotFoundException $ex) {
            return response()->json(array(
                'rezultat'    => 'eroare',
                'cod'      =>  404,
                'mesaj'   =>  'Nu exista acest autor.'
            ), 404);
        }
        $author->load('photo');

        #$photoPath = $author->photo()->media()->path;

        $author = $author->toArray();

        $photo = new Photo();
        $photo->photo_id = $author['photo_id'];
        $path = $photo->getPathAttribute();

        $path = str_replace('\\', '/', $path);

        unset($author['photo']);

        $author['photo_path'] = $path;

        return response()->json($author);
    }

}