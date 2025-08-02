<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\IpAddress;
use Session;

class GetIpAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $ipaddress = $_SERVER['REMOTE_ADDR'];
        // echo '<h1>'.$ipaddress.'</h1>';
       
        $ip1 = IpAddress::where('ip_address',$ipaddress)->first();
        if($ip1){
            $ip = IpAddress::where('ip_address',$ipaddress)->first();
        }else{
            $ip = new IpAddress();
        }
        $ip->ip_address = $ipaddress;
        $ip->save();
      

        return $next($request);
    }
}
