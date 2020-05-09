@extends('template/admin')

@section('css')

@endsection


@section('content')
  
  <div class="card p-4 border-top-info shadow">
      <a href="{{ url('admin/pasien') }}"><button type="button" class="btn btn-labeled btn-success">
        <span class="btn-label"><i class="fas fa-chevron-left"></i></span>Kembali</button></a>
      </a>

      <h3>Daftar Checkup</h3>
    
    <div class="card-body p-0">
      <div class="row mt-3">
        <div class="col-md-12">
          Kode Pembayaran : <input type="text" value="{{ $data['kode'] }}" id="kodepembayaran" disabled>
        </div>
        <hr class="sidebar-divider my-0" >
        <div class="col-md-12">
          <div class="form-group">
           <label for="exampleFormControlSelect1">Jenis Checkup</label>
           <select class="form-control" id="jnscheckup" name="jnscheckup">
             <option value="">Pilih Checkup</option>
             @foreach($data['jnscheckup'] as $index => $row)
              <option value="{{ $row['id'] }}">{{ $row['nama_jns_checkup'] }}</option>
             @endforeach
           </select>
         </div>
         <div class="form-group">
           <input type="hidden" name="" id="idpasien" value="{{ $data['pasien'][0]['id'] }}">
           <button type="button" id="tambahCheckup" class="btn btn-info" name="button">Tambah</button>
         </div>
        </div>
      </div>

      <div class="row mt-5">
        <div class="col-md-12">
          <h3>Checkup Terpilih</h3>
        </div>
        <div class="col-md-12">
          <table id="daftarCheckup" class="table table-hover">
            <thead class="bg-info" style="color:white">
              <tr>
                <th>Nama Checkup</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="daftarCheckupBody">

            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">Total</td>
                <td id="totalHarga"></td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td><button type="button" class="btn btn-success" name="button" data-toggle="modal" data-target="#modalBayar"><i class="fas fa-money-bill-wave"></i> &nbsp;Bayar Sekarang</button> </td>
                <!-- Modal -->
                <div class="modal fade" id="modalBayar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">

                    <form class="" action="{{ url('admin/pasien/daftar-checkup-bayar') }}" method="post">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Pembayaran</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <input type="hidden" name="kode" value="{{ $data['kode'] }}">
                          {{ csrf_field() }}
                          <p>Pastikan uang sudah diterima</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success">Bayar Sekarang</button>
                        </div>
                      </div>
                    </form>

                  </div>
                </div>
              </tr>
            </tfoot>


          </table>
        </div>

      </div>
    </div>


  </div>


@endsection


@section('js')
  <script type="text/javascript" src="{{ asset('js/admin/pasien.js') }}"></script>
@endsection
