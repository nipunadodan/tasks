<?php
/**
 * Created by PhpStorm.
 * User: nipuna
 * Date: 05/01/20
 * Time: 20:26
 */

namespace Orange;


class ApiConnect{
    public $token;

    public static function getJSON($url,$data=''){
        $url = $url.'?'.http_build_query($data);
        $ch = curl_init();

        curl_setopt_array($ch, array(
            //CURLOPT_PORT => "8013",
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => '',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Accept-Language: en_US',
                "cache-control: no-cache"
            ),
        ));

        $result  = curl_exec($ch);

        if ($result === false){
            $response = array(
                'message' => curl_error($ch),
                'status' => 'danger'
            );
        }else{
            $json = json_decode($result);
            if(isset($json->err)) {
                $return = array(
                    'message' => $json->err,
                    'status' => 'danger',
                    'original' => $result
                );
                return json_encode($return);
            }elseif (isset($json->error)){
                $return = array(
                    'message' => $json->error,
                    'status' => 'danger',
                    'original' => $result
                );
                return json_encode($return);
            }else{
                $return = array(
                    'message' => $result,
                    'status' => 'success'
                );
                return json_encode($return);
            }
        }
        curl_close($ch);

        return json_encode($response);
    }

    public static function postJSON($url, $data){
        //$token = self::getAccessToken();

        $ch = curl_init();

        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
                'Accept: application/json',
                'Accept-Language: en_US',
            ),
        ));

        $result  = curl_exec($ch);

        if ($result === FALSE) {
            /* Handle error */
            $return = array(
                'message' => curl_error($ch),
                'status' => 'danger',
                'respond' => 'No'
            );
        }else{
            $json = json_decode($result);

            if(isset($json->err)) {
                $return = array(
                    'message' => $json->err,
                    'status' => 'danger',
                    'original' => $result
                );
            }elseif (isset($json->error)){
                $return = array(
                    'message' => $json->error,
                    'status' => 'danger',
                    'original' => $result
                );
            }else{
                $return = array(
                    'message' => $result,
                    'status' => 'success'
                );
                //return $result; //even though this is post something might come out, so catch it here
            }
        }

        curl_close($ch);

        return json_encode($return);
    }

    public static function xputJSON($url, $data){ //TODO: Proposed for deletion
        $curl = curl_init();

        curl_setopt_array($curl, array(
            //CURLOPT_PORT => "8013",
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
                "cache-control: no-cache",
                "Accept: application/json",
                "Accept-Language: en_US"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error :" . $err;
        } else {
            return $response;
        }
    }

    public static function putJSON($url, $post){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);


        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Accept: application/json','Accept-Language: en_US'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // DATA ARRAY
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

        $result  = curl_exec($ch);

        curl_close($ch);

        if ($result === false){
            return json_encode(array(
                'message' => curl_error($ch),
                'status' => 'danger'
            ));
        }else{
            return json_encode(array(
                'message' => $result,
                'status' => 'success'
            ));
        }
    }
}