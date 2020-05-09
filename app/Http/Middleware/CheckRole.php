<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Session::get('role') != null) {
        if (Session::get('role') == 'admin') {
          return redirect(url('admin/pasien'));
        }
        if (Session::get('role') == 'pegawai') {
          return redirect(url('pegawai/antrian'));
        }
        if (Session::get('role') == 'superdmin') {
          return redirect(url('superadmin'));
        }
      }else {
        return redirect(url(''));
      }

        // return $next($request);
    }
}
