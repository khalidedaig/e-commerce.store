<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class GeoIp
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
    $currency = 'MAD';
    // if ($details = Location::get(\request()->ip())) {
    //   $countryName = $details->countryName();
    //   if (
    //     $countryName === 'France' ||
    //     $countryName === 'Germany' ||
    //     $countryName === 'United Kingdom' ||
    //     $countryName === 'Italy' ||
    //     $countryName === 'Spain' ||
    //     $countryName === 'Ukraine' ||
    //     $countryName === 'Poland' ||
    //     $countryName === 'Romania' ||
    //     $countryName === 'Belgium' ||
    //     $countryName === 'Greece' ||
    //     $countryName === 'Portugal' ||
    //     $countryName === 'Sweden' ||
    //     $countryName === 'Hungary' ||
    //     $countryName === 'Austria' ||
    //     $countryName === 'Switzerland' ||
    //     $countryName === 'Denmark' ||
    //     $countryName === 'Slovakia' ||
    //     $countryName === 'Monaco' ||
    //     $countryName === 'Luxembourg' ||
    //     $countryName === 'Slovenia' ||
    //     $countryName === 'Croatia' ||
    //     $countryName === 'Ireland'
    //   )
    //     $currency = 'EUR';

    //   else if (
    //     $countryName === "Antigua" ||
    //     $countryName === "Barbuda" ||
    //     $countryName === "Australia" ||
    //     $countryName === "Bahamas" ||
    //     $countryName === "Barbados" ||
    //     $countryName === "Belize" ||
    //     $countryName === "Bermuda" ||
    //     $countryName === "Brunei" ||
    //     $countryName === "Canada" ||
    //     $countryName === "Cayman Islands" ||
    //     $countryName === "Dominica" ||
    //     $countryName === "East Timor" ||
    //     $countryName === "Ecuador" ||
    //     $countryName === "El Salvador" ||
    //     $countryName === "Fiji" ||
    //     $countryName === "Grenada" ||
    //     $countryName === "Guyana" ||
    //     $countryName === "Hong Kong" ||
    //     $countryName === "Jamaica" ||
    //     $countryName === "Kiribati" ||
    //     $countryName === "Liberia" ||
    //     $countryName === "Marshall Islands" ||
    //     $countryName === "Federated States of Micronesia" ||
    //     $countryName === "Namibia" ||
    //     $countryName === "Nauru" ||
    //     $countryName === "New Zealand" ||
    //     $countryName === "Palau" ||
    //     $countryName === "Saint Kitts  " ||
    //     $countryName === "Nevis" ||
    //     $countryName === "Saint Lucia" ||
    //     $countryName === "Saint Vincent" ||
    //     $countryName === "the Grenadines" ||
    //     $countryName === "Singapore" ||
    //     $countryName === "Solomon Islands" ||
    //     $countryName === "Suriname" ||
    //     $countryName === "Taiwan" ||
    //     $countryName === "Trinidad" ||
    //     $countryName === "Tobago" ||
    //     $countryName === "Tuvalu" ||
    //     $countryName === "United States" ||
    //     $countryName === "Zimbabwe"
    //   )
    //     $currency = 'USD';

    //   if ($countryName === 'Morocco')
    //     $currency = 'MAD';
    // }

    $request->merge(['currency' => $currency]);
    return $next($request);
  }
}
