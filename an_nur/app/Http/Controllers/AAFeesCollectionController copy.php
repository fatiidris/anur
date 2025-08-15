<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;
use App\Models\StudentAddFeesModel;
use App\Models\SettingModel;
use App\Exports\ExportCollectFees;
use App\Models\User;
use App\Services\PaystackServices;
use Excel;


class FeesCollectionController extends Controller
{
    public function collect_fees(Request $request)
    {
        if (!empty($request->all())) {
            $data['getRecord'] = User::getCollectFeesStudent();
        }
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = 'Collect Fees';
        return view('admin.fees_collection.collect_fees', $data);
    }

    public function collect_fees_report()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getRecord'] = StudentAddFeesModel::getRecord();
        $data['header_title'] = 'Collect Fees Report';
        return view('admin.fees_collection.collect_fees_report', $data);
    }

    public function export_collect_fees_report(Request $request)
    {
      return  Excel::download(new ExportCollectFees, 'CollectFeesReport_'.date('d-m-Y').'.xls');
    }

    public function collect_fees_add($student_id)
    {
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;
        $data['header_title'] = 'Add Collect Fees';
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        return view('admin.fees_collection.add_collect_fees', $data);
    }

    public function collect_fees_insert($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        if (!empty($request->amount)) {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if ($RemainingAmount >= $request->amount) {
                $remaining_amount_user = $RemainingAmount - $request->amount;
                $payment = new StudentAddFeesModel;
                $payment->student_id = $student_id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 1;
                $payment->save();

                return redirect()->back()->with('success', "Fees Successfully Add");
            } else {
                return redirect()->back()->with('error', "Your Amount is Greater than the Remaining Amount");
            }
        } else {
            return redirect()->back()->with('error', "You need to Add your Amount at least ₦1");
        }
    }

    // student side
    public function CollectFeesStudent(Request $request)
    {
        $student_id = Auth::user()->id;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = 'Fees Collection';
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        return view('student.my_fees_collection', $data);
    }

    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::user()->id);
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::user()->id, Auth::user()->class_id);

        if (!empty($request->amount)) {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if ($RemainingAmount >= $request->amount) {
                $remaining_amount_user = $RemainingAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = Auth::user()->id;
                $payment->class_id = Auth::user()->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 0;
                $payment->save();

                $getSetting = SettingModel::getSingle();

                if ($request->payment_type == 'paypal') {
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "Student Fees";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('student/paypal/payment-error');
                    $query['return'] = url('student/paypal/payment-success');
                    $query_string = http_build_query($query);

                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();
                } elseif ($request->payment_type == 'paystack') {
                    session(['paystack_payment_id' => $payment->id]);
                    return Paystack::getAuthorizationUrl()->redirectNow();
                }

                return redirect()->back()->with('success', "Fees Successfully Added");
            } else {
                return redirect()->back()->with('error', "Your Amount is Greater than the Remaining Amount");
            }
        } else {
            return redirect()->back()->with('error', "You need to Add your Amount at least ₦1");
        }
    }

    public function PaymentError()
    {
        return redirect('student/fees_collection')->with('error', "Due to some error please try again");
    }

    public function PaymentSuccess(Request $request)
    {
        if (session()->has('paystack_payment_id')) {
            $paymentDetails = Paystack::getPaymentData();

            $paymentId = session('paystack_payment_id');

            if (!empty($paymentDetails['data']['status']) && $paymentDetails['data']['status'] === 'success') {
                $fees = StudentAddFeesModel::getSingle($paymentId);
                if (!empty($fees)) {
                    $fees->is_payment = 1;
                    $fees->payment_data = json_encode($paymentDetails);
                    $fees->save();

                    session()->forget('paystack_payment_id');

                    return redirect('student/fees_collection')->with('success', "Your Payment is Successful");
                }
            }
        } elseif (!empty($request->item_number) && !empty($request->st) && $request->st === 'completed') {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if (!empty($fees)) {
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();
                return redirect('student/fees_collection')->with('success', "Your Payment is Successful");
            }
        }

        return redirect('student/fees_collection')->with('error', "Due to some error please try again");
    }

    // parent side
     public function CollectFeesStudentParent($student_id, Request $request)
    {
        $getStudent = User::getSingle($student_id);
        $data['getStudent'] = $getStudent;
        $data['getFees'] = StudentAddFeesModel::getFees($student_id);

        $getStudent = User::getSingleClass($student_id);
        $data['getStudent'] = $getStudent;

        $data['header_title'] = 'Fees Collection';
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

        return view('student.my_fees_collection', $data);
    }


public function CollectFeesStudentPaymentParent($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
    
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, Auth::user()->class_id);

        if (!empty($request->amount))
         {
            $RemainingAmount = $getStudent->amount - $paid_amount;
            if ($RemainingAmount >= $request->amount) 
            {
                $remaining_amount_user = $RemainingAmount - $request->amount;

                $payment = new StudentAddFeesModel;
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $request->amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $remaining_amount_user;
                $payment->payment_type = $request->payment_type;
                $payment->remark = $request->remark;
                $payment->created_by = Auth::user()->id;
                $payment->is_payment = 0;
                $payment->save();

                $getSetting = SettingModel::getSingle();

                if ($request->payment_type == 'paypal') {
                    $query = array();
                    $query['business'] = $getSetting->paypal_email;
                    $query['cmd'] = '_xclick';
                    $query['item_name'] = "Student Fees";
                    $query['no_shipping'] = '1';
                    $query['item_number'] = $payment->id;
                    $query['amount'] = $request->amount;
                    $query['currency_code'] = 'USD';
                    $query['cancel_return'] = url('parent/paypal/payment-error/' .$student_id);
                    $query['return'] = url('parent/paypal/payment-success/' .$student_id);

                    $query_string = http_build_query($query);

                    header('Location: https://www.sandbox.paypal.com/cgi-bin/webscr?' . $query_string);
                    exit();
                } else if ($request->payment_type == 'paystack')
                 { 
                    $setPublicKey = getSetting->paystack_key;
                    $setApiKey = getSetting->paystack_secret;

                    session(['paystack_payment_id' => $payment->id]);
                    return Paystack::getAuthorizationUrl()->redirectNow();
                }

                return redirect()->back()->with('success', "Fees Successfully Added");
            } else {
                return redirect()->back()->with('error', "Your Amount is Greater than the Remaining Amount");
            }
        } else {
            return redirect()->back()->with('error', "You need to Add your Amount at least ₦1");
        }
    }

    public function PaymentErrorP()
    {
        return redirect('parent/fees_collection')->with('error', "Due to some error please try again");
    }

    public function PaymentSuccessp(Request $request)
    {
        if (session()->has('paystack_payment_id')) {
            $paymentDetails = Paystack::getPaymentData();

            $paymentId = session('paystack_payment_id');

            if (!empty($paymentDetails['data']['status']) && $paymentDetails['data']['status'] === 'success') {
                $fees = StudentAddFeesModel::getSingle($paymentId);
                if (!empty($fees)) {
                    $fees->is_payment = 1;
                    $fees->payment_data = json_encode($paymentDetails);
                    $fees->save();

                    session()->forget('paystack_payment_id');

                    return redirect('parent/fees_collection')->with('success', "Your Payment is Successful");
                }
            }
        } elseif (!empty($request->item_number) && !empty($request->st) && $request->st === 'completed') {
            $fees = StudentAddFeesModel::getSingle($request->item_number);
            if (!empty($fees)) {
                $fees->is_payment = 1;
                $fees->payment_data = json_encode($request->all());
                $fees->save();
                return redirect('parent/fees_collection')->with('success', "Your Payment is Successful");
            }
        }

        return redirect('parent/fees_collection')->with('error', "Due to some error please try again");
    }


}
