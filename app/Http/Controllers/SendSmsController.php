<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Plivo\RestClient;
//use App\Traits\LocationsTrait;


class SendSmsController extends Controller
{
    //use LocationsTrait;

    public function sendSms(){
        $client = new RestClient("MAZGY3ZJC0OTQXNTJMYJ", "NjljOWU1ODk4NTgzNzRiYmJjYzU3MWVjNmVjNjZm");
        $message_created = $client->messages->create(
            '+201062501779',
            ['+201143959552'],
            'Hello world!'
        );
        if($message_created){echo "done";}else{echo "false";}
    }

    public function video(){
        return view('video');
    }

    public function test()
    {
        $lat = '30.071790';
        $lng = '31.344034';



            /*$address ="16 Kamel El kazar street ain shams"; // Google HQ
            $prepAddr = str_replace(' ','+',$address);
            $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
            $output= json_decode($geocode);
            $latitude = $output->results[0]->geometry->location->lat;
            $longitude = $output->results[0]->geometry->location->lng;

            return "latitude - ".$latitude;
        return "longitude - ".$longitude;



            /*$lat=$_POST['latitude'];
            $long=$_POST['longitude'];

            $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false";
            $json = @file_get_contents($url);
            $data = json_decode($json);
            $status = $data->status;
            $address = '';
            if($status == "OK")
            {
                echo $address = $data->results[0]->formatted_address;
            }
            else
            {
                echo "No Data Found Try Again";
            }*/

    }
}
