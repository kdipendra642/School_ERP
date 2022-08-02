<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function ViewDesignation()
    {

        $data['allData'] = Designation::all();
        return view('backend.setup.designation.view_designation', $data);
    }


    public function DesignationAdd()
    {
        return view('backend.setup.designation.add_designation');
    }


    public function DesignationStore(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:designations|max:255',
            ],
            [
                'name.unique:designations' => 'Name already taken.'
            ]
        );

        $data = new Designation();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Designation added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('designation.view')->with($notification);
    }


    public function DesignationEdit($id)
    {
        $editData = Designation::find($id);

        return view('backend.setup.designation.edit_designation', compact('editData'));
    }

    public function DesignationUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:designations|max:255',
            ],
            [
                'name.unique:designations' => 'Name already taken.'
            ]
        );

        $data = Designation::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Designation updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('designation.view')->with($notification);
    }

    public function DesignationDelete($id)
    {
        $data = Designation::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Designation deleted successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
