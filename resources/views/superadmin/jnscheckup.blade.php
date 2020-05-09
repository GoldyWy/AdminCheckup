@extends('template/admin')

@section('css')

@endsection


@section('content')
  <div class="row">

    <div class="col-md-12">
      <div id="flash-data" data-success="{{ Session::get('success') }}" data-failed="{{ Session::get('failed') }}"></div>
      </div>

    <div class="col-md-12 card p-4 border-top-info shadow">
      <div class="row justify-content-between">
        <div class="col-4">
          <h3>Data Jenis Checkup</h3>
        </div>
        <div class="col-4">
          <a href="{{ url('superadmin/jnscheckup/tambah') }}" class="btn btn-info" style="float:right"><i class="fas fa-plus"></i> Tambah Checkup</a>
        </div>
      </div>
      <div class="row pt-3">

        <div class="col-md-12">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Status</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
              @if($data['jnscheckup'] != null)
                @foreach($data['jnscheckup'] as $index => $row)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $row['kode_jns_checkup'] }}</td>
                  <td>{{ $row['nama_jns_checkup'] }}</td>
                  <td>Rp. {{ $row['harga'] }}</td>
                  <td>
                    @if($row['status'] == 1)
                      Aktif
                    @else
                      Tidak Aktif
                    @endif
                  </td>
                  <!-- <td>
                    @if($row['status'] == 1)
                      <a href="#" class="btn btn-danger btn-circle">
                         <i class="fas fa-ban"></i>
                       </a>
                    @else
                    <a href="#" class="btn btn-success btn-circle">
                       <i class="fas fa-check"></i>
                     </a>
                    @endif
                  </td> -->
                </tr>

                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>

    </div>

  </div>
@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/superadmin/checkup.js') }}">

  </script>
@endsection
