<?php

namespace App\Http\Controllers\backend\setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;


class FeeAmountController extends Controller
{
    public function ViewFeeamount()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
        return view('backend.setup.fee_amount.view_fee_amount', $data);
    }

    public function feeamountAdd()
    {
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();
        return view('backend.setup.fee_amount.add_fee_amount', $data);
    }

    public function feeamountStore(Request $request)
    {
        $coundData = count($request->class_id);

        if ($coundData != NULL) {
            for ($i = 0; $i < $coundData; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];

                $fee_amount->save();
            }
        }

        $notification = array(
            'message' => 'Fee amount added successfully.',
            'alert-type' => 'info',
        );

        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function feeamountEdit($fee_category_id)
    {
        $data['editData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderby('class_id', 'ASC')->get();

        // dd($data['editData']->toArray());
        $data['fee_categories'] = FeeCategory::all();
        $data['classes'] = StudentClass::all();

        return view('backend.setup.fee_amount.edit_fee_amount', $data);
    }

    public function feeamountUpdate(Request $request, $fee_category_id)
    {
        if ($request->class_id == NULL) {
            $notification = array(
                'message' => 'Sorry you did not select any class.',
                'alert-type' => 'error',
            );

            return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);
        } else {

            $coundData = count($request->class_id);

            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();

            if ($coundData != NULL) {
                for ($i = 0; $i < $coundData; $i++) {
                    $fee_amount = new FeeCategoryAmount();
                    $fee_amount->fee_category_id = $request->fee_category_id;
                    $fee_amount->class_id = $request->class_id[$i];
                    $fee_amount->amount = $request->amount[$i];

                    $fee_amount->save();
                }
            }

            $notification = array(
                'message' => 'Fee amount updated successfully.',
                'alert-type' => 'success',
            );

            return redirect()->route('fee.amount.view')->with($notification);
        }
    }
    public function feeamountDetails(Request $request, $fee_category_id)
    {
        $data['detailData'] = FeeCategoryAmount::where('fee_category_id', $fee_category_id)->orderby('class_id', 'ASC')->get();

        return view('backend.setup.fee_amount.detail_fee_amount', $data);
    }
}
