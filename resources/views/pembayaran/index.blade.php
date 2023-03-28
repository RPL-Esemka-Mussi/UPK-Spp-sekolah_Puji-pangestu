@extends('main.bootstrap')
@section('content')
    <div class="text-center py-5 bg-dark text-white">
        <h3>Kelola Pembayaran</h3>
    </div>
    <div class="container mt-3">
        <div class="d-flex justify-content-between">
            <div>
                <h4>Data Pembayaran</h4>
            </div>
            <form class="row row-cols-ig-auto g-1 alig-items-center" action="{{ url('pembayaran') }}" method="GET">
                <div class="col-12">
                    <input type="text" name="cari" id="cari" name="cari" value="{{ $keyword != null? $keyword : ''}}" class="form-control me-3" placeholder="cari data...">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-succes ms-3">cari</button>
            </div>
            </form>
        </div>
        <hr>
        @if (Session::has('sukses'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>sukses</strong> {{Session::get('sukses')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @elseif(Session::has('gagal'))
          <div class="alert alert-denger alert-dismissible fade show" role="alert">
            <strong>gagal!</strong> {{Session::get('gagal')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        <hr>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if($siswa->count() == 0)
                <tr class="text-center">
                    <td colspan="7"><strong>Belom ada data.</strong></td>

                </tr>
                @endif
                @foreach ($siswa as $data)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$data->nis}}</td>
                        <td>{{$data->user->name}}</td>
                        <td>{{$data->kelas->kelas}}</td>
                        <td>
                            <a href='{{ url("/pembayaran/transaksi/$data->id") }}' class="btn btn-primary">Transaksi</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
        @endsection
