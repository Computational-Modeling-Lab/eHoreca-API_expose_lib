<?php
	
function httpRequest($url, $data, $method="post", $verbose=false) {
	if ($verbose) echo "\r\nURL: ".$url."\r\n";
	if ($verbose) echo "\r\nDATA: ".print_r($data, true)."\r\n";
	$curl = curl_init($url);
	if (strcmp($method, "post") === 0) {
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	} else if (strcmp($method, "get") === 0)
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		   'Content-Type: application/json, text/plain, */*',
		   'Authorization: Bearer '. $data["token"]
		   ));

	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	if ($verbose) curl_setopt($curl, CURLOPT_VERBOSE, true);
	$response = curl_exec($curl);
	curl_close($curl);
	return $response;
}
	
// Begin Class "eHoreca"
class eHoreca {
	// Variable declaration
	private $userId;
	private $apiURL;
	private $token = Null;
	
	// Class Constructor
	public function __construct($_apiURL) {
		$this->apiURL = $_apiURL;
		$this->token = Null;
	}
	
	// Class Destructor
	public function __destruct() {
	}
	
	// Class Connect
	public function connect($email, $password) {
		$reply = json_decode(httpRequest($this->apiURL."login", array("email" => $email, "password" => $password)), true);
		$this->token = $reply['token'];
		$this->userId = $reply['id'];
	}
	
	public function getToken() {
		return $this->token;
	}
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function printAllVars() {
		$class_vars = get_class_vars(get_class($this));

		foreach ($class_vars as $name => $value) {
			echo $name." : ".$this->$name."\n";
		}
	}
	
	//Include in the 
	public function getEndPoint($endPoint, $inputData=array()) {
		$inputData["token"] = $this->token;
		
		if ($this->token !== Null)
			return (json_decode(httpRequest($this->apiURL.$endPoint,  $inputData, "get", false), true));
		else
			return false;
	}

}
// End Class "eHoreca"

?>