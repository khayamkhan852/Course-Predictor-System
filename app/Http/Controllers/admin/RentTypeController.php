<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RentType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\DB;

class RentTypeController extends Controller
{
    //Index Page
    public function index(){
        
        return view('admin.settings.rent-type.index');
    }

    public function show(){
        $rent_types = RentType::all();

            return Datatables::of($rent_types)
            ->addColumn('created_by', function ($rent_type) {
                return $rent_type->user->name;
            })
            ->editColumn('created_at', function ($rent_type) {
                return $rent_type->created_at ? with(new Carbon($rent_type->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($rent_type) {
                return $rent_type->updated_at ? with(new Carbon($rent_type->updated_at))->format('d/m/Y') : '';
            })
            ->addColumn('action', function ($rent_type) {
                return
                '<div class="dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                        <a class="dropdown-item" href="#" data-id="'. $rent_type->id .'" id="editRentType"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-id="'. $rent_type->id .'" id="deleteRentType" ><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request){

        $request->validate([
            'type' => 'required',
        ]);

        DB::beginTransaction();
        try {
           
            $rent_type = RentType::create([
                'type' => $request->type,
                'created_by'=>auth()->id(),
            ]);
            DB::commit();
            if ($rent_type) {
                alert()->success('Rent Type Added', 'Added Successfully')
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
        $rent_type = RentType::find($id);
        return $rent_type;
    }

    public function update(Request $request){

        // dd($request->all());
        $request->validate([
            'edit_type' => 'required',
        ],
        [
            'edit_type.required'=>'The Type is required',
        ]);

        $rent_type = RentType::find($request->rent_type_id);
        DB::beginTransaction();
        try {
            $rent_type->type = $request->edit_type;
            $rent_type->save();
            DB::commit();
            if ($rent_type) {
                alert()->success('Updated', 'Updated Successfully')
                ->persistent('close')->autoclose(5000);
                return 'Success';
            }

        } catch (\Exception|\error $error) {
            dd($error->getMessage());
            DB::rollBack();
            return \Response::json(['error'=>'Not Found'], 404 );
        }        
    }

    // Delete
    public function delete($id){
        $rent_type = RentType::find($id);
        if($rent_type){
            $rent_type->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }

}
