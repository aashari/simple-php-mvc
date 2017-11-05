<?php 

class Model {

	protected $mongodb;
	protected $mongodbConnection;
	protected $collection;
	
	public function __construct(){
		$config = config();
		$this->mongodbConnection = new MongoDB\Client('mongodb://'.$config->database->host,[
				'username' => $config->database->user,
				'password' => $config->database->pass,
				'database' => $config->database->name
			]);
		$this->mongodb = $this->mongodbConnection->{$config->database->name};
	}
	
	public function insert($data)
	{
		try{
			return $this->mongodb->{$this->collection}->insertOne($data);
		}catch(\Exception $e){
			return null;
		}
	}
	
	public function update($condition, $data)
	{
		try{
			return $this->mongodb->{$this->collection}->updateMany($condition,[
				'$set' => $data
			]);
		}catch(\Exception $e){
			return null;
		}
	}
	
	public function get($condition){
		try{
			return $this->mongodb->{$this->collection}->findOne($condition);
		}catch(\Exception $e){
			return null;
		}
	}
	
	public function getList($condition){
		try{
			return $this->mongodb->{$this->collection}->find($condition);
		}catch(\Exception $e){
			return null;
		}
	}
    
}