<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerDocument;
use App\Models\CustomerStatus;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // Index
    public function index()
    {
        $customers = Customer::all();
        
        return view('admin.customers.customers.index',compact('customers'));
    }

    // Index
    public function create()
    {
        $customer_types = CustomerType::all();
        $customer_statuses = CustomerStatus::all();
        return view('admin.customers.customers.create',compact('customer_types','customer_statuses'));
    }
    
    // store
    public function store(Request $request){
        $request->validate([
            'profile_image'=>'required|mimes:jpg,jpeg,png',
            'customer_code' => 'unique:customers,customer_code',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'customer_type' => 'required',
            'customer_status' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'remarks' => 'required',
        ]);
        

        if($request->cutomer_code){
            $cutomer_code = $request->cutomer_code;
        }else{
            $cutomer_code = 'C'.random_int(00001, 10000);
        }

        $user = Auth::user();

        $customer = Customer::create([
            'customer_code' => $cutomer_code,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'customer_type_id' => $request->customer_type,
            'customer_status_id' => $request->customer_status,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'remarks' => $request->remarks,
            'created_by' => $user->id,
        ]);
        
        if($request->has('profile_image')){
             $customer->addMedia($request->profile_image)->toMediaCollection('customers');
        }
            
        if(!empty($request->document_type)){

            $count = count($request->document_type);

            for($i=0; $i<$count; $i++){

                $customerDocument = new CustomerDocument();
                $customerDocument->customer_id = $customer->id;
                $customerDocument->document_type = $request->document_type[$i];
                $customerDocument->document_number = $request->document_number[$i];
                $customerDocument->document_issue_date = $request->document_issue_date[$i];
                $customerDocument->document_expiry_date = $request->document_expiry_date[$i];
                $customerDocument->document_notes = $request->document_notes[$i];
                $customerDocument->save();

                $customerDocument->addMedia($request->document_image1[$i])->toMediaCollection('customer_documents');
                $customerDocument->addMedia($request->document_image2[$i])->toMediaCollection('customer_documents');

            }
            
        }

        return redirect('admin/customers/index')->with('success','Created Successfully!');
            
    }

   

    
}
