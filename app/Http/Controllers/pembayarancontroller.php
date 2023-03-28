<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\siswa;
use App\Models\user;
use App\Models\spp;
use Illuminate\Http\Request;


class pembayarancontroller extends Controller
{
    public function index(Request $request)
    {
        $keyword = null;

        if($request->cari != null){
            $siswa = siswa::with ('user')-> whereRelation( 'user', 'name', 'LIKE', "%$request->cari%")->orderBy('kelas_id', 'ASC')->get();
            $keyword=$request->cari;
        }else{
            $siswa=siswa::orderBy('kelas_id', 'ASC')->get();

        }
        return view('pembayaran.index', compact('siswa', 'keyword'));

    }

    public function transaksi($id)
    {
        $dibayar=0;
        $tagihan=0;
        $pembayaranSpp=[];

        try{
            $siswa=siswa::findOrfail($id);
            $pembayaran = pembayaran::where('siswa_id', $id)->get();
            $spp = Spp::get();

            foreach ($pembayaran as $data)
            {
                $dibayar += $data->jumlah_bayar;
            }

            foreach ($spp as $data)
            {
                $tagihan += $data->nominal;

                $total = Pembayaran::where('spp_id', $data->id)->where('siswa_id', $id)->sum('jumlah_bayar');
                $pembayaranSpp[] = $total;
            }

            $total=[
                'total_dibayar'=> $dibayar,
                'total_belomdibayar'=> $tagihan - $dibayar
            ];


        }
        catch (\Exception $e)
        {
            return redirect('pembayaran')->with('gagal',"Data tidak ditemukan");
        }


        return view('pembayaran.transaksi', compact('spp', 'pembayaran', 'siswa', 'total', 'pembayaranSpp'));
    }

    public function simpan(Request $request)
    {

        try {
          pembayaran::create([
                'user_id' => auth()->user()->id,
                'siswa_id' => $request->siswa_id,
                'spp_id' => $request->spp_id,
                'tanggal_bayar' => $request->tanggal_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,

            ]);


            return redirect()->back()->with('sukses', "Transaksi Berhasil✨" );


        }catch(\Exception $e)
        {

            return redirect()->back()->with('gagal', "Transaksi Gagal " .$e->getMessage() );
        }
    }

    public function edit($id)
    {
        try{
            $data = pembayaran::findOrFail($id);
            $spp = Spp::all();
            $siswa = Siswa::all();
            $user = User::all();


            return view('pembayaran.edit', compact('data', 'spp', 'siswa', 'user'));

            return redirect('pembayaran')->with('sukses' ,'data berhassil');
        }catch(\Exception $e){
            return redirect('pembayaran')->with('gagal' ,'data gagal');
        }
    }

    public function update(Request $request)
    {
        try{
            pembayaran::where('id', $request->id)->update([
                'jumlah_bayar'=> $request->jumlah_bayar,
            ]);

            return redirect('pembayaran')->with('sukses', 'Data berhasil diupdate✨.');
        }catch (\Exception $e){
            return redirect('pembayaran')->with('gagal', 'Data tidak diupdate💔.');

        }
    }

    public function hapus($id)
    {
        try{
            Pembayaran::findOrFail($id);
            Pembayaran::destroy($id);

            return redirect()->back()->with('sukses', 'Data berhasil dihapus✨.');
        }catch (\Exception $e){
            return redirect()->back()->with('gagal', 'Data tidak ditemukan💔.');

        }
    }
}
