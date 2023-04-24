<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = DB::table('users')->get();

            return Datatables::of($data)
                    ->escapeColumns([])
                    ->addColumn('btn_update', function ($user) {
                        return "<a class=\"btn btn-success\" href=\"".route('users.edit', ["user" => $user->id])."\">Alterar</a>";
                    })
                    ->addIndexColumn()
                    ->make(true);
        }
        $alert = [
            'class' => request()->session()->get('class'),
            'msg' => request()->session()->get('msg'),
        ];
        return view('users.index', ['alert' => $alert]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("users.create");
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        //dd($request);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);
        if($user){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Usuário cadastrado com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao cadastrar o usuário. Por favor, tente mais tarde!'
            );
        }

        return redirect()->route('users.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
        //dd($user);
        //event(new Registered($user));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //dd($user);
        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'status' => ['required', 'integer']
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->status = $request->status;
        $r = $user->update();
        if($r){
            $alert = array(
                'class' => 'alert-success',
                'msg'   => 'Usuário alterado com sucesso!'
            );
        }else{
            $alert = array(
                'class' => 'alert-danger',
                'msg'   => 'Erro ao alterar o usuário. Por favor, tente mais tarde!'
            );
        }
        return redirect()->route('users.index')->with('class', $alert['class'])->with('msg', $alert['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
