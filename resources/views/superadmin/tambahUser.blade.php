@extends('template/admin')

@section('css')

@endsection


@section('content')
  <div class="row">
  

    <div class="col-md-12 card p-4 border-top-info shadow">
      <div class="row">
        <div class="col">
          <a href="{{ url('superadmin/user') }}"><button type="button" class="btn btn-labeled btn-success">
            <span class="btn-label"><i class="fas fa-chevron-left"></i></span>Kembali</button></a>
        <h3>Tambah User</h3>
        </div>
        <div class="col-md-12">
          <form method="post" action="{{ url('superadmin/user/tambah') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail1">Nama</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
              @if($errors->has('nama'))
                  <div class="text-danger">
                     {{ $errors->first('nama')}}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control" name="username" placeholder="Masukan Username" value="{{ old('username') }}">
              @if($errors->has('username'))
                  <div class="text-danger">
                     {{ $errors->first('username')}}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Masukan Password" value="{{ old('password') }}">
              @if($errors->has('password'))
                  <div class="text-danger">
                     {{ $errors->first('password')}}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Role</label>
              <select class="form-control" name="role" value="{{ old('role') }}">
                <option value="">Pilih Role</option>
                <option value="superadmin">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="pegawai">Pegawai</option>
              </select>
              @if($errors->has('role'))
                  <div class="text-danger">
                     {{ $errors->first('role')}}
                  </div>
              @endif
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>

    </div>

  </div>
@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/superadmin/user.js') }}">

  </script>
@endsection
