<?php


namespace App\Helper;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Propaganistas\LaravelPhone\PhoneNumber;

class Helper
{
    public function generateTxnID($n) {

        // Take a generator string which consist of
        // all numeric digits
        $generator = "1357902468";

        // Iterate for n-times and pick a single character
        // from generator and append it to $result

        // Login for generating a random character from generator
        //     ---generate a random number
        //     ---take modulus of same with length of generator (say i)
        //     ---append the character at place (i) from generator to result

        $result = "";

        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }

        // Return result
        return $result;
    }

    public function airtelTransID()
    {

        $transID="MP".$this->generateTxnID(6).$this->generateTxnID(4)."C".$this->generateTxnID(5);

        return $transID;
    }

    public static function XMLStringToObject($xml_string)
    {
        return json_decode(json_encode((array)simplexml_load_string($xml_string)));
    }

    public function validateNumber(Request $request)
    {

        try{

            $object = new PhoneNumber(PhoneNumber::make($request->phone_number, $request->country)->formatE164());

            $geoCoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
            $country_name = \libphonenumber\PhoneNumberUtil::getInstance()->parse($request->phone_number, $request->country);

            $carrierMapper = \libphonenumber\PhoneNumberToCarrierMapper::getInstance();
            $chNumber = \libphonenumber\PhoneNumberUtil::getInstance()->parse($request->phone_number, $request->country);

            $timezoneMapper = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance();
            $usNumber = \libphonenumber\PhoneNumberUtil::getInstance()->parse($object->formatInternational(), $request->country);

            if(count($timezoneMapper->getTimeZonesForNumber($usNumber))==1)
            {
                $time_zone = $timezoneMapper->getTimeZonesForNumber($usNumber)[0];
            }
            else{
                $time_zone = $timezoneMapper->getTimeZonesForNumber($usNumber);
            }


            $data['data'] = ['type'=> (string) $object->getType(),
                'country_code'=>(string) $object->getCountry(),
                'country_name'=>$geoCoder->getDescriptionForNumber($country_name,'en'),
                'network_operator'=> $carrierMapper->getNameForNumber($chNumber,'en'),
                'time_zone'=>$time_zone,
                'phone_number'=>PhoneNumber::make($request->phone_number, $request->country)->formatE164()];
            $data['message'] = 'Phone number is a valid phone number';
            $data['notification'] = 'success';


            return json_encode($data);

        }catch (\Exception $e)
        {
            Log::channel('userMgt')->debug('VALIDATE NUMBER :-->'.$e->getLine().'----->'.$e->getTrace().'----->'.$e->getMessage());
            $data['message']=$e->getMessage();
            $data['notification']='failure';

            return json_encode($data);
        }


    }

    public function getPhoneNumber($request)
    {

        try{

            $object = new PhoneNumber(PhoneNumber::make($request->phone_number, $request->country)->formatE164());

            $geoCoder = \libphonenumber\geocoding\PhoneNumberOfflineGeocoder::getInstance();
            $country_name = \libphonenumber\PhoneNumberUtil::getInstance()->parse($request->phone_number, $request->country);

            $carrierMapper = \libphonenumber\PhoneNumberToCarrierMapper::getInstance();
            $chNumber = \libphonenumber\PhoneNumberUtil::getInstance()->parse($request->phone_number, $request->country);

            $timezoneMapper = \libphonenumber\PhoneNumberToTimeZonesMapper::getInstance();
            $usNumber = \libphonenumber\PhoneNumberUtil::getInstance()->parse($object->formatInternational(), $request->country);

            if(count($timezoneMapper->getTimeZonesForNumber($usNumber))==1)
            {
                $time_zone = $timezoneMapper->getTimeZonesForNumber($usNumber)[0];
            }
            else{
                $time_zone = $timezoneMapper->getTimeZonesForNumber($usNumber);
            }


            $phone_number = PhoneNumber::make($request->phone_number, $request->country)->formatE164();

            return $phone_number;

            $data['data'] = ['type'=> (string) $object->getType(),
                'country_code'=>(string) $object->getCountry(),
                'country_name'=>$geoCoder->getDescriptionForNumber($country_name,'en'),
                'network_operator'=> $carrierMapper->getNameForNumber($chNumber,'en'),
                'time_zone'=>$time_zone,
                'phone_number'=>PhoneNumber::make($request->phone_number, $request->country)->formatE164()];
            $data['message'] = 'Phone number is a valid phone number';
            $data['notification'] = 'success';


            return json_encode($data);

        }catch (\Exception $e)
        {
            Log::channel('userMgt')->debug('VALIDATE NUMBER :-->'.$e->getLine().'----->'.$e->getTrace().'----->'.$e->getMessage());
            $data['message']=$e->getMessage();
            $data['notification']='failure';

            return json_encode($data);
        }


    }

    public function token()
    {
        return "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjY3ODJiZmRlOGQ5MWJkMjkwYmVkOWYxOTJiMjUwNTM3OTI3MGQxMzIyYjhhNjdmODIxYjVmZjg0ZTVjZDAyMTUzYTYxNzhmZjllMTMyNGVkIn0.eyJhdWQiOiIxIiwianRpIjoiNjc4MmJmZGU4ZDkxYmQyOTBiZWQ5ZjE5MmIyNTA1Mzc5MjcwZDEzMjJiOGE2N2Y4MjFiNWZmODRlNWNkMDIxNTNhNjE3OGZmOWUxMzI0ZWQiLCJpYXQiOjE1OTQwMjczMjQsIm5iZiI6MTU5NDAyNzMyNCwiZXhwIjoxNjA5OTI0OTI0LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.HbnggFW9KuAQzpZPQydH9Q-eikZWmg5wj9dHLKoyzXhUywLm0y1KnjCtUF_uxf6D9QrzNQhhuhi8pv0GObB51t636pWxQ1jUg3vsoP7SP_tv0woloVudJ3B3xLBnM7AZwIC4SLrNdYaQQm5asgQpAlffdnE5sH2da3raShbbUCjFnJZPI6RsdcLpMoB04AbmsFBEDj5r9ZGdzNigaouDTbhjdJwEAJqt1R3Ll8I20DxeNBYF1gzp8HYbi16mJKc-1n8-nSRC-iIKynueIkwW_rVq4YBxUzGkuVf2TjHt67QTy1oxAy1mfeEdx9xqY0bIN6Dv87i26pMSDQX2OqbmXxnCU2EqvnPvTgyYGRNvBnkGFzXaoISis__fUjCg2N3B7fS8LA6QQ5xCXqTuaxbzPEHpoxyKmMI7Hfue8ialVLGmzAF1q_1lWWWu1LSXkiOPyQgtuWwOlEOzc1dKCMzAhUQHbe0tAnRG7hIqw9MK7ueaAKYUml7KQv1z7wILCKQI6DcflFirwzO5E94oSxRZ9oNAB98SfqShLzcg5g6FccqO-sykoxh1dYt9eJIK36TFy4mCgT_Iv1nfaU8z2s6XcqPnnlMONUp5wkH4b3CxXbD5PjMQ6aGstcbnYss_VJD1AT8gbIDIoKebrRMr3GIT-butJKhVcn1qi0nECHTYvJE";
    }
}
