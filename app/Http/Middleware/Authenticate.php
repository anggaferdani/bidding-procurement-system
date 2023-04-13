<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
        if(!$request->expectsJson()){
            if($request->routeIs('compro.superadmin.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('compro.login');
            }if($request->routeIs('compro.admin.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('compro.login');
            }if($request->routeIs('compro.creator.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('compro.login');
            }if($request->routeIs('compro.helpdesk.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('compro.login');
            }if($request->routeIs('eproc.superadmin.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('eproc.login');
            }if($request->routeIs('eproc.admin.*')){
                session()->flash('fail', 'Tidak dapat mengarahkan ke route tujuan. login terlebih dahulu');
                return route('eproc.login');
            }
        }
    }
}
