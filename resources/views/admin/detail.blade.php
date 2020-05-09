@extends('template/admin')

@section('css')

@endsection


@section('content')

  <div class="flash-content1">
    <div id="flash-data" data-success="{{ Session::get('success') }}" data-failed="{{ Session::get('failed') }}"></div>
  </div>
  <div class="card p-4 border-top-info shadow">
    <a href="{{ url('admin/pembayaran') }}"><button type="button" class="btn btn-labeled btn-success">
        <span class="btn-label"><i class="fas fa-chevron-left"></i></span>Kembali</button></a>
      </a>
      <div class="row justify-content-between">
        <div class="col-4">
          <h3>Detail Pembayaran</h3>
        </div>
        <div class="col-4">
      
        </div>
      </div>
      


   
    <div class="card-body p-0 mt-3">
      <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Checkup</th>
            <th>Tanggal</th>
          </tr>
        </thead>
        <tbody>
          @foreach($data['checkup'] as $index => $row)
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $row['nama'] }}</td>
                <td>{{ $row['checkup'] }}</td>
                <td>{{ date('D, d M Y', strtotime($row['tanggal'])) }}</td>
              </tr>
          @endforeach
        </tbody>



      </table>
    </div>


  </div>


@endsection


@section('js')
 
@endsection
