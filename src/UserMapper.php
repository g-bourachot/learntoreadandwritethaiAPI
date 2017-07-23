<?php
class UserMapper {

	private $databaseConnection;

	public function __construct($databaseConnection) {
		$this->databaseConnection = $databaseConnection;
	}

 	public function getUsers(){
 		$sql = "select * FROM users";
    	try {
        	$stmt = $this->databaseConnection->query($sql);
        	$users = $stmt->fetchAll(PDO::FETCH_OBJ);
 
        	return json_encode($users, JSON_NUMERIC_CHECK);
    	} catch(PDOException $e) {
        	return '{"error":{"text":'. $e->getMessage() .'}}';
    	}
 	}

    public function getUserById($identifier){
        $sql = "select users.identifier,users.name,GROUP_CONCAT(user_level.level_identifier SEPARATOR ',') as finishedLevelIds FROM users LEFT JOIN user_level ON users.identifier = user_level.user_identifier where users.identifier = ".$identifier;
        try {
            $stmt = $this->databaseConnection->query($sql);
            $user = $stmt->fetch(PDO::FETCH_OBJ);
            $user->finishedLevelIds = explode(',',$user->finishedLevelIds);

            foreach($user->finishedLevelIds as $i => $value){
                $value = (int)$value;
            } 
 
            return json_encode($user, JSON_NUMERIC_CHECK);
        } catch(PDOException $e) {
            return '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }

}