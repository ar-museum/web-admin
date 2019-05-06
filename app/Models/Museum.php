<?php

namespace App\Models;

use App\BaseModel;
use Illuminate\Notifications\Notifiable;

class Museum extends BaseModel
{
    use Notifiable;
    protected $table = 'museum';

    protected $primaryKey = 'museum_id';

    protected $fillable = [
        'museum_id','name', 'address',
        'monday_opening_hour', 'monday_closing_hour',
        'tuesday_opening_hour', 'tuesday_closing_hour',
        'wednesday_opening_hour', 'wednesday_closing_hour',
        'thursday_opening_hour', 'thursday_closing_hour',
        'friday_opening_hour', 'friday_closing_hour',
        'saturday_opening_hour', 'saturday_closing_hour',
        'sunday_opening_hour', 'sunday_closing_hour'
    ];

    public function getMuseumName()
    {
        return $this->name;

    }
    public function getMuseumId()
    {
        return $this->museum_id;

    }
    public function setMuseumName($name)
    {
        $this->name=$name;

    }

    public function getMuseumAddress()
    {
        return $this->address;
    }

    public function setMuseumAddress($address)
    {
        $this->address=$address;
    }


    public function  setMondayProgram($opening, $closing)
    {
        $this->monday_opening_hour = $opening;
        $this->monday_closing_hour =$closing;
    }
    public function  setTuesdayProgram($opening, $closing)
    {
        $this->tuesday_opening_hour = $opening;
        $this->tuesday_closing_hour =$closing;
    }
    public function  setWednesdayProgram($opening, $closing)
    {
        $this->wednesday_opening_hour = $opening;
        $this->wednesday_closing_hour =$closing;
    }
    public function  setThursdayProgram($opening, $closing)
    {
        $this->thursday_opening_hour = $opening;
        $this->thursday_closing_hour =$closing;
    }
    public function  setFridayProgram($opening, $closing)
    {
        $this->friday_opening_hour = $opening;
        $this->friday_closing_hour =$closing;
    }
    public function  setSaturdayProgram($opening, $closing)
    {
        $this->saturday_opening_hour = $opening;
        $this->saturday_closing_hour =$closing;
    }
    public function  setSundayProgram($opening, $closing)
    {
        $this->sunday_opening_hour = $opening;
        $this->sunday_closing_hour =$closing;
    }

    public function  getMondayProgram()
    {
        if($this->monday_opening_hour=="00:00:00" and $this->monday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->monday_opening_hour."-".$this->monday_closing_hour;
    }

    public function  getTuesdayProgram()
    {
        if($this->tuesday_opening_hour=="00:00:00" and $this->tuesday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->tuesday_opening_hour."-".$this->tuesday_closing_hour;
    }

    public function  getWednesdayProgram()
    {
        if($this->wednesday_opening_hour=="00:00:00" and $this->wednesday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->wednesday_opening_hour."-".$this->wednesday_closing_hour;
    }

    public function  getThursdayProgram()
    {
        if($this->thursday_opening_hour=="00:00:00" and $this->thursday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->thursday_opening_hour."-".$this->thursday_closing_hour;
    }

    public function  getFridayProgram()
    {
        if($this->friday_opening_hour=="00:00:00" and $this->friday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->friday_opening_hour."-".$this->friday_closing_hour;
    }

    public function  getSaturdayProgram()
    {
        if($this->saturday_opening_hour=="00:00:00" and $this->saturday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->saturday_opening_hour."-".$this->saturday_closing_hour;
    }

    public function  getSundayProgram()
    {
        if($this->sunday_opening_hour=="00:00:00" and $this->sunday_closing_hour=="00:00:00") return "Inchis";
        else
            return $this->sunday_opening_hour."-".$this->sunday_closing_hour;
    }

    public function expositions()
    {
        return $this->hasMany(Exposition::class, 'museum_id', 'museum_id');
    }
}
