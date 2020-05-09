@extends('template/admin')

@section('css')

@endsection


@section('content')

  <div class="flash-content1">
    <div id="flash-data" data-success="{{ Session::get('success') }}" data-failed="{{ Session::get('failed') }}"></div>
  </div>
  <div class="card p-4 border-top-info shadow">
    <div class="card-head">
      <div class="row justify-content-between">
        <div class="col-4">
          <h3>Daftar Pasien</h3>
        </div>
        <div class="col-4">
          <button type="button" name="button" class="btn btn-info" data-toggle="modal" data-target="#tambahPasien" style="float:right"><i class="fas fa-plus"></i> Tambah Pasien</button>
        </div>
      </div>
      

      <!-- Modal -->
      <div class="modal fade" id="tambahPasien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <form method="post" action="{{ url('admin/pasien') }}">
            {{ csrf_field() }}
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pasien</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" placeholder="Masukan nama">
                    @if($errors->has('nama'))
                        <div class="text-danger">
                           {{ $errors->first('nama')}}
                        </div>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tanggal Lahir</label>
                    <input type="date" name="tgllahir" class="form-control" id="exampleInputPassword1" placeholder="">
                    @if($errors->has('tgllahir'))
                        <div class="text-danger">
                           {{ $errors->first('tgllahir')}}
                        </div>
                    @endif
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-info">Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
    <div class="card-body p-0 mt-3">
      <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @if($data['pasien'] != null)
            @foreach($data['pasien'] as $index => $row)
              <!-- <h1>{{ $row['nama_pasien'] }}</h1> -->
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $row['nama_pasien'] }}</td>
                <td>{{ date('D, d M Y', strtotime($row['tgl_lahir'])) }}</td>
                <td>
                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Pilih
                  </button>
                  <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ url('admin/pasien/daftar-checkup/'.$row['id']) }}">Daftar</a>
                    <a class="dropdown-item" href="{{ url('admin/pasien/riwayat/'.$row['id']) }}">Riwayat</a>
                  </div>

                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan="4">Tidak ada pasien</td>
            </tr>
          @endif
        </tbody>



      </table>
    </div>


  </div>


@endsection


@section('js')
  @if(Session::has('errors'))
  <script>
    $(document).ready(function(){
        // $('#createOwner').modal({show: true});
        $('#tambahPasien').modal('show');
    });
    </script>

  @endif


  <script type="text/javascript" src="{{ asset('js/admin/pasien.js') }}"></script>
@endsection
