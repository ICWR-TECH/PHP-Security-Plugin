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

    function anti_xss() {

        if (!empty($_GET)) {

            foreach($_GET as $key => $value) {

                if (preg_match("/<|>/", strtolower($_GET[$key]))) {

                    echo security::block();
                    exit();

                }

            }

        }

    }

    function anti_sqli() {

        if (!empty($_GET)){

            $payload = "\"|'|union select|union+select|order by|order+by";

            foreach($_GET as $key => $value) {

                if (preg_match("/$payload/", strtolower($_GET[$key]))) {

                    echo security::block();
                    exit();

                }

            }

        }

    }

    function all_use() {

        security::headers();
        security::filter_user_agent();
        security::anti_xss();
        security::anti_sqli();

    }

}

if (!empty($_GET)) {

    security::all_use();

}

?>
