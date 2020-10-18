<?php

// Simple Security Plugins By R&D ICWR
// How to use ? include this script to your php config or php file
// Copyright (c)2020 - R&D ICWR

class security {

    function block() {

        header("HTTP/1.1 403 Forbidden");
        $html = "<title>Your Request Blocked</title>Your Request Blocked, Security by <a href=\"https://github.com/ICWR-TECH/PHP-Security-Plugin\">https://github.com/ICWR-TECH/PHP-Security-Plugin</a>";
        return $html;

    }

    function headers() {

        header("X-Frame-Options: SAMEORIGIN");

    }

    function filter_user_agent() {

        $str = "google|facebook|opera|mozilla|safari|whatsapp|telegram|twitter|yahoo|bing";

        if (!preg_match("/$str/", strtolower($_SERVER['HTTP_USER_AGENT']))) {

            echo security::block();
            exit();

        }

    }

    function parameters_filter() {

        if (!empty($_GET)){

            $payload = "\"|'|-|.|+|\(|\)|<|>|;";

            foreach($_GET as $key => $value) {

                if (preg_match("/$payload/", strtolower($_GET[$key]))) {

                    echo security::block();
                    exit();

                }

            }

        }

    }

    function all_use() {

        security::parameters_filter();

    }

}

// security::headers(); // Custom Header
security::filter_user_agent();

if (!empty($_GET)) {

    security::all_use();

}

?>
