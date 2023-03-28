<?php

namespace App\Http\Controllers;

use App\Models\spp;
use Illuminate\Http\Request;

class sppcontroller extends Controller
{
    public function index()
    {
        $spp = spp::all();


        return view('spp.index', compact('spp'));
    }

    public function tambah()
    {
        return view('spp.tambah');
    }

    public function simpan(Request $request)
    {

        try {
            spp::create([
            'tahun'=> $request->tahun,
            'nominal'=> $request->nominal
            ]);

            return redirect('spp')->with('sukses', 'Data berhasil ditambahkan✨,');
        }catch (\Exception $e){
            return redirect('spp')->with('gagal', 'Data gagal ditambahkan💔,');

        }
    }

        public function edit($id)
        {
            try {

                $spp = spp::findOrfail($id);



                return view('spp.edit', compact('spp'));
            }catch (\Exception $e){
                return redirect('spp')->with('gagal', 'Data gagal ditemukan✨.');
            }
        }

        public function update(Request $request)
        {
            try{
                spp::where('id', $request->id)->update([
                    'tahun'=> $request->tahun,
                    'nominal'=> $request->nominal

                ]);

                return redirect('spp')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('spp')->with('gagal', 'Data tidak ditemukan💔.');

            }


        }

        public function hapus($id)
        {
            try{
                spp::findOrFail($id);
                spp::destroy($id);

                return redirect('spp')->with('sukses', 'Data berhasil dihapus✨.');
            }catch (\Exception $e){
                return redirect('spp')->with('gagal', 'Data tidak ditemukan💔.');

            }
        }

}
