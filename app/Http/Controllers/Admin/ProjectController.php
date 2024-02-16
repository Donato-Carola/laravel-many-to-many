<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create new post';
        $project = new Project();

        $types=Type::all();

        $technologies=Technology::all();
        return view('admin.projects.create',compact('project','pageTitle','types' ,'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'min:1','max:255' ,'string'],
            'type_id' => ['exists:types,id'],
            'technologies' =>['exists:technologies, id'],
            'image' => ['url:https','required'],
            'date' => ['date','required'],
            'description' => ['required', 'min:10','string'],

        ]);

        $data['user_id'] = Auth::id();

        $project = Project::create($data);

        $project->technologies()->sync($data['technologies']);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
       $types= Type::all();
       $technologies=Technology::all();
       return view('admin.projects.edit', compact('project','types','technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Project $project)
    {

        $data = $request->validate([
            'title' => ['required', 'min:1','max:255' ,'string'],
            'type_id' => ['exists:types,id'],
            'technologies' =>['exists:technologies, id'],
            'image' => ['url:https','required'],
            'date' => ['date','required'],
            'description' => ['required', 'min:10','string'],
        ]);

        $data['user_id'] = Auth::id();
        $project->update($data);

        return redirect()->route('admin.projects.show', $project);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }


    public function deletedIndex(){
           $projects = Project::onlyTrashed()->get();
           return view('admin.projects.deleted-index',compact('projects'));
    }

    public function deletedShow(string $id){
          $project = Project::withTrashed()->where('id', $id)->first();


          return view('admin.projects.deleted-show', compact('project'));

    }

    public function deletedRestore(string $id){
        $project = Project::withTrashed()->where('id', $id)->first();
        $project->restore();

        return redirect()->route('admin.projects.show', $project);
    }

    public function deletedDestroy(string $id){
        $project = Project::withTrashed()->where('id', $id)->first();
         $project->forceDelete();

         return redirect()->route('admin.projects.deleted.index');
    }




}
