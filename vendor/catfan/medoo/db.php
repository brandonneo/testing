<?php

include(realpath(dirname(__FILE__)).'/src/Medoo.php');
use Medoo\Medoo;
/**
 * This is a static wrapper around the Medoo DB class.
 */

class DB
{
	public static function _db() 
	{
		static $db_instance;
		if (isset($db_instance)) 
			return $db_instance;
		//Connect to database
		$counter = 0;

		$dbcreds = fopen("/etc/passwd-db", "r");
		if ($dbcreds) {
		while (($line = fgets($dbcreds)) !== false) {
			// process the line read
			if($counter==0){
				$line=str_replace("\n","",$line);
				$DB_HOST_OR_IP = $line;
				
			}elseif($counter==1){
				$line=str_replace("\n","",$line);
				$DB_LOGIN_USERNAME = $line;
				
			}elseif($counter==2){
				$line=str_replace("\n","",$line);
				$DB_LOGIN_PASSWORD = $line;
				
			}elseif($counter==3){
				$line=str_replace("\n","",$line);
				$DB_DATABASE_NAME = $line;				
			}
			// }elseif($counter==4){
			// 		$line=str_replace("\n","",$line);
			// 		$DB_DATABASE_TYPE = $line;				
			// }
		$counter++;
		}

		fclose($dbcreds);
		}
		
		return $db_instance = new Medoo(array(
			'database_type' => 'mysql',
			'database_name' => $DB_DATABASE_NAME,
			'server' => $DB_HOST_OR_IP,
			'username' => $DB_LOGIN_USERNAME,
			'password' => $DB_LOGIN_PASSWORD,
		));
	 
	}

	public static function begin_transaction() 
	{ DB::_db()->pdo->beginTransaction(); }

	public static function rollback() 
	{ DB::_db()->pdo->rollback(); }

	public static function commit() 
	{ DB::_db()->pdo->commit(); }

	public static function query($query) 
	{ return DB::_db()->query($query); }

	public static function select($table, $join, $columns = null, $where = null) 
	{ return DB::_db()->select($table, $join, $columns, $where); }

	public static function insert($table, $datas) 
	{ return DB::_db()->insert($table, $datas); }

	public static function update($table, $data, $where = null) 
	{ return DB::_db()->update($table, $data, $where); }

	public static function delete($table, $where) 
	{ return DB::_db()->delete($table, $where); }

	public static function replace($table, $columns, $search = null, $replace = null, $where = null) 
	{ return DB::_db()->replace($table, $columns, $search, $replace, $where); }

	public static function get($table, $join = null, $column = null, $where = null) 
	{ return DB::_db()->get($table, $join, $column, $where); }

	public static function has($table, $join, $where = null) 
	{ return DB::_db()->has($table, $join, $where); }

	public static function count($table, $join = null, $column = null, $where = null) 
	{ return DB::_db()->count($table, $join, $column, $where); }

	public static function max($table, $join, $column = null, $where = null) 
	{ return DB::_db()->max($table, $join, $column, $where); }

	public static function min($table, $join, $column = null, $where = null) 
	{ return DB::_db()->min($table, $join, $column, $where); }

	public static function avg($table, $join, $column = null, $where = null) 
	{ return DB::_db()->avg($table, $join, $column, $where); }

	public static function sum($table, $join, $column = null, $where = null) 
	{ return DB::_db()->sum($table, $join, $column, $where); }

}