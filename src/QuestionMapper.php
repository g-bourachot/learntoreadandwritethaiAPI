<?php
class QuestionMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getQuestions($levelId, $limit, $answerMapper){
 		$sql = "SELECT * FROM questions WHERE level = ".$levelId." ORDER BY RAND() LIMIT ".$limit;
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$questions = $stmt->fetchAll(PDO::FETCH_OBJ);
            $mapper = new AnswerMapper($this->db);

            foreach($questions as $i => $value){
                $value->answers = $answerMapper->getAnswersNotEncoded($value->identifier);
            } 

        	return json_encode($questions, JSON_NUMERIC_CHECK|JSON_UNESCAPED_UNICODE);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

}