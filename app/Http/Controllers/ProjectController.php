<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax())
        {

            $data = Project::get();
            //dd($data);
            return Datatables::of($data)
                    ->escapeColumns([])
                    ->addColumn('btn_update', function ($project) {
                        return "<a class=\"btn btn-success\" href=\"".route('projects.edit', ["project" => $project->id])."\">Alterar</a>";
                    })
                    ->addColumn('progress', function($project) {
                        $t = new TaskController();
                        $percentage = $t->getProjectProgress($project->id);
                        return $percentage."%"  ;
                    })
                    ->addColumn('start_date_br', function($project){
                        return $project->start_date ? date('d/m/Y', strtotime($project->start_date)) : "";
                    })
                    ->addColumn('end_date_br', function($project){
                        return $project->end_date ? date('d/m/Y', strtotime($project->end_date)) : "";
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        $alert = [
            'class' => request()->session()->get('class'),
            'msg' => request()->session()->get('msg'),
        ];
        return view('projects/projects', ['alert' => $alert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->all();
        $p = new Project();
        $p->name = mb_strtoupper($request->input('name'), 'utf-8');
        if(!is_null($request->input('prev_start_date'))){
            $prev_start_date = Carbon::createFromFormat('Y-m-d', $request->input('prev_start_date'));
            $p->prev_start_date = $prev_start_date->format('Y-m-d');
        }else{
            $p->prev_start_date = null;
        }
        if(!is_null($request->input('prev_end_date'))){
            $prev_end_date = Carbon::createFromFormat('Y-m-d', $request->input('prev_end_date'));
            $p->prev_end_date = $prev_end_date->format('Y-m-d');
        }else{
            $p->prev_end_date = null;
        }
        $p->description = addslashes($request->input('description'));
        $p->user = Auth::user()->id;
        $p->start_date = null;
        $p->end_date = null;
        $r = $p->save();
        if($r){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Projeto cadastrado com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao cadastrar o projeto. Por favor, tente mais tarde!'
            );
        }
        return redirect()->route('projects.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $task = new TaskController();
        $tasks = $task->taskList(0, 0, $project->id);

        return view('projects.edit', ['project' => $project, 'tasks' => $tasks]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->name = mb_strtoupper($request->input('name'), 'utf-8');
        if(!is_null($request->input('prev_start_date'))){
            $prev_start_date = Carbon::createFromFormat('Y-m-d', $request->input('prev_start_date'));
            $project->prev_start_date = $prev_start_date->format('Y-m-d');
        }else{
            $project->prev_start_date = null;
        }
        if(!is_null($request->input('prev_end_date'))){
            $prev_end_date = Carbon::createFromFormat('Y-m-d', $request->input('prev_end_date'));
            $project->prev_end_date = $prev_end_date->format('Y-m-d');
        }else{
            $project->prev_end_date = null;
        }
        if(!is_null($request->input('start_date'))){
            $start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'));
            $project->start_date = $start_date->format('Y-m-d');
        }else{
            $project->start_date = null;
        }
        if(!is_null($request->input('end_date'))){
            $end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'));
            $project->end_date = $end_date->format('Y-m-d');
        }else{
            $project->end_date = null;
        }
        $project->description = addslashes($request->input('description'));
        $r = $project->update();
        if($r){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Projeto alterado com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao alterar o projeto. Por favor, tente mais tarde!'
            );
        }
        return redirect()->route('projects.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
