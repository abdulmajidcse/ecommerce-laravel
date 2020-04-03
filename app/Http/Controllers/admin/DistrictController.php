<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Division;
use App\District;

class DistrictController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select data from district table
        $districts = District::orderBy('name', 'asc')->paginate(30);
        return view('admin.pages.districts.all-district', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //select division
        $divisions = Division::orderBy('priority', 'asc')->get();
        return view('admin.pages.districts.add-district', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'division_id' => 'required',
            'name' => 'required|unique:districts|max:50',
        ],
        [
            'division_id.required' => 'The division field is required.'
        ]);

       $district = new District();
       $district->division_id = $request->division_id;
       $district->name = $request->name;
       $district->save();

        //confirm message
        $notification = [
            'message' => 'Successfully district added!',
            'alert-type' => 'success',
        ];

       return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //select data from district table
        $district = District::find($id);
        $divisions = Division::orderBy('priority', 'asc')->get();
        //check for empty data
        if ($district) {
            //if here has a district, view edit page
            return view('admin.pages.districts.edit-district', compact('district', 'divisions'));
        } else {
            //if here has no district, redirect
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect('/admin/districts')->with($notification);
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'division_id' => 'required',
            'name' => 'required|unique:districts|max:50',
        ],
        [
            'division_id.required' => 'The division field is required.'
        ]);

       $district = District::find($id);
       $district->division_id = $request->division_id;
       $district->name = $request->name;
       $district->save();

        //confirm message
        $notification = [
            'message' => 'Successfully district saved!',
            'alert-type' => 'success',
        ];

       return redirect('/admin/districts')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete district by id
        $district = District::find($id);
        //check for empty data
        if ($district) {
            //if here has a district, delete district
            $district->delete();
            $notification = [
                'message' => 'Successfully district deleted!',
                'alert-type' => 'success'
            ];
        } else {
            //if here has no district, redirect
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
        }

        return redirect('/admin/districts')->with($notification);
    }
}
