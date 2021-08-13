<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/20/17
 * Time: 3:12 PM
 */
class UserFunctionModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function replaceSpacialCharacter($text,$with){

        $specialChar = array("!", "@", "#", "$", "%", "^", "&", "*", ".", "~", " ", "/", "+", "(", ")", "'", ":", ";", "!", "?", "[", "]", "{", "}", "<", ">", "|", ',' , " ", '"',"\r\n","\r", "\n","’",'+','*');
        $convertedText = str_replace($specialChar, $with, trim($text));
        return $convertedText;
    }

    public function replaceDashWithUnderscore($text){
        return str_replace('-','_',trim($text));
    }

    public function replaceDashWithSpace($text){
        return str_replace('-',' ',trim($text));
    }

    function convertDateInMysqlFormat($date){
        return date('Y-m-d H:i',strtotime(str_replace('/','-',$date)));
    }

}