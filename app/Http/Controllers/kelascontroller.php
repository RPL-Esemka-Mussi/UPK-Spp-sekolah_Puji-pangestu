<?php

namespace App\Http\Controllers;

use App\Models\kelas;
use Illuminate\Http\Request;

class kelascontroller extends Controller
{
    public function index()
    {
        $kelas = kelas::all();


        return view('kelas.index', compact('kelas'));
    }

    public function tambah()
    {
        return view('kelas.tambah');
    }

    public function simpan(Request $request)
    {

        try {
            kelas::create([
            'kelas'=> $request->kelas,
            'kompetensi_keahlian'=> $request->kompetensi_keahlian
            ]);

            return redirect('kelas')->with('sukses', 'Data berhasil ditambahkan✨,');
        }catch (\Exception $e){
            return redirect('kelas')->with('gagal', 'Data gagal ditambahkan💔,');

        }
    }

    public function edit($id)
    {
        try {
            $kelas = kelas::findOrfail($id);

            return view('kelas.edit', compact('kelas'));
        }catch (\Exception $e){
            return redirect('kelas')->with('gagal', 'Data gagal ditemukan✨.');
        }
    }

        public function update(Request $request)
        {
            try{
                kelas::where('id', $request->id)->update([
                    'kelas'=> $request->kelas,
                    'kompetensi_keahlian'=> $request->kompetensi_keahlian

                ]);

                return redirect('kelas')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('kelas')->with('gagal', 'Data tidak ditemukan💔.');

            }
        }

        public function hapus($id)
        {
            try{
                kelas::findOrFail($id);
                kelas::destroy($id);

                return redirect('kelas')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('kelas')->with('gagal', 'Data tidak ditemukan💔.');

            }
        }

}
