<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeecategory()
    {
        $data['allData'] = FeeCategory::all();
        return view('backend.setup.fee_category.view_fee_cat', $data);
    }

    public function feecategoryAdd()
    {
        return view('backend.setup.fee_category.add_fee_cat');
    }

    public function feecategoryStore(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:fee_categories|max:255',
            ],
            [
                'name.unique:fee_categories' => 'Year already taken.'
            ]
        );

        $data = new FeeCategory();
        $data->name = $request->name;
        $data->save();


        $notification = array(
            'message' => 'Student fee category added successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    public function feecategoryEdit($id)
    {
        $editData = FeeCategory::find($id);

        return view('backend.setup.fee_category.edit_fee_cat', compact('editData'));
    }

    public function feecategoryUpdate(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|unique:fee_categories|max:255',
            ],
            [
                'name.unique:fee_categories' => 'Fee category already taken.'
            ]
        );

        $data = FeeCategory::find($id);
        $data->name = $request->name;
        $data->update();


        $notification = array(
            'message' => 'Fee category updated successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('fee.category.view')->with($notification);
    }

    public function feecategoryDelete($id)
    {
        $data = FeeCategory::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Fee category deleted successfully.',
            'alert-type' => 'info',
        );

        return redirect()->back()->with($notification);
    }
}
