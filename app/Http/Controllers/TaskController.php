<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        //,'("<input type=\"button\" class=\"btn btn-info\" value=\"Alterar\"> ") as btn_update'
        if ($request->ajax())
        {
            $query = DB::table('tasks')
                        ->join('projects', 'projects.id', '=', 'tasks.project')
                        ->select('tasks.*', 'projects.name as project_name')
                        ->selectRaw('case when tasks.status = 1 then "ANDAMENTO" when tasks.status = 2 then "FINALIZADO" else "CANCELADO" end as status_name')
                        ->get();
            //dd($data);
            return Datatables::of($query)
                    ->escapeColumns([])
                    ->addColumn('btn_update', function ($task) {
                        return "<a class=\"btn btn-success\" href=\"".route('tasks.edit', ["task" => $task->id])."\">Alterar</a>";
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        $alert = [
            'class' => request()->session()->get('class'),
            'msg' => request()->session()->get('msg'),
        ];
        return view('tasks.index', ['alert' => $alert]);
    }

    public function homeList(Request $request){
        if ($request->ajax())
        {
            $query = DB::table('tasks')
                        ->join('projects', 'projects.id', '=', 'tasks.project')
                        ->where('tasks.user', Auth::user()->id)
                        ->select('tasks.*', 'projects.name as project_name')
                        ->selectRaw('case when tasks.status = 1 then "ANDAMENTO" when tasks.status = 2 then "FINALIZADO" else "CANCELADO" end as status_name')
                        ->get();
            //dd($data);
            return Datatables::of($query)
                    ->escapeColumns([])
                    ->addColumn('btn_update', function ($task) {
                        return "<a class=\"btn btn-success\" href=\"".route('tasks.edit', ["task" => $task->id])."\">Alterar</a>";
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        $alert = [
            'class' => request()->session()->get('class'),
            'msg' => request()->session()->get('msg'),
        ];
        return view('home', ['alert' => $alert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', ["projects" => $projects]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task->item = addslashes($request->input('item'));
        if(!is_null($request->input('prev_start'))){
            $prev_start = Carbon::createFromFormat('Y-m-d', $request->input('prev_start'));
            $task->prev_start = $prev_start->format('Y-m-d');
        }else{
            $task->prev_start = null;
        }
        if(!is_null($request->input('prev_end'))){
            $prev_end = Carbon::createFromFormat('Y-m-d', $request->input('prev_end'));
            $task->prev_end = $prev_end->format('Y-m-d');
        }else{
            $task->prev_end = null;
        }
        if(!is_null($request->input('out_date'))){
            $out_date = Carbon::createFromFormat('Y-m-d', $request->input('out_date'));
            $task->out_date = $out_date->format('Y-m-d');
        }else{
            $task->out_date = null;
        }
        $task->user = Auth::user()->id;
        $task->project = $request->input('project');
        $task->description = addslashes($request->input('description'));
        $task->status = $request->input('status');
        $r = $task->save();
        if($r){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Tarefa cadastrada com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao cadastrar a tarefa. Por favor, tente mais tarde!'
            );
        }
        return redirect()->route('tasks.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', ['projects' => $projects, 'task' => $task]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //dd($request->all());
        $task->item = addslashes($request->input('item'));
        if(!is_null($request->input('prev_start'))){
            $prev_start = Carbon::createFromFormat('Y-m-d', $request->input('prev_start'));
            $task->prev_start = $prev_start->format('Y-m-d');
        }else{
            $task->prev_start = null;
        }
        if(!is_null($request->input('prev_end'))){
            $prev_end = Carbon::createFromFormat('Y-m-d', $request->input('prev_end'));
            $task->prev_end = $prev_end->format('Y-m-d');
        }else{
            $task->prev_end = null;
        }
        if(!is_null($request->input('out_date'))){
            $out_date = Carbon::createFromFormat('Y-m-d', $request->input('out_date'));
            $task->out_date = $out_date->format('Y-m-d');
        }else{
            $task->out_date = null;
        }
        $task->project = $request->input('project');
        $task->description = addslashes($request->input('description'));
        $task->status = $request->input('status');
        //dd($task);
        $r = $task->update();
        if($r){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Tarefa alterada com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao alterar a tarefa. Por favor, tente mais tarde!'
            );
        }
        //dd($alert);
        return redirect()->route('tasks.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }


    /**
     * Returns tasks progress based on a project
     *
     * @param int $project_id
     * @return double $percentage
     */
    public function getProjectProgress($project_id)
    {
        $t = new Task();
        $tasks_total = $t->where('project', '=', $project_id)->get();

        $tasks_ok = $t->where('project', '=', $project_id)
                    ->where('status', '=', '2')
                    ->get();
        if(count($tasks_ok) < count($tasks_total)){
            $percentage = (count($tasks_ok)/count($tasks_total)) * 100;
        }else{
            $percentage = 100;
        }

        return number_format($percentage, 0);
    }
}
