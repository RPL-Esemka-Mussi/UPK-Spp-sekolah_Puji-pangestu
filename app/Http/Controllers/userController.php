<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class userController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    public function tambah()
    {
        return view('user.tambah');
    }

    public function simpan(Request $request)
    {



        try {
            User::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'password' => bcrypt($request->password),
                'level' =>$request->level,

            ]);



            return redirect('user')->with('sukses', 'Data berhasil ditambahkan✨,');
        }catch (\Exception $e){
            return redirect('user')->with('gagal', 'Data gagal ditambahkan💔,');

        }
        }

        public function edit($id)
        {
            try {
                $users = User::findOrfail($id);

                return view('user.edit', compact('users'));
            }catch (\Exception $e){
                return redirect('user')->with('gagal', 'Data gagal ditemukan✨.');
            }
        }

        public function update(Request $request)
        {
            try{
                if($request->Password != null){
                    user::where ('id', $request->id)->update ([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->Password),
                        'level' => $request->level,
                    ]);
                }else{
                    user::where ('id', $request->id)->update ([
                        'name' => $request->name,
                        'email' => $request->email,
                        'level' => $request->level,
                    ]);
                }
                return redirect('user')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('user')->with('gagal', 'Data tidak ditemukan💔.');

            }
        }

        public function hapus($id)
        {
            try{
                User::findOrfail($id);
                User::destroy($id);

                return redirect('user')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                $message = $e->getMessage();
                return redirect('user')->with('gagal', 'Data tidak ditemukan💔.' . "($message)");

            }
        }

    }

