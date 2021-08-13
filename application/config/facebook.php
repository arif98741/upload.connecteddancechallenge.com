<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Facebook API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  facebook_app_id               string   Your Facebook App ID.
|  facebook_app_secret           string   Your Facebook App Secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  facebook_logout_redirect_url  string   URL to redirect back to after logout. (do not include base URL)
|  facebook_permissions          array    Your required permissions.
|  facebook_graph_version        string   Specify Facebook Graph version. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to check for valid access token on every page load.
*/

///for localhost
/*$config['facebook_app_id']              = '197762530736742';
$config['facebook_app_secret']          = '8c34bbf806202aee94ded1f1268dcca2';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'FacebookCtrl';
$config['facebook_login_user_redirect_url']  = 'FacebookCtrl/userAuth';
$config['facebook_logout_redirect_url'] = 'FacebookCtrl/logout';
$config['facebook_permissions']         = array('email','publish_pages','user_videos','publish_actions','user_posts','user_friends','user_photos');
//$config['facebook_graph_version']       = 'v2.6';
$config['facebook_graph_version']       = 'v2.9';
$config['facebook_auth_on_load']        = TRUE;*/


/// for server testing
$config['facebook_app_id']              = '608010926254078';
$config['facebook_app_secret']          = '5dc7fd83b54342ad898558353ef1e0f1';
$config['facebook_login_type']          = 'web';
$config['facebook_login_redirect_url']  = 'FacebookCtrl';
$config['facebook_login_user_redirect_url']  = 'FacebookCtrl/userAuth';
$config['facebook_logout_redirect_url'] = 'FacebookCtrl/logout';
$config['facebook_permissions']         = array('email','publish_pages','user_videos','publish_actions','user_posts','user_friends','user_photos');
//$config['facebook_graph_version']       = 'v2.6';
$config['facebook_graph_version']       = 'v2.10';
$config['facebook_auth_on_load']        = TRUE;