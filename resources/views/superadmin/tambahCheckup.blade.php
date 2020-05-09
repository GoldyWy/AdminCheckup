@extends('template/admin')

@section('css')

@endsection


@section('content')
  <div class="row">
    
 

    <div class="col-md-12 card p-4 border-top-info shadow">
      <div class="row">
        <div class=col-md-12>
          <a href="{{ url('superadmin/user') }}"><button type="button" class="btn btn-labeled btn-success">
            <span class="btn-label"><i class="fas fa-chevron-left"></i></span>Kembali</button></a>
          <h3>Tambah Checkup</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ url('superadmin/jnscheckup/tambah') }}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="exampleInputEmail1">Kode Checkup</label>
              <input type="text" class="form-control" name="kode" placeholder="Masukan Kode" value="{{ old('kode') }}">
              @if($errors->has('kode'))
                  <div class="text-danger">
                     {{ $errors->first('kode')}}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nama Checkup</label>
              <input type="text" class="form-control" name="nama" placeholder="Masukan Nama" value="{{ old('nama') }}">
              @if($errors->has('nama'))
                  <div class="text-danger">
                     {{ $errors->first('nama')}}
                  </div>
              @endif
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Harga Checkup</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend2">Rp. </span>
                  </div>
                  <input type="text" class="form-control" name="harga" placeholder="Masukan Harga" value="{{ old('harga') }}">
                  </div>
              @if($errors->has('harga'))
                  <div class="text-danger">
                     {{ $errors->first('harga')}}
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
  <script type="text/javascript" src="{{ asset('js/superadmin/checkup.js') }}">

  </script>
@endsection
