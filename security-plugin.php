<?php

###################################
# Mini PHP Security Plugin V 1.0  #
# By ICWR-TECH                    #
# Copyright (c)2019 - Afrizal F.A #
###################################

// -------------------------- How To Use -------------------------- //
// How To Use ?
// Include This Script
// You can Give function if you feel sensitive Page, Example code
// security::filter_user_agent(); security::filter_sqli(); / security::filter_xss(); / security::filter_rce(); / security::filter_lfi();
// ---------------------------------------------------------------- //

error_reporting(0);

class security{

    function block_page(){
        return "<title>Security By ICWR-TECH</title><i>Security By ICWR-TECH</i>";
    }

    function filter_user_agent(){
        $str="Google|google|facebook|Facebook|Opera|opera|Mozilla|mozilla|Safari|safari|WhatsApp|Whatsapp|whatsapp";
        if(!preg_match("/$str/",$_SERVER['HTTP_USER_AGENT'])){
            echo security::block_page();
            exit();
        }
    }

    function filter_sqli(){
        $str="union select|order by|group_concat|concat|'=''or'|'or'|'='";
        if($_POST or $_GET){
            foreach($_POST as $key=>$x){
                if(!empty($_POST[$key]) && preg_match("/$str/",strtolower($_POST[$key]))){
                    echo security::block_page();
                    exit();
                }
            }
            foreach($_GET as $key=>$x){
                if(!empty($_GET[$key]) && preg_match("/$str/",strtolower($_GET[$key]))){
                    echo security::block_page();
                    exit();
                }
            }
        }
    }

    function filter_xss(){
        if($_POST or $_GET){
            foreach($_POST as $key=>$x){
                if(!empty($_POST[$key]) && !strip_tags($x)){
                    echo security::block_page();
                    exit();
                }
            }
            foreach($_GET as $key=>$x){
                if(!empty($_GET[$key]) && !strip_tags($x)){
                    echo security::block_page();
                    exit();
                }
            }
        }
    }

    function filter_rce(){
        $str="<?php";
        if($_POST or $_GET){
            foreach($_POST as $key=>$x){
                if(!empty($_POST[$key]) && preg_match("/$str/",$_POST[$key])){
                    echo security::block_page();
                    exit();
                }
            }
            foreach($_GET as $key=>$x){
                if(!empty($_GET[$key]) && preg_match("/$str/",$_GET[$key])){
                    echo security::block_page();
                    exit();
                }
            }
        }
    }

    function filter_lfi(){
        $str="../|./";
        if($_POST or $_GET){
            foreach($_POST as $key=>$x){
                if(!empty($_POST[$key]) && preg_match("/$str/",$_POST[$key])){
                    echo security::block_page();
                    exit();
                }
            }
            foreach($_GET as $key=>$x){
                if(!empty($_GET[$key]) && preg_match("/$str/",$_GET[$key])){
                    echo security::block_page();
                    exit();
                }
            }
        }
    }

}

?>
