<?php
class PerformanceManager {

	private $_db;

    //Constructor
    //-----------

    public function __construct($db) {
        $this->setDb($db);
    }

    //Setter
    //------

    public function setDb(PDO $db) {
        $this->_db = $db;
    }


	public function getCpuUsage(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
							inner join performance_type on fk_type = pk_type
							WHERE `fk_type` = 2 and `fk_host` = 1
							order by date desc
							limit 1');
		$q->execute();


		$data = $q->fetch(PDO::FETCH_ASSOC);

	    if ($data) {
	        return $data;
	    } else {
	    	return array();
	    }
	}

	public function getCPUTemp(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
							inner join performance_type on fk_type = pk_type
							WHERE `fk_type` = 4 and `fk_host` = 1
							order by date desc
							limit 1');
		$q->execute();


		$data = $q->fetch(PDO::FETCH_ASSOC);

	    if ($data) {
	        return $data;
	    } else {
	    	return array();
	    }
	}

	public function getAllCPUTemp(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
									WHERE `fk_type` = 4 and `fk_host` = 1
									order by date limit 192');
		$q->execute();

		$chartValue ="";
		$i = 0;
		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			if($i==0){
				$chartValue="[\"".$data[date]."\", ".$data[value]."]";
			}else{
            	$chartValue = $chartValue.", [\"".$data[date]."\", ".$data[value]."]";	
			}
            $i++;
        }
	    
	    return $chartValue;
	}

	public function getRAMUsage(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
							inner join performance_type on fk_type = pk_type
							WHERE `fk_type` = 1 and `fk_host` = 1
							order by date desc
							limit 1');
		$q->execute();


		$data = $q->fetch(PDO::FETCH_ASSOC);

	    if ($data) {
	        return $data;
	    } else {
	    	return array();
	    }
	}

	public function getDiskUsage(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
							inner join performance_type on fk_type = pk_type
							WHERE `fk_type` = 3 and `fk_host` = 1
							order by date desc
							limit 1');
		$q->execute();


		$data = $q->fetch(PDO::FETCH_ASSOC);

	    if ($data) {
	        return $data;
	    } else {
	    	return array();
	    }
	}

	public function getHDDTemp(){
		$q = $this->_db->prepare('SELECT * FROM `performance` 
							inner join performance_type on fk_type = pk_type
							WHERE `fk_type` = 5 and `fk_host` = 1
							order by date desc
							limit 1');
		$q->execute();


		$data = $q->fetch(PDO::FETCH_ASSOC);

	    if ($data) {
	        return $data;
	    } else {
	    	return array();
	    }
	}

}