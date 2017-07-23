<?php
class QuestionMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getQuestions($levelId, $limit){
 		$sql = "SELECT * FROM questions WHERE level = ".$levelId." LIMIT ".$limit;
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$questions = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return json_encode($questions, JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

}