<?php 

class QueryValidator {
	private $result;

	public function __construct($query)
	{
		$this->result = $query;
	}

	private function sanitize()
	{
		$data = trim($this->result);
		$data = htmlspecialchars($data);
		if(preg_match('/\W+/', $data)) {
			return false;
		};
		return $data;
	}

	public function getResult() {
		return $this->sanitize();
	}
}