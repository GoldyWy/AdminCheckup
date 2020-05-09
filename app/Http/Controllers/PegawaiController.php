<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jnscheckup;
use App\Antrian;
use Carbon\Carbon;
use App\Checkup;
use DB;



class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pegawai.dashboard');
    }

    public function ajaxAntrian(Request $request)
    {
      $time = Carbon::now()->toDateString();

      $antrian = Antrian::where('id_jns_checkup',$request->id)->where('status','0')->where('created_at','like', $time.'%')->get();
      $countAntrian = $antrian->count();

      if ($countAntrian>0) {
        $data['antrian'] = $antrian->toArray();
      }else{
        $data['antrian'] = null;
      }

      return response()->json($data);
    }

    public function postLaporan(Request $request)
    {
      $this->validate($request,[
          'id' => 'required',
          'laporan' => 'required'
        ],
        [
          'id.required' => 'ID Error',
          'laporan.required' => 'Laporan harus diisi'
        ]
      );

      $update = Checkup::where('id',$request->id)->update(['laporan_checkup' => $request->laporan]);

      return redirect(url('pegawai/antrian/'.$request->idj))->with(['success' => 'Laporan berhasil disimpan']);

      // dd($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function detailAntrian($id)
     {
       $time = Carbon::now()->toDateString();
       $antrian = Antrian::where('id_jns_checkup',$id)->where('status','0')->where('created_at','like', $time.'%')->get();
       $data['id'] = $id;
       $countAntrian = $antrian->count();
       if ($countAntrian>0) {
         $data['antrian'] = 1;
         $arrayAntrian = $antrian->toArray();
         $terpanggil = $arrayAntrian[0];

         $editStatus = Antrian::where('id',$terpanggil['id'])->update(['status'=> 1]);

         $detail = DB::table('checkups as a')
                           ->select('b.id as id_pasien','a.id as id_checkup','b.nama_pasien','c.nama_jns_checkup as jns_checkup','a.created_at as tanggal')
                           ->join('pasiens as b', 'a.id_pasien', '=', 'b.id')
                           ->join('jnscheckups as c', 'a.id_jns_checkup','=','c.id')
                           ->where('a.id',$terpanggil['id_checkup'])
                           ->get()->toArray();

          $data['detail'] = json_decode(json_encode($detail), true);

          $riwayat= Checkup::where('id_pasien',$data['detail'][0]['id_pasien'])->where('laporan_checkup','<>','')->get();
          $countRiwayat = $riwayat->count();
          if ($countRiwayat>0) {
            $data['riwayat'] = $riwayat->toArray();
          }else {
            $data['riwayat'] = null;
          }


          // dd($data);

       }else{
         $data['antrian'] = 0;
         $data['detail'] = [];
         $data['riwayat'] = [];
       }
       // dd($data);
       return view('pegawai.detail',['data' => $data]);
     }

     public function getAntrian($id)
     {
       $jnscheckup = Jnscheckup::where('id',$id)->get();
       $countJnschehckup = $jnscheckup->count();
       $data['id'] = $id;
       $jnsArray = $jnscheckup->toArray();
       if ($countJnschehckup>0) {
         $data['jnscheckup'] = $jnsArray[0];
       }else{
         $data['jnscheckup'] = null;
       }
       $time = Carbon::now()->toDateString();
       $terpanggil = Antrian::where('id_jns_checkup',$id)->where('status','1')->where('created_at','like', $time.'%')->orderBy('id','desc')->get();
       $countTerpanggil = $terpanggil->count();

       $antrian = Antrian::where('id_jns_checkup',$id)->where('status','0')->where('created_at','like', $time.'%')->get();
       $countAntrian = $antrian->count();

       if ($countTerpanggil>0) {
         $terpanggilArray = $terpanggil->toArray();
         $data['terpanggil'] = $terpanggilArray[0];
       }else{
         $data['terpanggil'] = null;
       }

       if ($countAntrian>0) {
         $data['antrian'] = $antrian->toArray();
       }else{
         $data['antrian'] = null;
       }



       return view('pegawai.panggilAntrian', ['data'=> $data]);
     }

     public function antrian()
     {
       // dd('bgst');
       $jnscheckup = Jnscheckup::all();
       $count = $jnscheckup->count();
       // dd($count);
       if ($count>0) {
         $data['jnscheckup'] = $jnscheckup->toArray();
       }else{
         $data['jnscheckup'] = null;
       }
       // dd($jnscheckup);

       return view('pegawai.antrian',['data'=> $data]);
     }

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
