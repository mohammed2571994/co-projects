<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('auth')->except(['list', 'view']);
    }
    

    public function index ()
    {
        $projects = Project::all();
        $categories = Category::all();

        return view('admin.project.index', compact('projects'));
    }

    public function list()
    {
        $projects = Project::all();


        return view('home', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'title' => ['required'],
            'image' => ['required', 'image'],
            'url' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
        ]);

        $image = $this->uploadImage($request->image);
        $data['image'] = $image;
        $data['user_id'] = auth()->id();

        Project::create($data);
        
        return redirect()->back()->with(
            'success',
            __('Projected Created Successfully')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }

    public function view(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function adminShow(Project $project)
    {
        return view('admin.project.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', compact('project'));
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
        $data = request()->validate([
            'title' => ['required'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['image'],
        ]);

        if ($request->hasFile('image')) {
            $image = $this->uploadImage($request->image);
            $data['image'] = $image;
        }

        $project->update($data);

        return redirect()->back()->with(
            'success',
            __('Projects Details Edited Successfully')
        );
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
        return redirect()->back()->with(
            'success',
            __('Project Data Deleted Successfully')
        );
    }
}
