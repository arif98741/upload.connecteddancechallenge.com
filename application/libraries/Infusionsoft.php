<?php
/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 9/7/17
 * Time: 11:49 AM
 */

/*if (!defined('BASEPATH')) exit('No direct script access allowed');
set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
require_once APPPATH . 'third_party/Google/Client.php';*/

if (!defined('BASEPATH')) exit('No direct script access allowed');
set_include_path(APPPATH . 'libraries/' . PATH_SEPARATOR . get_include_path());
//require_once APPPATH . 'libraries/google-api-php-client/src/Google/autoload.php';

//require_once APPPATH.'libraries/google-api-php-client/src/Google/autoload.php';
require_once APPPATH.'libraries/vendor/autoload.php';

class Infusionsoft extends Infusionsoft\Infusionsoft
{
    function __construct(array $config = array())
    {
        parent::__construct($config);
    }

}