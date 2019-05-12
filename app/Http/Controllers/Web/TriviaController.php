<?php


namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\Trivia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class TriviaController extends Controller
{
    public function index(){
        return view("trivia.index",[
            'trivia'=> Trivia::all(),
            'trivia_no' =>Trivia::all()->count(),
            'museums' => Museum::all()
        ]);
    }

    public function create()
    {
        return view('trivia.index.blade.php');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'json_name' => 'required',
            'museum_id' => 'required',
        ]);

        $trivia = new Trivia();
        $trivia->json_name = $request->get('json_name');
        $trivia->museum_id = $request->get('museum_id');

        $trivia->save();
        return redirect('/trivia')->with('success', 'Informatii adaugate');
    }

    public function destroy($var){
        try {
            $trivia = Trivia::findOrFail($var);
            $trivia->delete();
        } catch (\Exception $e) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('trivia');
            }

            return error($e->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-trivia', ['trivia_id' => $var]);
        }

        return response()->json(['message' => 'Informatia  a fost stearsa cu succes!']);
    }
}