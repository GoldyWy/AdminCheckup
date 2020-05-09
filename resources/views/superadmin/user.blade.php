@extends('template/admin')

@section('css')

@endsection


@section('content')
  <div class="row">

    <div class="col-md-12">
      <div id="flash-data" data-success="{{ Session::get('success') }}" data-failed="{{ Session::get('failed') }}"></div>
    </div>

    <div class="col-md-12 card border-top-info shadow p-4">
      <div class="row justify-content-between">
        <div class="col-4">
          <h3>Data User</h3>
        </div>
        <div class="col-4">
          <a href="{{ url('superadmin/user/tambah') }}" class="btn btn-info" style="float:right"><i class="fas fa-plus"></i> Tambah User</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 py-3">


          <!-- <button type="button" class="btn btn-primary" name="button">Tambah User</button> -->
        </div>
        <div class="col-md-12">
          <table class="table table-hover" id="dataTable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Userename</th>
                <th>Role</th>
                <th>Dibuat</th>

              </tr>
            </thead>
            <tbody>
              @if($data['user'] != null)
                @foreach($data['user'] as $index => $row)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['username'] }}</td>
                    <td>{{ $row['role'] }}</td>
                    <td>{{ date('d M Y', strtotime($row['created_at'])) }}</td>
                  
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
  <script type="text/javascript" src="{{ asset('js/superadmin/user.js') }}">

  </script>
@endsection
