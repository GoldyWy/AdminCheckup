@extends('template/home')

@section('css')

@endsection


@section('content')
    <!-- Grid column -->
    <div class="row px-2 py-2">
      @foreach( $data['checkup'] as $row)
      <div class="col-md-4">
        <!--Card-->
        <div class="card">

          <!--Card image-->
          <div class="view">
            <img src="https://cdn2.tstatic.net/wartakota/foto/bank/images/ilustrasi-pemeriksaan-mcu-medical-check-up-secara-berkala.jpg" class="card-img-top" alt="photo">
            <a href="#">
              <div class="mask rgba-white-slight"></div>
            </a>
          </div>

          <!--Card content-->
          <div class="card-body text-center">
            <!--Title-->
            <h4 class="card-title">{{ $row['nama_jns_checkup'] }}</h4>
            <!--Text-->
            <a href="{{ url('antrian/'.$row['id']) }}"><button class="btn btn-info">Lihat antrian</button></a>

          </div>

        </div>
        <!--/.Card-->
      </div>
      <!-- Grid column -->
      @endforeach
    </div>

@endsection


@section('js')

@endsection
