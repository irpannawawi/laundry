<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Users_controller extends Controller
{
    public function index(Request $request){
        $keyword = '';
        if($request->input('keyword')!=null){
            $keyword = $request->input('keyword');
        }
        
        $data = [
            'users'=> User::where('full_name','LIKE', '%'.$keyword.'%')
            ->orderBy('id', 'ASC')
            ->paginate(
                $perPage = 10, $columns = ['*'], $pageName = 'users'
            ),
        ];
        return view('admin.users.index', $data);
    }

    public function store(Request $request)
    {
        $userdata = [
            'name'=>$request->input('name'),
            'full_name'=>$request->input('full_name'),
            'email'=>$request->input('email'),
            'role'=>$request->input('role'),
            'password'=>Hash::make($request->input('password')),
        ];

        if(User::insert($userdata)){
            return redirect()->route('users')->with('success', 'Berhasil menambah user');
        }
    }

    public function edit($id){
        $data = [
            'user'=> User::find($id),
        ];
        return view('admin.users.edit', $data);
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $user = User::find($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
            if(isset($request->is_membership)){
                $user->is_membership = $request->input('is_membership');
                if($request->is_membership == 1){
                    // add 1000 balance 
                    $saldo = 
                    [
                        'saldo'=>1000,
                        'ket'=>'Bonus member baru',
                        'type'=>'masuk',
                        'user_id'=>$id
                    ];
                    Saldo::create($saldo);
                }
            }
            if($request->input('password')!= ''){
                $user->password = Hash::make($request->input('password'));
            }

        if($user->save()){
            return redirect()->route('users')->with('success', 'Berhasil merubah user');
        }
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        // delete all transaction
        Transaction::where('id_user', $id)->delete();
        User::where('id', $id)->delete();
        return redirect()->back();
    }
}
