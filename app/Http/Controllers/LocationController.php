<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
   public function index()
    {
        $location = Location::all();
        return view('addlocation', compact('location'));
    }
    public function lists()
    {
        $locations = Location::all();
        return view('locationlists', compact('locations'));
    }

    public function store(Request $request)
    {
        $res = $this->getlnlat($request);
        if(! $res->data['0']){
            $message = 'Try Later!';
        }else{
            Location::create([
                'locname' => $request->locname,
                'loclat' => $res->data['0']->latitude,
                'loclong' => $res->data['0']->longitude
            ]);
            $message = 'Location Added Successfully';
        }
        return redirect('/locationlists')->with('message', $message);
    }
    public function getlnlat($place)
    {
        
        $json = file_get_contents("http://api.positionstack.com/v1/forward?access_key=b6ad66bb1bb09079a75355a87a5af27a&query=".$place->locname);
        dd($json);
        return json_decode($json);
   
    }
    public function edit($id)
    {
        $location = Location::find($id);
        return view('updatelocation', compact('location'));
    }
    public function update(Request $request, $location)
    {
        $res = $this->getlnlat($request);

        if(! $res->data['0']){
            $message = 'Try Later!';
        }else{
            Location::find($location)->update([
                'locname' => $request->locname,
                'loclat' => $res->data['0']->latitude,
                'loclong' => $res->data['0']->longitude
            ]);
            $message = 'Location Updated Successfully';
        }
        return redirect('/locationlists')->with('message', $message);
    }

    public function destroy($location)
    {
        Location::where('id', $location)->delete();
        return redirect('/locationlists')->with('message', 'Location Deleted Successfully');
    }
 }
