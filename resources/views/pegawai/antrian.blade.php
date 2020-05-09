@extends('template/admin')

@section('css')
<link rel="stylesheet" href="{{ asset('css/pegawai/antrian.css') }}">
@endsection


@section('content')
  <h1>List Antrian</h1>
  <div class="row">
      @foreach($data['jnscheckup'] as $row)
      <div class="col-lg-4">
        <div class="card p-3 border-top-info shadow">
          <div class="row text-center">
            <div class="col-md-12">
              <h3>{{ $row['nama_jns_checkup'] }}</h3>
            </div>
            <div class="col-md-12">
              <a href="{{ url('pegawai/antrian/'.$row['id']) }}"><button type="button" class="btn btn-info" name="button">Lihat Antrian</button></a>
            </div>

          </div>
        </div>
      </div>        
      @endforeach
  </div>
@endsection


@section('js')

@endsection
