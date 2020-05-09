@extends('template/admin')

@section('css')

@endsection


@section('content')
  @if($data['antrian'] == 1)
    <div class="card border-top-info shadow">

      <div class="col row">
        <div class="col-md-12">
          <h1>Pasien : {{ $data['detail'][0]['nama_pasien'] }}</h1>
        </div>
        <div class="col-md-12">
          <h3>Riwayat Pasien</h3>
        </div>
        <div class="col-md-12">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Checkup</th>
                <th>Laporan</th>
              </tr>
            </thead>
            <tbody>
              @if($data['riwayat'] != null)
                @foreach($data['riwayat'] as $index => $row)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
                    <td>{{ $row['laporan_checkup'] }}</td>
                  </tr>
                @endforeach
              @else
                <tr>
                  <td colspan="3">Tidak ada riwayat</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>

      <div class="row m-5">

          <div class="col-md-12">
            <h3>Input Laporan</h3>
          </div>
          <div class="col-md-12">
            <form class="" action="{{ url('pegawai/antrian/detail') }}" method="post">
              {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $data['detail'][0]['id_checkup'] }}">
            <input type="hidden" name="idj" value="{{ $data['id'] }}">
            <textarea class="form-control" name="laporan" placeholder="Masukan laporan"></textarea>
            @if($errors->has('laporan'))
                <div class="text-danger">
                   {{ $errors->first('laporan')}}
                </div>
            @endif
          </div>
          <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-info btn-block" name="button">Simpan</button>
            </form>
          </div>

      </div>
    </div>






  @else
    <h1>Antrian Tidak ada</h1>
  @endif
@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/pegawai/detail.js') }}">

  </script>
@endsection
