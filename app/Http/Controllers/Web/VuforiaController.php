<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\Vuforia;
use App\Models\VuforiaFile;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class VuforiaController extends Controller
{
    public function index()
    {
        return view('vuforia.index', [
            'vuforias' => Vuforia::all(),
            // 'vuforias_no' => Vuforia::all()->count(),
            'museums' => Museum::all(),
            // 'museums_no' => Museum::all()->count(),
            'files' => VuforiaFile::all(),
            'files_no' => VuforiaFile::all()->count(),
        ]);
    }

    public function create()
    {
        return view('vuforia.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'museum-id' => 'required',
            'version' => 'required',
            'file' => 'required'
        ]);

        $vuforia = new Vuforia();

        $vuforia->museum_id = $request->get('museum-id');
        $vuforia->version   = $request->get('version');

        // $temporary  = DB::table('museum')->where('museum_id', $vuforia->museum_id)->pluck('name')->first();
        // $musem_name = preg_replace('/\s+/', '', $temporary);

        if (request()->hasFile('file')) {
            $file     = $request->file('file');
            $filename = $file->getClientOriginalName();

            try {
                $path = 'uploads'   . DIRECTORY_SEPARATOR .
                        'files'     . DIRECTORY_SEPARATOR;
                        // . $musem_name . DIRECTORY_SEPARATOR;
                $file->move(public_path($path), $filename);

            } catch (FileException $e) {
                return redirect()->back()
                                 ->withErrors(['file' => '* ' . $e->getMessage()])
                                 ->withInput();
            }
        }

        $vuforiaFile = new VuforiaFile();

        $vuforiaFile->path = $path . $filename;
        $vuforiaFile->save();

        $vuforia->file_id = $vuforiaFile->file_id;
        $vuforia->save();

        return redirect('/vuforia')->with('success', 'Fișierul "' . $filename . '" a fost adăugat cu succes!');
    }

    public function edit($vuforia_id)
    {
        return view('vuforia.edit', [
            'vuforia' => Vuforia::where('vuforia_id', '=', $vuforia_id)->first(),
            'museums' => Museum::all()
        ]);
    }

    public function update(Request $request, $vuforia_id){
        $vuforia = Vuforia::where('vuforia_id', '=', $vuforia_id)->first();

        $this->validate($request, [
            'museum-id' => 'required',
            'version' => 'required',
            'file' => 'required'
        ]);

        $vuforia->update($request->all());

        return redirect('/vuforia')->with('success', 'Înregistrarea a fost modificată cu succes!');
    }

    public function destroy($vuforia_id)
    {
        try {
            $vuforia = Vuforia::findOrFail($vuforia_id);

            $file_id = $vuforia->file_id;

            $vuforiaFile = VuforiaFile::findOrFail($file_id);

            $vuforia->delete();
            $vuforiaFile->delete();

        } catch (\Exceptionq $exception) {
            if (request()->getMethod() == 'GET') {
                return redirect()->route('vuforia');
            }

            return error($exception->getMessage());
        }

        if (request()->getMethod() == 'GET') {
            return redirect()->route('delete-vuforia', ['vuforia_id' => $vuforia_id]);
        }

        return response()->json(['message' => 'Înregistrearea a fost ștearsă!']);
    }
}