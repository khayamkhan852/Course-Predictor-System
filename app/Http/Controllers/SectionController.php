<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()->can('sections.view')) {
                abort(404);
            }
            return $next($request);
        });
    }


    public function index()
    {
        $sections = Section::get();

        return view('settings.sections.index', compact('sections'));
    }

    public function create()
    {
        if (! auth()->user()->can('sections.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('settings.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        if (! auth()->user()->can('sections.create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('sections', 'name')
            ]
        ]);

        Section::create(['name' => $request->input('name')]);

        alert()->success('success', 'Section added!');
        return redirect()->route('settings.sections.index');

    }

    public function edit(Section $section)
    {
        if (! auth()->user()->can('sections.update')) {
            abort(403, 'Unauthorized action.');
        }
        return view('settings.sections.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Section $section
     * @return RedirectResponse
     */
    public function update(Request $request, Section $section): RedirectResponse
    {
        if (! auth()->user()->can('sections.update')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('sections', 'name')->ignore($section->id)
            ]
        ]);

        $section->update([
            'name' => $request->input('name'),
        ]);

        alert()->success('success', 'Section Updated!');
        return redirect()->route('settings.sections.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return RedirectResponse
     */
    public function destroy(Section $section): RedirectResponse
    {
        if (! auth()->user()->can('sections.delete')) {
            abort(403, 'Unauthorized action.');
        }

        $output = false;
        try {
            DB::beginTransaction();
            $section->delete();
            DB::commit();
            $output = true;
        } catch (\Exception|\error $error) {
            DB::rollBack();
        }

        if ($output) {
            alert()->success('success', 'Section deleted!');
            return redirect()->route('settings.sections.index');

        }
        alert()->error('failed', 'Something Went Wrong! Try again');
        return redirect()->route('settings.sections.index');

    }

}
