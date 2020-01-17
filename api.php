<?php 
	class ApiCardPr {
		private $apiKey;
		private $link;
		private $request_url;
		public function __construct( $apiKey, $link ){
			$this->apiKey = $apiKey;
			$this->link = $link;
			$this->request_url = 'https://core.codepr.ru/api/v2/crm/';
		}

		public function user_create_or_update( $data ){
			$url = "{$this->request_url}user_create_or_update";
			$data['app_key'] = $this->apiKey;
			$data['link'] = $this->link;
			//return json_encode($data , JSON_FORCE_OBJECT);
			$options = array(
    			'http' => array(
        			'header'  => "Content-type: application/json",
        			'method'  => 'POST',
        			'content' => json_encode($data , JSON_FORCE_OBJECT)
    			)
			);
			$context  = stream_context_create($options);
			$result = file_get_contents($url, false, $context);
			return $result;
		}

	} 

	