<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Project::all();
    }


    public function create(){
        //
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'client_id' => 'required',
            'projectStatus' => 'required',
            'startDate' => 'required',
            'dueDate' => 'required',
            'documents' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
        ]);

         return Project::create($request->all());

        $fileName = time().'.'.$request->documents->extension();

        $request->documents->storeAs(public_path('public/file'), $fileName);


        /* Store $fileName name in DATABASE from HERE */

       Project::create(['documents' => $fileName])

        return back()
             ->with('success','You have successfully file uplaod.')
             ->with('documents',$fileName);

 }

    public function show($id){
        return Project::find($id);
        $project = Project::findOrFail($id)->get();

    }

    public function edit(Project $project)    {
        //
    }

    public function update(Request $request, $id){
        $project = Project::find($id);
        $project->update($request->all());
        return $project;
    }

    public function destroy($id){
        return Project::destroy($id);
    }
    // search project
    public function searchProject($name){
        return Project::where('name','like','%'.$name.'%')->get();
    }
}
