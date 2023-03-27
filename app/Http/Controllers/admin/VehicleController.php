<?php

namespace App\Http\Controllers\admin;

use App\Models\Branch;
use App\Models\BusinessSetting;
use App\Models\Flevel;
use App\Models\Fueltype;
use App\Models\Partner;
use App\Models\Vbody;
use App\Models\Vdrive;
use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use App\Models\VehicleDamage;
use App\Models\VehicleStatus;
use App\Models\Vgroup;
use App\Models\Vtransmission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $vehicles = Vehicle::with('partner:id,name', 'company:id,name', 'media')
            ->orderBy('id', 'DESC')->get();
        return view('admin.vehicle.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        if (! auth()->user()->can('vehicle.create')) {
            abort(403, 'Unauthorized action.');
        }
        $vehicleGroups = Vgroup::get(['id', 'group_name']);
        $vehicleTransmissions = Vtransmission::get(['id', 'v_transmission']);
        $fuelTypes = Fueltype::get(['id', 'fuel_type']);
        $bodyTypes = Vbody::get(['id', 'body_type']);
        $vehicleDrives = Vdrive::get(['id', 'vehicle_drive']);
        $fuelLevels = Flevel::get(['id', 'level']);
        $branches = Branch::get(['id', 'name']);
        $vehicleStatuses = VehicleStatus::get(['id', 'status']);
        $partners = Partner::get(['id', 'name']);
        $businessSettings = BusinessSetting::get(['id', 'name']);

        return view('admin.vehicle.create.create', compact(
            'vehicleGroups',
            'vehicleTransmissions',
            'fuelTypes',
            'bodyTypes',
            'vehicleDrives',
            'fuelLevels',
            'branches',
            'vehicleStatuses',
            'partners',
            'businessSettings'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        if (! auth()->user()->can('vehicle.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'branch_id' => ['required'],
            'vehicle_status_id' => ['required'],
            'select_owner' => ['required'],
            'partner_id' => ['required_if:select_owner,partner', 'required_if:select_owner,both'],
            'business_setting_id' => ['required_if:select_owner,company', 'required_if:select_owner,both'],
        ]);
        $output = false;
        try {
            DB::beginTransaction();

            $vehicle = Vehicle::create([
                'type' => $request->input('vehicle_type'),
                'engine_type' => $request->input('engine_type'),
                'color' => $request->input('color'),
                'model' => $request->input('model'),
                'brand' => $request->input('brand'),
                'fuel_capacity' => $request->input('fuel_capacity'),
                'flevel_id' => $request->input('flevel_id'),
                'fuel_consumption' => $request->input('fuel_consumption'),
                'doors' => $request->input('doors'),
                'seats' => $request->input('seats'),
                'large_bags' => $request->input('large_bags'),
                'small_bags' => $request->input('small_bags'),
                'vin' => $request->input('vin'),
                'imei' => $request->input('imei'),
                'branch_id' => $request->input('branch_id'),
                'vehicle_status_id' => $request->input('vehicle_status_id'),
                'partner_id' => ($request->input('select_owner') === 'partner' || $request->input('select_owner') === 'both')
                    ? $request->input('partner_id') : null,
                'business_setting_id' => ($request->input('select_owner') === 'company' || $request->input('select_owner') === 'both')
                    ? $request->input('business_setting_id') : null
            ]);

            if ($request->hasFile('vehicle_image')) {
                $vehicle->addMediaFromRequest('vehicle_image')->toMediaCollection('vehicles');
            }

            $vehicle->groups()->attach($request->input('vgroup_id'));
            $vehicle->vehicleDrives()->attach($request->input('vdrive_id'));
            $vehicle->vehicleFuels()->attach($request->input('fueltype_id'));
            $vehicle->vehicleBodyTypes()->attach($request->input('vbody_id'));
            $vehicle->vehicleTransmissions()->attach($request->input('vtransmission_id'));

            // second step
            if ($request->has('facilities')) {
                foreach ($request->input('facilities', []) as $facility) {
                    $vehicle->vehicleFacilities()->create([
                        'facility' => $facility
                    ]);
                }
            }

            // third step
            $vehicleDamage = $vehicle->vehicleDamage()->create([
                'damage_description' => $request->input('damage_description')
            ]);

            foreach ($request->input('damageImages', []) as $image) {
                $vehicleDamage->addMedia(storage_path('temporary/uploads/' . $image))->toMediaCollection('vehicleDamages');
            }

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }


        if ($output) {
            File::cleanDirectory(storage_path('temporary/uploads'));
            return response()->json(true);
        }
        return response()->json(['error'=>'not added'], 404 );
    }

    /**
     * Display the specified resource.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        if (! auth()->user()->can('vehicle.view')) {
            abort(403, 'Unauthorized action.');
        }
        $vehicle->load([
            'media',
            'user:id,name',
            'partner:id,name',
            'company:id,name',
            'flevel:id,level',
            'vehicle_status:id,status',
            'branch:id,name',
            'groups',
            'vehicleDrives',
            'vehicleFuels',
            'vehicleBodyTypes',
            'vehicleTransmissions',
            'vehicleFacilities',
            'vehicleDamage.media',
        ]);

        return view('admin.vehicle.show.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function edit(Vehicle $vehicle): View
    {
        if (! auth()->user()->can('vehicle.update')) {
            abort(403, 'Unauthorized action.');
        }

        $vehicleGroups = Vgroup::get(['id', 'group_name']);
        $vehicleTransmissions = Vtransmission::get(['id', 'v_transmission']);
        $fuelTypes = Fueltype::get(['id', 'fuel_type']);
        $bodyTypes = Vbody::get(['id', 'body_type']);
        $vehicleDrives = Vdrive::get(['id', 'vehicle_drive']);
        $fuelLevels = Flevel::get(['id', 'level']);
        $branches = Branch::get(['id', 'name']);
        $vehicleStatuses = VehicleStatus::get(['id', 'status']);
        $partners = Partner::get(['id', 'name']);
        $businessSettings = BusinessSetting::get(['id', 'name']);

        $vehicle->load([
            'media', 'groups', 'vehicleDrives', 'vehicleFuels', 'vehicleBodyTypes',
            'vehicleTransmissions', 'vehicleFacilities', 'vehicleDamage.media',
        ]);

        $facilities = $vehicle->vehicleFacilities->pluck('facility')->toArray();
        return view('admin.vehicle.edit.edit', compact(
            'vehicle', 'facilities', 'vehicleGroups',
            'vehicleTransmissions', 'fuelTypes', 'bodyTypes', 'vehicleDrives', 'fuelLevels', 'branches',
            'vehicleStatuses', 'partners', 'businessSettings'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        if (! auth()->user()->can('vehicle.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'branch_id' => ['required'],
            'vehicle_status_id' => ['required'],
            'select_owner' => ['required'],
            'partner_id' => ['required_if:select_owner,partner', 'required_if:select_owner,both'],
            'business_setting_id' => ['required_if:select_owner,company', 'required_if:select_owner,both'],
        ]);

        $vehicle = Vehicle::where('id', $id)->findOrFail($id);
        $output = false;
        try {
            DB::beginTransaction();

            $vehicle->update([
                'type' => $request->input('vehicle_type'),
                'engine_type' => $request->input('engine_type'),
                'color' => $request->input('color'),
                'model' => $request->input('model'),
                'brand' => $request->input('brand'),
                'fuel_capacity' => $request->input('fuel_capacity'),
                'flevel_id' => $request->input('flevel_id'),
                'fuel_consumption' => $request->input('fuel_consumption'),
                'doors' => $request->input('doors'),
                'seats' => $request->input('seats'),
                'large_bags' => $request->input('large_bags'),
                'small_bags' => $request->input('small_bags'),
                'vin' => $request->input('vin'),
                'imei' => $request->input('imei'),
                'branch_id' => $request->input('branch_id'),
                'vehicle_status_id' => $request->input('vehicle_status_id'),
                'partner_id' => ($request->input('select_owner') === 'partner' || $request->input('select_owner') === 'both')
                    ? $request->input('partner_id') : null,
                'business_setting_id' => ($request->input('select_owner') === 'company' || $request->input('select_owner') === 'both')
                    ? $request->input('business_setting_id') : null
            ]);

            if ($request->hasFile('vehicle_image')) {
                $vehicle->clearMediaCollection('vehicles');
                $vehicle->addMediaFromRequest('vehicle_image')->toMediaCollection('vehicles');
            }

            $vehicle->groups()->sync($request->input('vgroup_id'));
            $vehicle->vehicleDrives()->sync($request->input('vdrive_id'));
            $vehicle->vehicleFuels()->sync($request->input('fueltype_id'));
            $vehicle->vehicleBodyTypes()->sync($request->input('vbody_id'));
            $vehicle->vehicleTransmissions()->sync($request->input('vtransmission_id'));

            // second step
            $vehicle->vehicleFacilities()->delete();
            if ($request->has('facilities')) {
                foreach ($request->input('facilities', []) as $facility) {
                    $vehicle->vehicleFacilities()->create([
                        'facility' => $facility
                    ]);
                }
            }
            // third step
            $vehicleDamage = $vehicle->vehicleDamage()->first();
            if ($vehicleDamage === null) {
                $vehicleDamage = $vehicle->vehicleDamage()->create([
                    'damage_description' => $request->input('damage_description')
                ]);
            } else {
                $vehicleDamage->update([
                    'damage_description' => $request->input('damage_description')
                ]);
            }


            foreach ($request->input('damageImages', []) as $image) {
                $vehicleDamage->addMedia(storage_path('temporary/uploads/' . $image))->toMediaCollection('vehicleDamages');
            }

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            File::cleanDirectory(storage_path('temporary/uploads'));
            return response()->json(true);
        }
        return response()->json(['error'=>'not updated'], 404 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        if (! auth()->user()->can('vehicle.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();
            $vehicle->delete();

            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Vehicle deleted!');
            return redirect()->route('admin.operations.vehicles.index');
        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('admin.operations.vehicles.index');

    }

    public function validateStepOne(Request $request)
    {
        $request->validate([
            'vehicle_type' => ['required', 'string', 'max:50'],
            'engine_type' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'imei' => ['nullable', 'string', 'max:100'],
            'vin' => ['required', 'string', 'max:191', 'unique:vehicles,vin'],
            'brand' => ['required', 'string', 'max:50'],
            'fuel_capacity' => ['required', 'string', 'max:50'],
            'fuel_consumption' => ['required', 'string', 'max:50'],
            'doors' => ['required', 'numeric', 'integer', 'max:6', 'min:0'],
            'seats' => ['required', 'numeric', 'integer', 'min:0'],
            'large_bags' => ['required', 'numeric', 'integer', 'min:0'],
            'small_bags' => ['required', 'numeric', 'integer', 'min:0'],
            'vgroup_id' => ['required'],
            'flevel_id' => ['required'],
            'fueltype_id' => ['required'],
            'vbody_id' => ['required'],
            'vtransmission_id' => ['required'],
            'vdrive_id' => ['required'],
            'vehicle_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:3072']
        ]);
    }

    public function validateStepOneForEdit($id, Request $request)
    {
        $request->validate([
            'vehicle_type' => ['required', 'string', 'max:50'],
            'engine_type' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'imei' => ['nullable', 'string', 'max:100'],
            'vin' => [
                'required', 'string', 'max:191',
                Rule::unique('vehicles', 'vin')->ignore($id),
            ],
            'brand' => ['required', 'string', 'max:50'],
            'fuel_capacity' => ['required', 'string', 'max:50'],
            'fuel_consumption' => ['required', 'string', 'max:50'],
            'doors' => ['required', 'numeric', 'integer', 'max:6', 'min:0'],
            'seats' => ['required', 'numeric', 'integer', 'min:0'],
            'large_bags' => ['required', 'numeric', 'integer', 'min:0'],
            'small_bags' => ['required', 'numeric', 'integer', 'min:0'],
            'vgroup_id' => ['required'],
            'flevel_id' => ['required'],
            'fueltype_id' => ['required'],
            'vbody_id' => ['required'],
            'vtransmission_id' => ['required'],
            'vdrive_id' => ['required'],
            'vehicle_image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:3072']
        ]);
    }

    public function validateStepThree(Request $request)
    {
        $request->validate([
            'damage_description' => ['nullable', 'string']
        ]);
    }
}
