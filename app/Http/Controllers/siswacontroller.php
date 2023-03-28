<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\User;
use App\Models\kelas;
use Illuminate\Http\Request;

class siswacontroller extends Controller
{
    public function index()
    {
        $siswa = siswa::with('user', 'kelas')->get();

        return view('siswa.index', compact('siswa'));
    }

    public function tambah()
    {
        $kelas = kelas::all();
        return view('siswa.tambah', compact('kelas'));
    }

    public function simpan(Request $request)
    {

        try {
            $users = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=> bcrypt($request->password),
                'level'=>'siswa'

            ]);

            siswa::create([
            'user_id'=> $users->id,
            'nis'=> $request->nis,
            'kelas_id'=> $request->kelas_id,
            'alamat'=> $request->alamat,
            'no_hp'=> $request->no_hp,
            ]);

            return redirect('siswa')->with('sukses', 'Data berhasil ditambahkan✨,');
        }catch (\Exception $e){
            $message=$e->getMessage();
            return redirect('siswa')->with('gagal', 'Data gagal ditambahkan💔,' . "($message)");

        }
    }

        public function edit($id)
        {
            try {

                $siswa = siswa::findOrfail($id);
                $kelas = kelas::all();

                return view('siswa.edit', compact('siswa', 'kelas'));
            }catch (\Exception $e){
                return redirect('siswa')->with('gagal', 'Data gagal ditemukan✨.');
            }
        }

        public function update(Request $request)
        {
            try{
                $siswa = siswa::findOrfail($request->id);
                if($request->password != null){
                    User::where('id', $siswa->user_id)->update([
                        'name'=> $request->name,
                        'email'=> $request->email,
                        'password'=> bcrypt($request->password),
                    ]);

                } else{
                    User::where('id', $siswa->user_id)->update([
                        'name'=> $request->name,
                        'email'=> $request->email,
                    ]);

                    siswa::where('id', $siswa->id)->update([
                        'nis'=> $request->nis,
                        'kelas_id'=> $request->kelas_id,
                        'alamat'=> $request->alamat,
                        'no_hp'=> $request->no_hp,
                    ]);
                }
                siswa::where('id', $request->id)->update([
                    'tahun'=> $request->tahun,
                    'nominal'=> $request->nominal

                ]);

                return redirect('siswa')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('siswa')->with('gagal', 'Data tidak ditemukan💔.');

            }


        }

        public function hapus($id)
        {
            try{
                siswa::findOrFail($id);
                siswa::destroy($id);

                return redirect('siswa')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('siswa')->with('gagal', 'Data tidak ditemukan💔.');

            }
        }
}
