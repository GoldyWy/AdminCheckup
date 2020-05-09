<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jnscheckup;
use App\Antrian;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['checkup'] = Jnscheckup::all()->toArray();

        return view('home.dashboard', ['data' => $data ]);
        // dd($data);
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $time = Carbon::now()->toDateString();
        $data['jnscheckup'] = Jnscheckup::find($id);
        $data['time'] = Carbon::parse(now()->toDateTimeString())->format('d F Y | G:i');
        // dd($data['jnscheckup']->toArray());
        // $antrian = Antrian::where('id_jns_checkup',$id);
        // $terpanggil = Antrian::where('id_jns_checkup',$id)->where('status','1')->where('created_at','like', $time.'%')->orderBy('id','desc')->get();
        // $countTerpanggil = $terpanggil->count();
        // $antrian = Antrian::where('id_jns_checkup',$id)->where('status','0')->where('created_at','like', $time.'%')->get();
        // $countAntrian = $antrian->count();
        // if ($countTerpanggil>0) {
        //   $terpanggilArray = $terpanggil->toArray();
        //   $data['terpanggil'] = $terpanggilArray[0];
        // }else{
        //   $data['terpanggil'] = null;
        // }
        //
        // if ($countAntrian>0) {
        //   $data['antrian'] = $antrian->toArray();
        // }else{
        //   $data['antrian'] = null;
        // }

        return view('home.antrian', ['data' => $data ]);
        // dd($data);
    }

    public function ajaxShow(Request $request)
    {
      $time = Carbon::now()->toDateString();
      // $date = date('d F Y', strtotime($time));

      $jnscheckup = Jnscheckup::where('id',$request->id)->get();
      $countJnscheckup = $jnscheckup->count();

      $terpanggil = Antrian::where('id_jns_checkup',$request->id)->where('status','1')->where('created_at','like', $time.'%')->orderBy('id','desc')->get();
      $countTerpanggil = $terpanggil->count();

      $antrian = Antrian::where('id_jns_checkup',$request->id)->where('status','0')->where('created_at','like', $time.'%')->get();
      $countAntrian = $antrian->count();

      if ($countJnscheckup>0) {
        $jnscheckupArray = $jnscheckup->toArray();
        $data['jnscheckup'] = $jnscheckupArray;
      }

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

      $data['time'] = Carbon::parse(now()->toDateTimeString())->format('d F Y | G:i');

      return response()->json($data);
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
