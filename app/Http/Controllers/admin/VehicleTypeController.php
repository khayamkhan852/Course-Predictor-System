<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class VehicleTypeController extends Controller
{
    //Index Page
    public function index(){

        return view('admin.settings.vehicle-type.index');
    }

    public function show(){

        $vehicle_types = VehicleType::all();

            return Datatables::of($vehicle_types)
            ->addColumn('created_by', function ($vehicle_type) {
                return $vehicle_type->user->name;
            })
            ->editColumn('created_at', function ($vehicle_type) {
                return $vehicle_type->created_at ? with(new Carbon($vehicle_type->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($vehicle_type) {
                return $vehicle_type->updated_at ? with(new Carbon($vehicle_type->updated_at))->format('d/m/Y') : '';
            })
            ->addColumn('action', function ($vehicle_type) {
                return
                '<div class="dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                        <a class="dropdown-item" href="#" data-id="'. $vehicle_type->id .'" id="editVehicleType"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-id="'. $vehicle_type->id .'" id="deleteVehicleType" ><i class="fa fa-trash"></i> Delete</a>
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
        
            $vehicle_type = VehicleType::create([
                'type' => $request->type,
                'created_by'=>auth()->id(),
            ]);
            DB::commit();
            if ($vehicle_type) {
                alert()->success('Vehicle Type Added', 'Added Successfully')
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
        $vehicle_type = VehicleType::find($id);
        return $vehicle_type;
    }

    public function update(Request $request){

        // dd($request->all());
        $request->validate([
            'edit_type' => 'required',
        ],
        [
            'edit_type.required'=>'The Type is required',
        ]);

        $vehicle_type = VehicleType::find($request->vehicle_type_id);
        DB::beginTransaction();
        try {
            $vehicle_type->type = $request->edit_type;
            $vehicle_type->save();
            DB::commit();
            if ($vehicle_type) {
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
        $vehicle_type = VehicleType::find($id);
        if($vehicle_type){
            $vehicle_type->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }
}
