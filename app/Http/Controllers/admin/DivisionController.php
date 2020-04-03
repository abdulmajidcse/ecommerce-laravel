<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Division;

class DivisionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select all division by division table
        $divisions = Division::orderBy('priority', 'asc')->paginate(30);

        return view('admin.pages.divisions.all-division', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.divisions.add-division');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input data
        $validateData = $request->validate([
            'name' => 'required|string|unique:divisions|max:50',
            'priority' => 'required|numeric|unique:divisions|min:1|max:100'
        ]);

        //add division data on division table
        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        //confirm message
        $notification = [
            'message' => 'Successfully division added!',
            'alert-type' => 'success'
        ];

        //return route
        return redirect('/admin/divisions/add')->with($notification);
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
        //show division by editable id
        $division = Division::find($id);

        if ($division) {
            return view('admin.pages.divisions.edit-division', compact('division'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect('/admin/divisions')->with($notification);
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
        //validate input data
        $validateData = $request->validate([
            'name' => 'required|string|unique:divisions|max:50',
            'priority' => 'required|numeric|unique:divisions|min:1|max:100'
        ]);

        //add division data on division table
        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        //confirm message
        $notification = [
            'message' => 'Successfully division saved!',
            'alert-type' => 'success'
        ];

        //return route
        return redirect('/admin/divisions')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //check data that is here or not
        $division = Division::find($id);
        if ( $division ) {
            $division->delete();
            $notification = [
                'message' => 'Successfully division deleted!',
                'alert-type' => 'success'
            ];
            return redirect('/admin/divisions')->with($notification);
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect('/admin/divisions')->with($notification);
        }
    }
}
