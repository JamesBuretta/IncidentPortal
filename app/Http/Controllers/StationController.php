<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StationController extends Controller
{
    public function index()
    {
        $stations = Station::all();

        return view('stations.view',compact('stations'));
    }

    public function create()
    {
        return view('stations.create');
    }

    public function afterInsertion($color, $notification)
    {
        return redirect('view_stations')->with('notification',$notification)->with('color',$color);
    }

    public function store(Request $request)
    {
        $this->date_time = Carbon::now()->setTimezone('Africa/Nairobi');
        //Validation should always be kept outside
            $this->validate($request,[
                'name'=>'required|string|unique:stations',
            ]);

            $station_name = strtoupper($request->name);
            $station_create = Station::insert(
                [
                    'name' => $station_name,
                    'created_at'=>$this->date_time,
                    'updated_at'=>$this->date_time
                ]
            );



            if ($station_create == true) {
                $notification="Station has been added successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return $this->afterInsertion($color,$notification);


    }

    public function edit($id)
    {
        $station = Station::where('id',$id)->get()[0];

        return view('stations.edit',compact('station'));
    }

    public function update(Request $request)
    {
        $this->date_time = Carbon::now()->setTimezone('Africa/Nairobi');
            $this->validate($request, [
                'name' => 'required'
            ]);


            $station_update = Station::where('id', $request->id)
                ->update(
                    [
                        'name'=>strtoupper($request->name),
                        'updated_at'=>$this->date_time
                    ]
                );


            if ($station_update == true) {
                $notification="Station has been edited successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }


            return redirect('view_stations')->with('notification',$notification)->with('color',$color);


    }

    public function destroy($id)
    {
        try{

            $station = Station::where('id',$id)->delete();

            if ($station == true) {
                $notification="Station has been deleted successfully!";
                $color="success";
            } else {
                $notification="Oops something went wrong!";
                $color="danger";
            }

            return redirect('view_stations')->with('notification',$notification)->with('color',$color);

        }catch (\Exception $notification)
        {
            $color = 'danger';

            return redirect('view_stations')->with('notification',$notification)->with('color',$color);
        }
    }
}
