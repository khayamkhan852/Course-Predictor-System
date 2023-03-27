<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CustomerTypeController extends Controller
{

    // Index page
    public function index()
    {
        return view('admin.customers.customers-type.index');
    }

    // Show Customers Type List
    public function show(){
        $customer_types = CustomerType::all();

            return Datatables::of($customer_types)
            ->addColumn('created_by', function ($customer_types) {
                return $customer_types->user->name;
            })
            ->editColumn('created_at', function ($customer_types) {
                return $customer_types->created_at ? with(new Carbon($customer_types->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($customer_types) {
                return $customer_types->updated_at ? with(new Carbon($customer_types->updated_at))->format('d/m/Y') : '';
            })
            ->addColumn('action', function ($customer_types) {
                return
                '<div class="dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                        <a class="dropdown-item" href="#" data-id="'. $customer_types->id .'" id="editCustomerType"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-id="'. $customer_types->id .'" id="deleteCustomerType" ><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    // Store Customer Type
    public function store(Request $request){

        $request->validate([
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $customer_type = CustomerType::create([
                'type' => $request->type,
                'created_by'=>auth()->id(),
            ]);
            DB::commit();
            if ($customer_type) {
                alert()->success('Customer Type Added', 'Added Successfully')
                ->persistent('close')->autoclose(5000);
                return 'Success';
            }
        } catch (\Exception|\error $error) {
            DB::rollBack();
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }

    // Edit
    public function edit($id){
        $customer_type = CustomerType::find($id);
        return $customer_type;
    }

    public function update(Request $request){

        // dd($request->all());
        $request->validate([
            'edit_type' => 'required',
        ],
        [
            'edit_type.required'=>'The Type is required',
        ]);

        $customer_type = CustomerType::find($request->customer_type_id);
        DB::beginTransaction();
        try {
            $customer_type->type = $request->edit_type;
            $customer_type->save();
            DB::commit();
            if ($customer_type) {
                alert()->success('Updated', 'Updated Successfully')
                ->persistent('close')->autoclose(5000);
                return 'Success';
            }

        } catch (\Exception|\error $error) {
            DB::rollBack();
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }

    // Delete
    public function delete($id){
        $customer_type = CustomerType::find($id);
        if($customer_type){
            $customer_type->delete();
            return 'Success';
        }

        return Response::json(['error'=>'Not Found'], 404 );
    }




}
