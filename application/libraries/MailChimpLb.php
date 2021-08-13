<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 1/11/18
 * Time: 1:54 PM
 */

require_once APPPATH.'libraries/vendor/autoload.php';
class MailChimpLb extends DrewM\MailChimp\MailChimp
{
    public function __construct($api_key, $api_endpoint = null)
    {
        parent::__construct($api_key, $api_endpoint);
    }
}