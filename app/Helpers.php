<?php

namespace App;


class Helpers
{

    public static function HTTPPost($url, array $params)
    {
        $query = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function sendMail($user)
    {
        $to = $user->email;
        $subject = "Account Approved - Your Username & Password";

        $html = "
            <html>
            <body style='text-align:center; margin:auto '>
            <h1>Welcome to <i>X {$user->name}!</i></h1>
            <h2>Your account has been approved.</h2>
            
            <blockquote 
                style='color: #456;
                margin-left: 0;
                margin-top: 2em;
                margin-bottom: 2em;'>
            <span>Your Email: {$user->email}</span> </br>
            <span>Your Password: {$user->bio}</span>
            </blockquote>
            
            <p><span style='color: #c0392b;
                font-weight: 600;
                text-decoration: underline;'>Good luck</span></p>
            </body>
            </html>
        ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: noreply@X.com";
        mail($to, $subject, $html, $headers);
    }


    public static function slugit($str, $replace=array(), $delimiter='-') {
        if ( !empty($replace) ) {
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return substr($clean, 0, 18);
    }
}
