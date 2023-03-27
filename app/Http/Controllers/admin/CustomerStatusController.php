<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CustomerStatusController extends Controller
{
    //Index    
    public function index()
    {
        return view('admin.customers.customers-status.index');
    }

    // Show Customers Status List
    public function show(){
        $customer_status = CustomerStatus::all();

            return Datatables::of($customer_status)
            ->addColumn('created_by', function ($customer_status) {
                return $customer_status->user->name;
            })
            ->editColumn('created_at', function ($customer_status) {
                return $customer_status->created_at ? with(new Carbon($customer_status->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($customer_status) {
                return $customer_status->updated_at ? with(new Carbon($customer_status->updated_at))->format('d/m/Y') : '';
            })
            ->addColumn('action', function ($customer_status) {
                return
                '<div class="dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                        <a class="dropdown-item" href="#" data-id="'. $customer_status->id .'" id="editCustomerStatus"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-id="'. $customer_status->id .'" id="deleteCustomerStatus" ><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    // Store Customer Status
    public function store(Request $request){
        
        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
           
            $customer_status = CustomerStatus::create([
                'status' => $request->status,
                'created_by'=>auth()->id(),
            ]);
            DB::commit();
            if ($customer_status) {
                alert()->success('Customer Status Added', 'Added Successfully')
                ->persistent('close')->autoclose(5000);
                return 'Success';
            }
        } catch (\Exception|\error $error) {
            dd($error->getMessage());
            DB::rollBack();
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }

    // Edit
    public function edit($id){
        $customer_status = CustomerStatus::find($id);
        return $customer_status;
    }

    public function update(Request $request){

        // dd($request->all());
        $request->validate([
            'edit_status' => 'required',
        ],
        [
            'edit_status.required'=>'The Status is required',
        ]);

        $customer_status = CustomerStatus::find($request->customer_status_id);
        DB::beginTransaction();
        try {
            $customer_status->status = $request->edit_status;
            $customer_status->save();
            DB::commit();
            if ($customer_status) {
                alert()->success('Updated', 'Updated Successfully')
                ->persistent('close')->autoclose(5000);
                return 'Success';
            }

        } catch (\Exception|\error $error) {
            dd($error->getMessage());
            DB::rollBack();
            return Response::json(['error'=>'Not Found'], 404 );
        }        
    }

    // Delete
    public function delete($id){
        $customer_status = CustomerStatus::find($id);
        if($customer_status){
            $customer_status->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }

}
