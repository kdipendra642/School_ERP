<?php

namespace App\Http\Controllers\Backend\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountOtherCost;
use PDF;

class OtherCostController extends Controller
{
    public function OtherCostView()
    {
        $data['allData'] = AccountOtherCost::orderBy('id', 'DESC')->get();
        return view('backend.account.other_cost.other_cost_view', $data);
    }

    public function OtherCostAdd()
    {
        return view('backend.account.other_cost.other_cost_add');
    }

    public function OtherCostStore(Request $request)
    {
        $data = new AccountOtherCost();
        $data->amount = $request->amount;
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $data['image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Expenses recorded successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('other.cost.view')->with($notification);
    }

    public function OtherCostEdit($id)
    {
        $data['editData'] = AccountOtherCost::find($id);
        return view('backend.account.other_cost.other_cost_edit', $data);
    }

    public function OtherCostUpdate(Request $request, $id)
    {
        $data = AccountOtherCost::find($id);
        $data->amount = $request->amount;
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->description = $request->description;

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/cost_images/', $data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/cost_images'), $filename);
            $data['image'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Expenses updated successfully.',
            'alert-type' => 'success',
        );

        return redirect()->route('other.cost.view')->with($notification);
    }

    public function OtherCostDelete($id)
    {
        $data = AccountOtherCost::find($id);

        $data->delete();
        $notification = array(
            'message' => 'Expenses deleted successfully.',
            'alert-type' => 'warning',
        );

        return redirect()->route('other.cost.view')->with($notification);
    }

    public function OtherCostDetails($id)
    {
        $data['details'] = AccountOtherCost::find($id);

        $pdf = PDF::loadView('backend.account.other_cost.other_cost_details', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
