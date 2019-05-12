<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Exposition;
use App\Models\Museum;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class MuseumController  extends Controller
{

    public function index()
    {
        return view('museum.index', [
            'museums' => Museum::with('expositions')->get(),
        ]);
    }

    public function edit($id)
    {
        return view('museum.edit', [
            'museum' => Museum::where('museum_id','=', $id)->first(),
        ]);
    }


    public function store(\Illuminate\Http\Request $request)
    {
        $this->validate($request, [
            'museum_name' => 'required',
            'long' => 'required',
            'lat' => 'required',
        ]);

        $museum= new Museum();
        $museum->setMuseumName($request->get('museum_name'));
        $museum->setMuseumLatitude($request->get('lat'));
        $museum->setMuseumLongitude($request->get('long'));
        $museum->setMuseumAddress($request->get('museum_address'));


        //Program luni
        if($request->get('monday_op')!=null and $request->get('monday_cl')!=null )
            $museum->setMondayProgram($request->get('monday_op'), $request->get('monday_cl'));
        else if ($request->get('monday_op')==null and $request->get('monday_cl')==null )
            $museum->setMondayProgram('00:00','00:00');
        else if($request->get('monday_op')!=null and $request->get('monday_cl')==null )
            $museum->setMondayProgram($request->get('monday_op'),'00:00');
        else if($request->get('monday_op')==null and $request->get('monday_cl')!=null )
            $museum->setMondayProgram('00:00',$request->get('monday_cl'));

        //Program marti

        if($request->get('tuesday_op')!=null and $request->get('tuesday_cl')!=null )
            $museum->setTuesdayProgram($request->get('tuesday_op'), $request->get('tuesday_cl'));
        else if ($request->get('tuesday_op')==null and $request->get('tuesday_cl')==null )
            $museum->setTuesdayProgram('00:00','00:00');
        else if($request->get('tuesday_op')!=null and $request->get('tuesday_cl')==null )
            $museum->setTuesdayProgram($request->get('tuesday_op'),'00:00');
        else if($request->get('tuesday_op')==null and $request->get('tuesday_cl')!=null )
            $museum->setTuesdayProgram('00:00',$request->get('tuesday_cl'));

        //Program miercuri

        if($request->get('wednesday_op')!=null and $request->get('wednesday_cl')!=null )
            $museum->setWednesdayProgram($request->get('tuesday_op'), $request->get('wednesday_cl'));
        else if ($request->get('wednesday_op')==null and $request->get('wednesday_cl')==null )
            $museum->setWednesdayProgram('00:00','00:00');
        else if($request->get('wednesday_op')!=null and $request->get('wednesday_cl')==null )
            $museum->setWednesdayProgram($request->get('wednesday_op'),'00:00');
        else if($request->get('wednesday_op')==null and $request->get('wednesday_cl')!=null )
            $museum->setWednesdayProgram('00:00',$request->get('wednesday_cl'));

        //Program joi

        if($request->get('thursday_op')!=null and $request->get('thursday_cl')!=null )
            $museum->setThursdayProgram($request->get('tuesday_op'), $request->get('thursday_cl'));
        else if ($request->get('thursday_op')==null and $request->get('thursday_cl')==null )
            $museum->setThursdayProgram('00:00','00:00');
        else if($request->get('thursday_op')!=null and $request->get('thursday_cl')==null )
            $museum->setThursdayProgram($request->get('thursday_op'),'00:00');
        else if($request->get('thursday_op')==null and $request->get('thursday_cl')!=null )
            $museum->setThursdayProgram('00:00',$request->get('tuesday_cl'));

        //Program vineri

        if($request->get('friday_op')!=null and $request->get('friday_cl')!=null )
            $museum->setFridayProgram($request->get('tuesday_op'), $request->get('friday_cl'));
        else if ($request->get('friday_op')==null and $request->get('friday_cl')==null )
            $museum->setFridayProgram('00:00','00:00');
        else if($request->get('friday_op')!=null and $request->get('friday_cl')==null )
            $museum->setFridayProgram($request->get('friday_op'),'00:00');
        else if($request->get('friday_op')==null and $request->get('friday_cl')!=null )
            $museum->setFridayProgram('00:00',$request->get('friday_cl'));

        //Program sambata

        if($request->get('saturday_op')!=null and $request->get('saturday_cl')!=null )
            $museum->setSaturdayProgram($request->get('saturday_op'), $request->get('saturday_cl'));
        else if ($request->get('saturday_op')==null and $request->get('saturday_cl')==null )
            $museum->setSaturdayProgram('00:00','00:00');
        else if($request->get('saturday_op')!=null and $request->get('saturday_cl')==null )
            $museum->setSaturdayProgram($request->get('saturday_op'),'00:00');
        else if($request->get('saturday_op')==null and $request->get('saturday_cl')!=null )
            $museum->setSaturdayProgram('00:00',$request->get('saturday_cl'));

        //Program Duminica


        if($request->get('sunday_op')!=null and $request->get('sunday_cl')!=null )
            $museum->setSundayProgram($request->get('sunday_op'), $request->get('sunday_cl'));
        else if ($request->get('sunday_op')==null and $request->get('sunday_cl')==null )
            $museum->setSundayProgram('00:00','00:00');
        else if($request->get('sunday_op')!=null and $request->get('sunday_cl')==null )
            $museum->setSundayProgram($request->get('sunday_op'),'00:00');
        else if($request->get('sunday_op')==null and $request->get('sunday_cl')!=null )
            $museum->setSundayProgram('00:00',$request->get('sunday_cl'));


        $museum->save();
        return redirect('/museum')->with('success', 'Muzeu adaugat');
    }
    public function update(\Illuminate\Http\Request $request, $id)
    {

        $museum = Museum::where('museum_id', '=', $id)->first();
        if($request->get('museum_name')!=null)
            $name=$request->get('museum_name');
        else
            $name=$museum->name;

        if($request->get('long')!=null)
            $long=$request->get('long');
        else
            $long=$museum->longitude;

        if($request->get('lat')!=null)
            $lat=$request->get('lat');
        else
            $lat=$museum->latitude;

        if($request->get('monday_op')!=null)
            $monday_o=$request->get('monday_op');
        else
            $monday_o=$museum->monday_opening_hour;

        if($request->get('monday_cl')!=null)
            $monday_c=$request->get('monday_cl');
        else
            $monday_c=$museum->monday_closing_hour;

        if($request->get('tuesday_op')!=null)
            $tuesday_o=$request->get('tuesday_op');
        else
            $tuesday_o=$museum->tuesday_opening_hour;

        if($request->get('tuesday_cl')!=null)
            $tuesday_c=$request->get('tuesday_cl');
        else
            $tuesday_c=$museum->tuesday_closing_hour;

        if($request->get('wednesday_op')!=null)
            $wednesday_o=$request->get('wednesday_op');
        else
            $wednesday_o=$museum->wednesday_opening_hour;

        if($request->get('wednesday_cl')!=null)
            $wednesday_c=$request->get('wednesday_cl');
        else
            $wednesday_c=$museum->wednesday_closing_hour;

        if($request->get('thursday_op')!=null)
            $thursday_o=$request->get('thursday_op');
        else
            $thursday_o=$museum->thursday_opening_hour;

        if($request->get('thursday_cl')!=null)
            $thursday_c=$request->get('thursday_cl');
        else
            $thursday_c=$museum->thursday_closing_hour;


        if($request->get('friday_op')!=null)
            $friday_o=$request->get('friday_op');
        else
            $friday_o=$museum->friday_opening_hour;

        if($request->get('friday_cl')!=null)
            $friday_c=$request->get('friday_cl');
        else
            $friday_c=$museum->friday_closing_hour;


        if($request->get('saturday_op')!=null)
            $saturday_o=$request->get('saturday_op');
        else
            $saturday_o=$museum->saturday_opening_hour;

        if($request->get('saturday_cl')!=null)
            $saturday_c=$request->get('saturday_op');
        else
            $saturday_c=$museum->saturday_closing_hour;


        if($request->get('sunday_op')!=null)
            $sunday_o=$request->get('sunday_op');
        else
            $sunday_o=$museum->sunday_opening_hour;

        if($request->get('sunday_cl')!=null)
            $sunday_c=$request->get('sunday_op');
        else
            $sunday_c=$museum->sunday_closing_hour;


        if($request->get('museum_address')!=null)
            $address=$request->get('museum_address');
        else
            $address=$museum->address;

        $museum->update([
            'museum_id'=>$museum->museum_id,
            'name'=>$name,
            'address'=>$address,
            'longitude'=>$long,
            'latitude'=>$lat,
            'monday_opening_hour'=>$monday_o,
            'monday_closing_hour'=>$monday_c,
            'tuesday_opening_hour'=>$tuesday_o,
            'tuesday_closing_hour'=>$tuesday_c,
            'wednesday_opening_hour'=> $wednesday_o,
            'wednesday_closing_hour'=>$wednesday_c,
            'thursday_opening_hour'=>$thursday_o,
            'thursday_closing_hour'=>$thursday_c,
            'friday_opening_hour'=>$friday_o,
            'friday_closing_hour'=>$friday_c,
            'saturday_opening_hour'=>$saturday_o,
            'saturday_closing_hour'=>$saturday_c,
            'sunday_opening_hour'=>$sunday_o,
            'sunday_closing_hour'=>$sunday_c]);
        return redirect('/museum')->with('success', 'Muzeu modificat');

    }

}