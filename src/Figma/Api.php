<?php

namespace App\Figma;

class Api {

	const urlMain = 'https://api.figma.com/v1/';

	const methods = array(
		'getFile' => 'files'
	);

	private $apiKey;
	
	public function __construct(string $apiKey){
		$this->apiKey = $apiKey;
	}

	private function genUrl(string $method, string $key, string $title = ''): string {
		$url = self::urlMain . "{$method}/{$key}";
		if ($title)
			$url .= "/{$title}";
		return $url;
	}

	private function queue(string $url, array $data, bool $get = true){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			"X-FIGMA-TOKEN: {$this->apiKey}"
		));
		$output = curl_exec($ch);

		return $output;
	}

	public function getFileAsArray(string $key): array {
		$url = $this->genUrl(self::methods['getFile'], $key);
		$data = array();
		$res = $this->queue($url, $data);
		//file_put_contents('../../tests/file.json', $res);
		try {
			$res = json_decode($res, true);
		} catch(Exception $e){
			return array();
		}
		return $res;
	}
}