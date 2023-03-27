<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VehicleStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class VehicleStatusController extends Controller
{
    //Index Page
    public function index(){

        return view('admin.settings.vehicle-status.index');
    }

    public function show(){

        $vehicle_status = VehicleStatus::all();

            return Datatables::of($vehicle_status)
            ->addColumn('created_by', function ($vehicle_status) {
                return $vehicle_status->user->name;
            })
            ->editColumn('created_at', function ($vehicle_status) {
                return $vehicle_status->created_at ? with(new Carbon($vehicle_status->created_at))->format('d/m/Y') : '';
            })
            ->editColumn('updated_at', function ($vehicle_status) {
                return $vehicle_status->updated_at ? with(new Carbon($vehicle_status->updated_at))->format('d/m/Y') : '';
            })
            ->addColumn('action', function ($vehicle_status) {
                return
                '<div class="dropdown">
                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" id="dropdown-default-success" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-default-success">
                        <a class="dropdown-item" href="#" data-id="'. $vehicle_status->id .'" id="editVehicleStatus"><i class="fa fa-edit"></i> Edit</a>
                        <a class="dropdown-item" href="#" data-id="'. $vehicle_status->id .'" id="deleteVehicleStatus" ><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </div>';
                })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request){

        $request->validate([
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
        
            $vehicle_status = VehicleStatus::create([
                'status' => $request->status,
                'created_by'=>auth()->id(),
            ]);
            DB::commit();
            if ($vehicle_status) {
                alert()->success('Vehicle Status Added', 'Added Successfully')
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
        $vehicle_status = VehicleStatus::find($id);
        return $vehicle_status;
    }

    public function update(Request $request){

        // dd($request->all());
        $request->validate([
            'edit_status' => 'required',
        ],
        [
            'edit_status.required'=>'The status is required',
        ]);

        $vehicle_status = VehicleStatus::find($request->vehicle_status_id);
        DB::beginTransaction();
        try {
            $vehicle_status->status = $request->edit_status;
            $vehicle_status->save();
            DB::commit();
            if ($vehicle_status) {
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
        $vehicle_status = VehicleStatus::find($id);
        if($vehicle_status){
            $vehicle_status->delete();
            return 'Success';
        }
        else{
            return Response::json(['error'=>'Not Found'], 404 );
        }
    }
}
