<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('delivery_date', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'start_date' =>'required',
            'delivery_date' =>'required',
        ],[
            'name.required' => 'Devi inserire il nome del progetto',
            'name.min' => 'Il nome del progetto deve avere almeno 3 caratteri',
            'start_date.required' => "Devi inserire la data d'inizio del progetto",
            'delivery_date.required' => "Devi inserire la data di scadenza del progetto",
        ]);
        $form_data = $request->all();
        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project["slug"] = Project::generateSlug($form_data["name"]);
        $new_project["status"] = 'in process';
        $new_project->save();
        return redirect()->route('admin.projects.show', $new_project->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();
        $project->update($form_data);
        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('deleted', "Il progetto '$project->name' è stato eliminato correttamente!");
    }
}
