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
       $museum= DB::table('museum')->get();
        return view('museum.index', [
            'museum'=>$museum,
            'museums' => Museum::with('expositions')->get(),
        ]);
    }

    public function update(\Illuminate\Http\Request $request)
    {


        $updateMuseum=new Museum();


        $name=DB::table('museum')->pluck('name');
        $newName=$request->get('museum_name');
        if($newName==null) {$newName=substr($name,2,strlen($name)-4);}
        $address=DB::table('museum')->pluck('address');
        $newAddress=$request->get('museum_address');
        if($newAddress==null){$newAddress=substr($address,2,strlen($address)-4);}
        $updateMuseum->setMuseumName($newName);
        $updateMuseum->setMuseumAddress($newAddress);
        $updateMuseum->setMondayProgram(substr(DB::table('museum')->pluck('monday_opening_hour'),2,8), substr(DB::table('museum')->pluck('monday_closing_hour'),2,8));
        $updateMuseum->setTuesdayProgram(substr(DB::table('museum')->pluck('tuesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('tuesday_closing_hour'),2,8));
        $updateMuseum->setWednesdayProgram(substr(DB::table('museum')->pluck('wednesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('wednesday_closing_hour'),2,8));
        $updateMuseum->setThursdayProgram(substr(DB::table('museum')->pluck('thursday_opening_hour'),2,8), substr(DB::table('museum')->pluck('thursday_closing_hour'),2,8));
        $updateMuseum->setFridayProgram(substr(DB::table('museum')->pluck('friday_opening_hour'),2,8), substr(DB::table('museum')->pluck('friday_closing_hour'),2,8));
        $updateMuseum->setSaturdayProgram(substr(DB::table('museum')->pluck('tuesday_opening_hour'),2,8), substr(DB::table('museum')->pluck('saturday_closing_hour'),2,8));
        $updateMuseum->setSundayProgram(substr(DB::table('museum')->pluck('sunday_opening_hour'),2,8), substr(DB::table('museum')->pluck('sunday_closing_hour'),2,8));


        $day=$request->get('day');
        $opening=$request->get('new_opening');
        $closing=$request->get('new_closing');

        if($day=='luni' or $day=='Luni')
        {

            $updateMuseum->setMondayProgram($opening,$closing);
        }
        else if($day=='marti' or $day=='Marti')
        {

            $updateMuseum->setTuesdayProgram($opening,$closing);
        }
        else if($day=='miercuri' or $day=='Miercuri')
        {

            $updateMuseum->setWednesdayProgram($opening,$closing);
        }
        else if($day=='joi' or $day=='Joi')
        {

            $updateMuseum->setThursdayProgram($opening,$closing);
        }
        else if($day=='vineri' or $day=='Vineri')
        {

            $updateMuseum->setFridayProgram($opening,$closing);
        }
        else if($day=='sambata' or $day=='Sambata')
        {

            $updateMuseum->setSaturdayProgram($opening,$closing);
        }
        else if($day=='duminica' or $day=='Duminica')
        {

            $updateMuseum->setSundayProgram($opening,$closing);
        }



        DB::table('museum')->update( DB::table('museum')->first()->id,$updateMuseum->getMuseumName(),$updateMuseum->getMuseumAddress(),'
        00:00','00:00','00:00','00:00','00:00','00:00','00:00');
        return redirect('/museum')->with('success','Actualizare realizata');
    }

}