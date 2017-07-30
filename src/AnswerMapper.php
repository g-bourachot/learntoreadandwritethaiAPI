<?php
class AnswerMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getAnswers($questionId){
 		$sql = "SELECT * FROM answers WHERE questionId = ".$questionId;
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$answers = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return json_encode($answers, JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

    public function getAnswersNotEncoded($questionId){
        $sql = "SELECT * FROM answers WHERE questionId = ".$questionId;
        try {
            $stmt = $this->databaseConnection->query($sql);
            $answers = $stmt->fetchAll(PDO::FETCH_OBJ);

            return $answers;
        } catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

}