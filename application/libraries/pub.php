<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pub{
    function CurlPost($postURL, $postdata='')
    {
        $ch = curl_init();// create a new cURL resource
        curl_setopt($ch, CURLOPT_URL, $postURL);// set URL and other appropriate options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);// grab URL and pass it to the browser
        curl_close($ch);// close cURL resource, and free up system resources
        return $result;
    }

    public function check_session($session_id='')
    {
        if( empty($_SERVER["HTTP_USER_AGENT"]) )
        {
            exit(201);
        }
        else if( empty($_SERVER["REMOTE_ADDR"]) )
        {
            exit(202);
        }
        else if( empty($session_id) )
        {
            exit(203);
        }
        else
        {
            $url = base_url().'php_test/check_session';
            $data = array(
                'session_id'=>$session_id,
                'ip_address'=>$_SERVER["REMOTE_ADDR"],
                'user_agent'=>$_SERVER["HTTP_USER_AGENT"],
            );
            $data = json_decode($this->CurlPost($url,$data));
            $data = $this->o2a($data);
            if( $data['status']!=100 )
            {
                var_dump($data);
                exit();
            }
        }
    }

    function trim_val($in_data)
    {
        if( !empty($in_data) )
        {
            if( is_array($in_data) )
            {
                foreach ($in_data as $key=>$value) {
                    $in_data[$key] = trim($value);
                }
                return $in_data;
            }
            else
            {
                return trim($in_data);
            }
        }
        else
        {
            return $in_data;
        }
    }

    function urldecode_val($in_data)
    {
        if( !empty($in_data) )
        {
            if( is_array($in_data) )
            {
                foreach ($in_data as $key=>$value) {
                    $in_data[$key] = urldecode($value);
                }
                return $in_data;
            }
            else
            {
                return urldecode($in_data);
            }
        }
        else
        {
            return $in_data;
        }
    }

    function utf8_decode_val($in_data)
    {
        if( !empty($in_data) )
        {
            if( is_array($in_data) )
            {
                foreach ($in_data as $key=>$value) {
                    $in_data[$key] = utf8_decode($value);
                }
                return $in_data;
            }
            else
            {
                return utf8_decode($in_data);
            }
        }
        else
        {
            return $in_data;
        }
    }

    function o2a($input)
    {
        if( is_array($input) )
        {
            foreach ($input as $key=>$value) {
                if( is_object($value) )
                {
                    $input[$key] = get_object_vars($value);
                }
                else
                {
                    $input[$key] = $this->o2a($value);
                }
            }
            return $input;
        }
        else if( is_object($input) )
        {
            return get_object_vars($input);
        }
        else
        {
            return $input;
        }
    }
}
?>