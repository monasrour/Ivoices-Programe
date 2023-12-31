<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Auth;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections=Section::all();
        return view('sections.sections',compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
        ],[

            'section_name.required' =>'يرجي ادخال اسم القسم',
            'section_name.unique' =>'اسم القسم مسجل مسبقا',


        ]);

            section::create([
                'section_name' => $request->section_name,
                'description' => $request->description,
                'created_by' => Auth::user()->name,
                
            ]);
            session()->flash('Add', 'تم اضافة القسم بنجاح ');
            return redirect('/sections');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
{
    $validatedData = $request->validate([
        'section_name' => 'required|max:255|unique:sections,section_name,' . $section->id,
    ], [
        'section_name.required' => 'يرجى إدخال اسم القسم',
        'section_name.unique' => 'اسم القسم مسجل مسبقًا',
        'section_name.max' => 'يجب ألا يتجاوز طول اسم القسم 255 حرفًا',
    ]);

    $section->update([
        'section_name' => $request->section_name,
        'description' => $request->description,
    ]);

    session()->flash('Edit', 'تم تحديث القسم بنجاح');
    return redirect('/sections');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        return 'destroyed';
    }
}
