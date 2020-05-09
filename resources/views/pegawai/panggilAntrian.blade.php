@extends('template/admin')

@section('css')

@endsection


@section('content')
  <div class="row">
    <div id="flash-data" data-success="{{ Session::get('success') }}" data-failed="{{ Session::get('failed') }}"></div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="row card border-top-info shadow m-1 p-3">
        <div class="col-md-12">
          <h1>
            @if($data['jnscheckup'] != null)
              {{ $data['jnscheckup']['nama_jns_checkup'] }}
            @else
              Error
            @endif
          </h1>


          <h1>Nomor Antrian saat ini:
          @if($data['terpanggil'] != null)
            {{ $data['terpanggil']['nomor_antrian'] }}
          @else
            0
          @endif
          </h1>
          <div class="row">
            <div class="col-md-12">

              <a onclick="pindahHalaman('{{ url('pegawai/antrian/detail/'.$data['id']) }}')" href="#"><button type="button" class="btn btn-labeled btn-info">
                <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Antrian Selanjutnya</button></a>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-6">
      <div class="row card border-top-info shadow m-1 p-3">
        <div class="col-md-12 ">
          <h1>Daftar Antrian</h1>
        </div>
        <div class="col-md-12">
          <ul class="list-group text-center" id="listAntrian">
          
          </ul>
        </div>

      </div>
    </div>

  </div>

@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/pegawai/panggilAntrian.js') }}">

  </script>
@endsection
