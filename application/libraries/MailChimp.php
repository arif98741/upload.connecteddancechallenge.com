<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 1/11/18
 * Time: 2:22 PM
 */

require_once APPPATH.'libraries/vendor/autoload.php';
class MailChimp extends \DrewM\MailChimp\MailChimp
{

    ### adnan mailchimp setting
    /*function __construct($api_key='a03d80aa1d8ecd54778eee7f82142921-us17', $api_endpoint = null)
    {
        parent::__construct($api_key, $api_endpoint);
    }*/



    ### main mailchimp settings
    function __construct($api_key='a43c1195e06a2a4ea0b95781d65ded57-us2', $api_endpoint = null)
    {
        parent::__construct($api_key, $api_endpoint);
    }
}