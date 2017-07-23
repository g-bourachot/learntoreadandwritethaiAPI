<?php
class LevelMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getLevels(){
 		$sql = "SELECT * FROM levels";
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$levels = $stmt->fetchAll(PDO::FETCH_OBJ);

        	return json_encode($levels, JSON_NUMERIC_CHECK);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

    public function getLevelById($identifier){
        $sql = "select * FROM levels where levels.identifier = ".$identifier;
        try {
            $stmt = $this->databaseConnection->query($sql);
            $level = $stmt->fetch(PDO::FETCH_OBJ);

            return json_encode($level, JSON_NUMERIC_CHECK);
        } catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

}