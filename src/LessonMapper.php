<?php
class LessonMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getLessons(){
 		$sql = "SELECT * FROM lessons";
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$lessons = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return json_encode($lessons, JSON_NUMERIC_CHECK);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

    public function getLessonById($identifier){
        $sql = "select * FROM lessons where lessons.identifier = ".$identifier;
        try {
            $stmt = $this->databaseConnection->query($sql);
            $lesson = $stmt->fetch(PDO::FETCH_OBJ);

            return json_encode($lesson, JSON_NUMERIC_CHECK);
        } catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

}