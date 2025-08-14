<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\ClassModel;
use App\Models\StudentAddFeesModel;
use App\Models\SettingModel;
use App\Models\User;
use App\Services\PaystackServices;
use App\Exports\ExportCollectFees;
use Excel;
use Illuminate\Support\Str;

class FeesCollectionController extends Controller
{
    protected $paystack;

    public function __construct(PaystackServices $paystack)
    {
        $this->paystack = $paystack;
    }

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
        return Excel::download(new ExportCollectFees, 'CollectFeesReport_' . date('d-m-Y') . '.xls');
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
        $RemainingAmount = $getStudent->amount - $paid_amount;

        if (!empty($request->amount)) {
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

                return redirect()->back()->with('success', "Fees Successfully Added");
            } else {
                return redirect()->back()->with('error', "Your Amount is Greater than the Remaining Amount");
            }
        }

        return redirect()->back()->with('error', "You need to add an amount");
    }

    public function CollectFeesStudent()
    {
        $student_id = Auth::id();
        $getStudent = User::getSingleClass($student_id);

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        $data['header_title'] = 'Fees Collection';

        return view('student.my_fees_collection', $data);
    }

    public function CollectFeesStudentPayment(Request $request)
    {
        $getStudent = User::getSingleClass(Auth::id());
        $paid_amount = StudentAddFeesModel::getPaidAmount(Auth::id(), $getStudent->class_id);
        $RemainingAmount = $getStudent->amount - $paid_amount;

        if (!empty($request->amount)) {
            if ($RemainingAmount >= $request->amount) {
                $reference = Str::uuid()->toString();

                session([
                    'paystack_reference' => $reference,
                    'student_id' => $getStudent->id,
                    'amount' => $request->amount,
                    'remark' => $request->remark
                ]);

                $response = $this->paystack->initializeTransaction([
                    'email' => $getStudent->email,
                    'amount' => $request->amount * 100,
                    'reference' => $reference,
                    'callback_url' => url('student/paystack/payment-success')
                ]);

                return redirect($response['data']['authorization_url']);
            } else {
                return back()->with('error', 'Your amount is greater than the remaining balance');
            }
        }

        return back()->with('error', 'Enter an amount to proceed');
    }

    public function PaymentSuccess(Request $request)
    {
        if (session()->has('paystack_reference')) {
            $reference = session('paystack_reference');
            $paymentDetails = $this->paystack->verifyTransaction($reference);

            if (!empty($paymentDetails['data']['status']) && $paymentDetails['data']['status'] === 'success') {
                $amount = session('amount');
                $remark = session('remark');
                $student_id = session('student_id');

                $getStudent = User::getSingleClass($student_id);
                $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
                $RemainingAmount = $getStudent->amount - $paid_amount;

                if (round($RemainingAmount, 2) >= round($amount, 2)) {
                    $payment = new StudentAddFeesModel;
                    $payment->student_id = $getStudent->id;
                    $payment->class_id = $getStudent->class_id;
                    $payment->paid_amount = $amount;
                    $payment->total_amount = $RemainingAmount;
                    $payment->remaining_amount = $RemainingAmount - $amount;
                    $payment->payment_type = 'paystack';
                    $payment->remark = $remark;
                    $payment->paystack_reference = $reference;
                    $payment->payment_data = json_encode($paymentDetails);
                    $payment->created_by = Auth::id();
                    $payment->is_payment = 1;
                    $payment->save();

                    session()->forget(['paystack_reference', 'student_id', 'amount', 'remark']);

                    return redirect('student/fees_collection')->with('success', "Your payment was successful");
                }
            }
        }

        return redirect('student/fees_collection')->with('error', "Something went wrong. Please try again.");
    }

    public function CollectFeesStudentParent($student_id)
    {
        $getStudent = User::getSingleClass($student_id);

        $data['getFees'] = StudentAddFeesModel::getFees($student_id);
        $data['getStudent'] = $getStudent;
        $data['paid_amount'] = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        $data['header_title'] = 'Fees Collection';

        return view('parent.my_fees_collection', $data);
    }

public function CollectFeesStudentParentById($student_id)
 {
    $getStudent = User::getSingleClass($student_id);
    $getFees = StudentAddFeesModel::getFees($student_id);
    $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);

    return view('parent.my_fees_collection', compact('getStudent', 'getFees', 'paid_amount'));
 }


 public function CollectFeesStudentPaymentParent($student_id, Request $request)
    {
        $getStudent = User::getSingleClass($student_id);
        $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
        $RemainingAmount = $getStudent->amount - $paid_amount;

        if (!empty($request->amount)) {
            if ($RemainingAmount >= $request->amount) {
                $reference = Str::uuid()->toString();

                session([
                    'paystack_reference' => $reference,
                    'student_id' => $student_id,
                    'amount' => $request->amount,
                    'remark' => $request->remark
                ]);

                $response = $this->paystack->initializeTransaction([
                    'email' => $getStudent->email,
                    'amount' => $request->amount * 100,
                    'reference' => $reference,
                    'callback_url' => route('parent.paystack.success', ['student_id' => $student_id])
                ]);

                return redirect($response['data']['authorization_url']);
            }

            return back()->with('error', 'Your amount is greater than the remaining balance');
        }

        return back()->with('error', 'Please enter an amount');
    }

public function PaymentSuccessp(Request $request)
 {
    if (session()->has('paystack_reference')) {
        $reference = session('paystack_reference');
        $student_id = session('student_id'); // retrieve from session

        $paymentDetails = $this->paystack->verifyTransaction($reference);
        if (!empty($paymentDetails['data']['status']) && $paymentDetails['data']['status'] === 'success') {
            $amount = session('amount');
            $remark = session('remark');

            $getStudent = User::getSingleClass($student_id);
            $paid_amount = StudentAddFeesModel::getPaidAmount($student_id, $getStudent->class_id);
            $RemainingAmount = $getStudent->amount - $paid_amount;

            if (round($RemainingAmount, 2) >= round($amount, 2)) {
                $payment = new StudentAddFeesModel;
                $payment->student_id = $getStudent->id;
                $payment->class_id = $getStudent->class_id;
                $payment->paid_amount = $amount;
                $payment->total_amount = $RemainingAmount;
                $payment->remaining_amount = $RemainingAmount - $amount;
                $payment->payment_type = 'paystack';
                $payment->remark = $remark;
                $payment->paystack_reference = $reference;
                $payment->payment_data = json_encode($paymentDetails);
                $payment->created_by = Auth::id();
                $payment->is_payment = 1;
                $payment->save();

                session()->forget(['paystack_reference', 'student_id', 'amount', 'remark']);
                return redirect('parent/my_student/fees_collection/'. $student_id)->with('success', "Your payment was successful");
            }
        }
    }

    return redirect('parent/paystack/payment-error/' . $student_id);
 }
}
