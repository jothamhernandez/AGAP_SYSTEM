<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoggedSessions extends Model
{
    //
    public $fillable = ['country_name','country_code','region_code','region_name','city_name','zip_code','iso_code','iso_code','postal_code','latitude','longitude','metro_code','area_code','user_id','ip_address'];

    public static function format(array $data, $ip){
        $user_id = Auth::user()->id;
        $toInsert = [
            'country_name'=>@$data['countryName'],
            'country_code'=>@$data['countryCode'],
            'region_code'=>@$data['regionCode'],
            'region_name'=>@$data['regionName'],
            'city_name'=>@$data['cityName'],
            'zip_code'=>@$data['zipCode'],
            'iso_code'=>@$data['isoCode'],
            'postal_code'=>@$data['postalCode'],
            'latitude'=>@$data['latitude'],
            'longitude'=>@$data['longitude'],
            'metro_code'=>@$data['metroCode'],
            'area_code'=>@$data['areaCode'],
            'user_id'=>$user_id,
            'ip_address'=>$ip
        ];
        return $toInsert;
    }
}
