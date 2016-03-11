<?php
require_once 'HTTP/Request2.php';
require_once 'classes/Constants.class.php';

class Rest {

	public $constants = '';
	
	public function authorize() {
		
		$constants = new Constants();
		$token = new Token();
		
		$request = new HTTP_Request2($constants->HOSTNAME . $constants->AUTH_PATH, HTTP_Request2::METHOD_POST);
		$request->setAuth($constants->KEY, $constants->SECRET, HTTP_Request2::AUTH_BASIC);
		$request->setBody('grant_type=client_credentials');
		$request->setHeader('Content-Type', 'application/x-www-form-urlencoded');
		
		
		try {
			$response = $request->send();
			if (200 == $response->getStatus()) {
				$token = json_decode($response->getBody());
			} else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase();
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
		
		return $token;
	}
	
	public function createDatasource($access_token) {
		$constants = new Constants();
		$datasource = new Datasource();
		
		$request = new HTTP_Request2($constants->HOSTNAME . $constants->DSK_PATH, HTTP_Request2::METHOD_POST);
		$request->setHeader('Authorization', 'Bearer ' . $access_token);
		$request->setHeader('Content-Type', 'application/json');
		$request->setBody(json_encode($datasource));
		
		try {
			$response = $request->send();
			if (201 == $response->getStatus()) {
				$datasource = json_decode($response->getBody());
				$dsk_id = $datasource->id;
				$dsk_externalId = $datasource->externalId;
				$dsk_descr = $datasource->description;
			} else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase();
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
		
		return $datasource;
	}
	
	public function readDatasource($access_token, $dsk_id) {
		$constants = new Constants();
		$datasource = new Datasource();
		
		$request = new HTTP_Request2($constants->HOSTNAME . $constants->DSK_PATH . '/' . $dsk_id, HTTP_Request2::METHOD_GET);
		$request->setHeader('Authorization', 'Bearer ' . $access_token);
	
		try {
			$response = $request->send();
			if (200 == $response->getStatus()) {
				$datasource = json_decode($response->getBody());
				$dsk_id = $datasource->id;
				$dsk_externalId = $datasource->externalId;
				$dsk_descr = $datasource->description;
			} else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase();
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	
		return $datasource;
	}
	
	public function updateDatasource($access_token, $dsk_id) {
		$constants = new Constants();
		$datasource = new Datasource();
		
		$datasource->id = $dsk_id;
		
		$request = new HTTP_Request2($constants->HOSTNAME . $constants->DSK_PATH . '/' . $dsk_id, 'PATCH');
		$request->setHeader('Authorization', 'Bearer ' . $access_token);
		$request->setHeader('Content-Type', 'application/json');
		$request->setBody(json_encode($datasource));
		
		try {
			$response = $request->send();
			if (200 == $response->getStatus()) {
				$datasource = json_decode($response->getBody());
				$dsk_id = $datasource->id;
				$dsk_externalId = $datasource->externalId;
				$dsk_descr = $datasource->description;
			} else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase();
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	
		return $datasource;
	}
	
	public function deleteDatasource($access_token, $dsk_id) {
		$constants = new Constants();
		$datasource = new Datasource();
		
		$request = new HTTP_Request2($constants->HOSTNAME . $constants->DSK_PATH . '/' . $dsk_id, HTTP_Request2::METHOD_DELETE);
		$request->setHeader('Authorization', 'Bearer ' . $access_token);
		$request->setHeader('Content-Type', 'application/json');
		$request->setBody(json_encode($datasource));
	
		try {
			$response = $request->send();
			if (204 == $response->getStatus()) {
				echo "Item Deleted";
			} else {
				echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
						$response->getReasonPhrase();
				return FALSE;
			}
		} catch (HTTP_Request2_Exception $e) {
			echo 'Error: ' . $e->getMessage();
			return FALSE;
		}
	
		return TRUE;
	}
}