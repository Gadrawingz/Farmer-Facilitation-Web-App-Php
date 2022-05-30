<?php

class Functions {

	// APP NAME
	public function getAppName() {
		return ("Farmers facilitation Web app");
	}


	public function httpPost($url, $data) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}

	public function getData($url) {
	    $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
	}

}
?>
