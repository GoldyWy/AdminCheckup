<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasien;
use App\Checkup;
use App\Jnscheckup;
use App\Antrian;
use App\Pembayaran;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function getDetailPembayaran($kode){
      $checkup = DB::table('checkups as a')
                                ->select('b.nama_pasien as nama','c.nama_jns_checkup as checkup','a.created_at as tanggal')
                                ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                                ->join('pasiens as b', 'a.id_pasien','=','b.id')
                                ->where('a.kode_pembayaran', $kode)
                                ->get()->toArray();
      $data['checkup'] = json_decode(json_encode($checkup), true);

      return view('admin.detail',['data'=>$data]);
    }

    public function getPembayaran()
    {
      $pembayaran = Pembayaran::orderBy('id','desc')->get();
      $countPembayaran = $pembayaran->count();
      if ($countPembayaran>0) {
        $data['pembayaran'] = $pembayaran->toArray();
      }else{
        $data['pembayaran'] = null;
      }
      // dd($pembayaran);


      return view('admin.pembayaran',['data' => $data]);
    }

    public function bayarCheckup(Request $request)
    {
      $time = Carbon::now()->toDateString();
      $totalHarga = DB::table('checkups as a')
                                ->select('c.harga')
                                ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                                ->where('a.kode_pembayaran', $request->kode)
                                ->sum('c.harga');
      if ($totalHarga > 0) {
        $insertPembayaran = Pembayaran::create([
          'kode_pembayaran' => $request->kode,
          'total' => $totalHarga
        ]);
        $ganti = Checkup::where('kode_pembayaran',$request->kode)->update(['lunas'=> 1]);
        $data = Checkup::where('kode_pembayaran',$request->kode)->get()->toArray();
          // ['id_jns_checkup'],'=', $row['id_jns_checkup'],
        foreach ($data as $row) {

          $antrian = Antrian::where('created_at','like', $time.'%')
                            ->where('id_jns_checkup','=', $row['id_jns_checkup'])->orderBy('id', 'desc')->get();
          $dataAntrian = $antrian->toArray();

          $itung = $antrian->count();
          if ($itung == 0) {
            $insertAntrian = Antrian::create([
              'nomor_antrian' => 1,
              'id_checkup' => $row['id'],
              'id_jns_checkup' => $row['id_jns_checkup'],
              'status' => 0
            ])->nomor_antrian;
            echo "Antrian ke ".$insertAntrian;
          }else{
            $insertAntrian = Antrian::create([
              'nomor_antrian' => $dataAntrian[0]['nomor_antrian']+1,
              'id_checkup' => $row['id'],
              'id_jns_checkup' => $row['id_jns_checkup'],
              'status' => 0
            ])->nomor_antrian;
            echo "Antrian ke ".$insertAntrian;
          }

        }
        return redirect(url('admin/pasien'))->with(['success' => 'Pasien dipersilahkan antri']);

      }else {
        return redirect(url('admin/pasien'))->with(['failed' => 'Silahkan pilih checkup']);
      }

    }

    public function ajaxBatalDaftar(Request $request)
    {
      $checkup = Checkup::where('id', $request->id)->delete();
      $totalHarga = DB::table('checkups as a')
                                ->select('c.harga')
                                ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                                ->where('a.kode_pembayaran', $request->kode)
                                ->sum('c.harga');
      $response = array(
          'status' => 'success',
          'msg' => 'Berhasil dibatalkan',
          'total' => $totalHarga
      );
      return response()->json($response);
    }

    public function ajaxDaftar(Request $request)
    {

      $id = Checkup::create([
        'id_pasien' => $request->idpasien,
        'id_jns_checkup' => $request->jnscheckup,
        'kode_pembayaran' => $request->kode,
        'laporan_checkup' => '',
        'lunas' => '0'
      ])->id;

      $jnscheckup = Jnscheckup::where('id', $request->jnscheckup)->get()->toArray();
      $totalHarga = DB::table('checkups as a')
                                ->select('c.harga')
                                ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                                ->where('a.kode_pembayaran', $request->kode)
                                ->sum('c.harga');
      // $id = $this->create($activity)->id;


      $response = array(
          'status' => 'success',
          'msg' => 'Berhasil ditambahkan',
          'data' => [
            'nama' => $jnscheckup[0]['nama_jns_checkup'],
            'harga' => $jnscheckup[0]['harga'],
            'id' => $id,
            'total' => $totalHarga
            ]
      );
      return response()->json($response);
    }

    public function viewDaftar($id)
    {
        // dd($id);
        $random = mt_rand(10,99);


        $time = Carbon::now()->format('ymd');
        $data['kode'] = "P".$id.$random."B".$time;
        $data['pasien'] = Pasien::where('id',$id)->get()->toArray();
        $data['jnscheckup'] = Jnscheckup::where('status',1)->get()->toArray();


        // dd($data['jnscheckup']);
        // dd($time);
        return view('admin.daftarCheckup',['data' => $data]);
    }

    public function getPasien()
    {
      $data['pasien'] = Pasien::orderBy('id', 'desc')->get()->toArray();
      // dd($data['pasien'][0]['id']+1);
      return view('admin.pasien',['data' => $data]);
      // dd($data['pasien']);
    }

    public function postPasien(Request $request)
    {
      // dd($request->tgllahir);
      $this->validate($request,[
          'nama' => 'required',
          'tgllahir' => 'required'
        ],
        [
          'nama.required' => 'Nama harus diisi',
          'tgllahir.required' => 'Tanggal lahir harus diisi'
        ]
      );

      $activity = Pasien::create([
        'nama_pasien' => $request->nama,
        'tgl_lahir' => $request->tgllahir,
      ]);



      if ($activity->exists) {
         return redirect(url('admin/pasien'))->with(['success' => 'Berhasil menambah pasien']);
      } else {
         return redirect(url('admin/pasien'))->with(['failed' => 'Ada kesalahan']);
      }


    }

    public function getRiwayat($id)
    {
      $data['data'] = Pasien::find($id)->toArray();
      $result = DB::table('checkups as a')
                                ->select('a.id','c.nama_jns_checkup as jns_checkup','a.created_at as tanggal')
                                ->join('pasiens as b', 'a.id_pasien', '=', 'b.id')
                                ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                                ->where('a.id_pasien',$id)
                                ->where('a.laporan_checkup','<>','')
                                ->orderBy('a.created_at','desc')
                                ->get()->toArray();
      $data['riwayat'] = json_decode(json_encode($result), true);
      return view('admin.riwayat',['data' => $data]);
      // dd($data['riwayat']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
