@extends('template/admin')

@section('css')

@endsection


@section('content')
  
  <div class="card p-4 border-top-info shadow">
    <a href="{{ url('admin/pasien') }}"><button type="button" class="btn btn-labeled btn-success">
        <span class="btn-label"><i class="fas fa-chevron-left"></i></span>Kembali</button></a>
      </a>
      <h3>Riwayat {{ $data['data']['nama_pasien'] }}</h3>
    <div class="card-body p-0">
      <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Check up</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @if($data['riwayat'] != null)
            @foreach($data['riwayat'] as $index => $row)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $row['jns_checkup'] }}</td>
                <td>{{ date('D, d M Y', strtotime($row['tanggal'])) }}</td>

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


@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/admin/pasien.js') }}"></script>
@endsection
