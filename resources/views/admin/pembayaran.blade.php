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
          <h3>Daftar Pembayaran</h3>
        </div>
    
      </div>
      

    

    </div>
    <div class="card-body p-0 mt-3">
      <table id="dataTable" class="table table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Pembayaran</th>
            <th>Total Pembayaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @if($data['pembayaran'] != null)
            @foreach($data['pembayaran'] as $index => $row)
  
              <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $row['kode_pembayaran'] }}</td>
                <td>Rp. {{ $row['total'] }}</td>
                <td>
                  <a href="{{ url('admin/pembayaran/'.$row['kode_pembayaran']) }}" class="btn btn-info"> <i class="fa fa-search"></i> Detail</a>
                </td>
            
              </tr>
            @endforeach
          @endif
        </tbody>



      </table>
    </div>


  </div>


@endsection


@section('js')
  


  <script type="text/javascript" src="{{ asset('js/admin/pasien.js') }}"></script>
@endsection
