@extends('template/home')

@section('css')

@endsection


@section('content')
    <!-- <div class="row mt-5">
      <div class="col-md-12 text-center" style="background: blue; color: white">
        <h1>{{ $data['jnscheckup']['nama_jns_checkup'] }}</h1>
      </div>
    </div> -->
    <!-- <div class="row p-5">
      <div class="col-md-6">
        <div class="row text-center">
          <div class="col-md-12">
            <h1>Terpanggil</h1>
          </div>
          <div class="col-md-12">

          </div>

        </div>
      </div>
      <div class="col-md-6">
        <div class="row text-center">
          <div class="col-md-12">
            <h1>Antrian</h1>
          </div>
          <div class="col-md-12">
            <ul class="list-group" id="listAntrian">

            </ul>
          </div>

        </div>
      </div>

    </div>
 -->
    <section class="p-3 bg-gradient-antri">
    <div class="row">
      <div class="col-12 text-center">
        <h1 style="color:blue"><b>D A F T A R&nbsp;&nbsp; A N T R I A N</b></h1>
      </div>

    </div>
    <div class="row">
        <div class="col-lg-4 p-0">
          <div class="pl-2 pt-2 pr-0 pb-2">
            <div class="row mb-2">
              <div class="col-lg-12">
                <div class="card shadow" style="border: 8px solid white">
                  <div class="card-header header-ket"><h2 style="color: black;" class="m-0 text-center">Pengecekan : <b>{{ $data['jnscheckup']['nama_jns_checkup'] }}</b></h2></div>
                </div>
              </div>
            </div>
            <div class="row text-center">
              <div class="col-lg-12">
                <div class="card shadow" style="border: 8px solid white">
                  <div class="card-header header-list" style="color: white; font-size: 40px;">Nomor Antrian :</div>
                  <div class="card-body">
                    <div id="listTerpanggil" style="color: blue"></div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="pl-2 pt-2 pr-2 pl-2">
            <div class="row" style="background: pink;">
              <div class="col-12 p-0">
                <div class="card shadow" style="border: 8px solid white">
                  <div class="card-header header-antri" id="antrianSelanjutnya"></div>
                  <div class="card-body p-0" style="min-height: 530px;">

                    <table border="2" class="w-100 table-striped" style="overflow: hidden; ">
                      <thead>
                        <tr class="bg-info">
                          <th class="text-center" style="font-size: 27px;">Nomor Antrian</th>
                          <th class="text-center" style="font-size: 27px;">Pengecekan</th>
                        </tr>
                      </thead>
                      <tbody id="listAntrian">
                        
                      </tbody>



                    </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="pl-2 pt-2 pr-2 pb-2">
            <div class="row" style="background: black; color: white;">
              <div class="col-lg-12">
                    <marquee id="time">
                       <!-- <h4 class="m-0">{{ $data['time'] }}</h4> -->
                    </marquee>
              </div>
            </div>
          </div>
        </div>
    </div>

    </section>

@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/home/antrian.js') }}" >

  </script>
@endsection
