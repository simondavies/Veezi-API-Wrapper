<?php
namespace VeeziAPI;

use GuzzleHttp\Client;
use Carbon\Carbon;

class VeeziAPIWrapper {

	/**
	 * @var string
	 */
	private $api_token;
         /**
          * @var string
          */
         private $api_url = 'https://api.us.veezi.com';
         /**
          * @var string
          */
         private $api_version = 'v1';

	function __construct($api_token) {
		$this->api_token = ['VeeziAccessToken' =>$api_token];

	}
}