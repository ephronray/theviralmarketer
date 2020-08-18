<?php
  require_once (__DIR__.'/../_libs/dbConnect.php');
  class uplineMember {
	private $db;  
    private $id;
	private $ibm;
	private $level;
	private $referredBy;
	public function __construct($id, $ibm, $level)  
    {  
		$this->db = new dbConnect();
		$this->referredBy = $this->db->getReferredBy($ibm);
        $this->id = $id;
        $this->ibm = $ibm;
        $this->level = $level;
    }
	
	public function memberLimit()
	{
		$level = ($this->level <= 4 ) ? $this->level : $this->level-4; 
		return pow(4,$level);
	}
	
	public function isRootRef($ibm)
	{
		$query = 'SELECT * FROM members WHERE ibm = "'.$ibm.'"';
		$result = $this->db->dbCon->query($query);
		$data 	= $result->fetch_assoc();
		return $data['is_root'];
	}
	
	public function getUpMember()
	{
		if (empty($this->referredBy) || empty($this->level))
		{
			return array(
			'success' => false,
			'message' => 'There is something wrong with your "viral marketer" account.Contact Administration!!'
			);
				
		} else
		{
			if (filter_var($this->isRootRef($this->referredBy), FILTER_VALIDATE_BOOLEAN) && $this->level <=4) 
			{
				$receiverIbm = $this->referredBy;		
			} 
			else  // all levels  here when reff is not a admin
			{
				if ($this->level == 1)  // direct reff
				{
					$receiverIbm = $this->getMyUpline($this->referredBy);
					
				} else 
				{
					$receiverIbm = $this->myUplineReceiver($this->ibm, false);
				}
			}
			
			if ($this->checkRefEligibility($receiverIbm))  // already received payment from 4 people --checking spill over
			{
			$receiverIbm = $this->getMatrixPosition(array($receiverIbm), filter_var($this->isRootRef($receiverIbm), FILTER_VALIDATE_BOOLEAN));
			} 
			return array (
			'success' 	 => true,
			'uplineIbm'  => $receiverIbm,
			'memberInfo' => $this->db->getMemberInfo($receiverIbm),
			'limit'		 => $this->memberLimit(),
			'level' 	=>	$this->level,
			'availbilty' => $receiverIbm,
			'target' => $this->getTargetUplineIbm($this->ibm, $this->uplineLevel())
			);
		}
	}
	
	public function getTargetUplineIbm($senderIbm, $targetLevel)
	{
		$query = 'SELECT receiver_ibm FROM subscribed_levels WHERE sender_ibm = "'.$senderIbm.'" AND level = "'.$targetLevel.'"';
		$result = $this->db->dbCon->query($query);
		if($result->num_rows == 1)
		{
			$data = $result->fetch_assoc();
			if(!empty($data)) 
			{				
				return [ 'success' => true, 'ibm' => $data['receiver_ibm']];
			} 
			else
				return [ 'success' => false, 'message' => 'No, Target Upline Account found  '];
		}
		return false;
	}
	
	/*
	*Name: checkRefEligibility
	*Info: check if referral has received Donation from how many people for particular level 
	*Response: Boolean: true means eligible to get paid else goto Up line of this referral
	*/
	public function checkRefEligibility($ibm)
	{
		$query = 'SELECT sender_ibm FROM subscribed_levels WHERE receiver_ibm = "'.$ibm.'" AND level = "'.$this->level.'"';
		$result = $this->db->dbCon->query($query);
		if($result->num_rows >= $this->memberLimit())
		{
			return true; //not eligible already received payment from 4 people
		}
			return false;		
	}
	
	public function uplineList ($ibm, $level)
	{
		if (filter_var($this->isRootRef($ibm), FILTER_VALIDATE_BOOLEAN)) 
		{
			return [ 'success' => true, 'ibm' => $ibm, 'upline' => false];
		} 
		
		$query = 'SELECT receiver_ibm FROM subscribed_levels WHERE sender_ibm = "'.$ibm.'" AND level = "'.$level.'"';
		$result = $this->db->dbCon->query($query);
		if($result->num_rows != 0) 
		{	$data = $result->fetch_assoc();			
			return [ 'success' => true, 'ibm' => $data['receiver_ibm'],  'upline' => true, 'info'=>$this->db->getMemberInfo($data['receiver_ibm'])];
		} 
		else
			return [ 'success' => false, 'message' => 'No, Target Upline Account found  '];
	}
	
	public function uplineLevel ()
	{
		$level = $this->level-1;
		return $level;
	}
	
	public function genList($ibm)
	{
		/*
		 * Level uplines  2, 3, 4
		 */
		$list = [];
		for ($i = 0; $i <= 4; $i++) 
		{
			$data  = $this->uplineList($ibm, 1);
			if($data['success'])
			{
				$ibm =  $data['ibm'];
				$list[] = $data;
				if(!$data['upline'] || filter_var($this->isRootRef($ibm), FILTER_VALIDATE_BOOLEAN))
				{
					break; // upline reached at root so stop it 
				}
			}
		}
		return $list;
		
	}
	
	public function checkLevelStatus ($ibm, $level)
	{
		$query = 'SELECT receiver_ibm FROM subscribed_levels WHERE sender_ibm = "'.$ibm.'" AND level = "'.$level.'"';
		$result = $this->db->dbCon->query($query);
		return $result->num_rows;
	}
	
	public function myUplineReceiver($ibm, $recursive)
	{

		if (filter_var($this->isRootRef($ibm), FILTER_VALIDATE_BOOLEAN)) 
		{
			return $ibm;
		} 
		else 
		{
			/*
			 *  all Level uplines
			 */
		 	$uplineLevel = $this->uplineLevel();
			$list = $this->genList($ibm);
			array_unshift($list,"");
			unset($list[0]); # removing 0 index 
			$_SESSION['list'][] = $list;
			$ibmList = [];
			$lastIbmInList = end($list)['ibm'];
			$uplineIndex = count($list);
			if (count($list) >= $this->level && ( $this->level <= 4  && !$recursive))
			{
				$uplineIndex = $this->level;
				
			} else if ($this->level > 4 && !$recursive)
			{
				$getAssociatedLevel = (int) $this->level - 4;
				if (count($list) >= $getAssociatedLevel)
					$uplineIndex = $getAssociatedLevel;
				else 
					$uplineIndex = count($list);
			} else if ($recursive) 
			{
				$uplineIndex = 1;
			}
			/* return [
			'index'=>	$uplineIndex,
			'last'=>	$lastIbmInList,
			'list'=> $list,
			'uplineLevel'=>	$uplineLevel,
			'count' => count($list),
			]; */
			for ($i = $uplineIndex; $i <= count($list); $i++) 
			{

				if(!empty($list[$i]))
				{
					$ibm =  $list[$i]['ibm'];
					$ibmList[$i]['ibm'] = $ibm;
					$levelStatus = $this->checkLevelStatus($ibm, $this->level); //check my upline is eligible for my paying level
					 $ibmList[$i]['level_status'] = $levelStatus;
					if ($levelStatus != 0 || filter_var($this->isRootRef($ibm), FILTER_VALIDATE_BOOLEAN))
					{ 
						return $list[$i]['ibm'];
					} else if ($lastIbmInList == $ibm) 
					{
						// start with last ibm from current list and search for next 4 more 
						return $this->myUplineReceiver($ibm, true);
						
					}
				}				
			}
		}
	}
	
	function getMyUpline($referralIbm)
	{
		if (filter_var($this->isRootRef($referralIbm), FILTER_VALIDATE_BOOLEAN)) 
		{
			return $referralIbm;
		}
		
		$query = 'SELECT sender_ibm FROM subscribed_levels WHERE sender_ibm = "'.$referralIbm.'" AND level = "'.$this->level.'"';
		$result = $this->db->dbCon->query($query);
		if($result->num_rows == 0)
		{
			// referral info  move to next upline  this ibm is not paid yet
		 	$uplineMember = $this->db->getMemberInfo($referralIbm);
			return $this->getMyUpline($uplineMember['refer_ibm']);
			
		} else if ($result->num_rows < 4 ) 
		{
			return $referralIbm;
			
		} else if ($result->num_rows == 4 )
		{ 	
		   return $this->getMatrixPosition(array($referralIbm), false);
		}
	}
	
	public function getMatrixPosition($ibms, $isRoot)
	{
		$ibm_list = array();
		foreach ( $ibms AS $ibm ) 
		{
			$query = 'SELECT sender_ibm FROM subscribed_levels WHERE receiver_ibm = "'.$ibm.'" AND level = "'.$this->level.'" order by paid_date ';
			$result = $this->db->dbCon->query($query);
			if($result->num_rows >= $this->memberLimit())
			{
				while ($ref = $result->fetch_assoc())
				{
					if($this->checkRefEligibility($ref['sender_ibm'])) 
						$ibm_list[] = $ref['sender_ibm'];	
					else
						return $ref['sender_ibm'];				
				}
			} 
			else { return $ibm; }		
		}
		return $this->getMatrixPosition($ibm_list, false); // call recursively 
	}
	
	public function insertTrnxInfo ($data)
	{
		$query = "INSERT INTO `subscribed_levels` 
					(
					`sender_ibm`, 
					`receiver_ibm`, 
					`level_amount`,
					`level`,
					`sender_address`,
					`receiver_address`,
					`payment_status`
					) VALUES (
					'".$data['sender_ibm']."',
					'".$data['receiver_ibm']."',
					'".$data['level_amount']."',
					'".$data['level']."', 
					'".$data['sender_address']."', 
					'".$data['receiver_address']."', 
					'".$data['payment_status']."'
					)";
        if($this->db->dbCon->query($query) && $this->db->dbCon->affected_rows == 1)
		{
           return true;
        }
		   return false;
	}
	 public function insertTransectionHistory($data , $tx_id, $level_description , $status , $miner_fee , $tvm_fee)
	{
	    $date = date('d-m-Y');
	    $tvm_discription = 'TVM Fee By '.$data['sender_ibm'];
	    $query = "INSERT INTO `transaction_history` 
					(
					`description`,
					`transaction_id`,
					`sender_Ibm`, 
					`receiver_ibm`, 
					`amount`,
					`sender_wallet_address`,
					`receiver_wallet_address`,
					`status`,
					`miner_fee`,
					`tvm_fee`,
					`admin_trans`
					) VALUES (
					'".$level_description."',
					'".$tx_id."',
					'".$data['sender_ibm']."',
					'".$data['receiver_ibm']."',
					'".$data['level_amount']."',
					'".$data['sender_address']."', 
					'".$data['receiver_address']."',
					'".$status."',
					'".$miner_fee."',
					'".$tvm_fee."',
					'0'
					)";
					
        if($this->db->dbCon->query($query) && $this->db->dbCon->affected_rows == 1)
		{
		    $tvmQuery = "INSERT INTO `transaction_history` 
					(
					`description`,
					`transaction_id`,
					`sender_Ibm`, 
					`receiver_ibm`, 
					`amount`,
					`sender_wallet_address`,
					`receiver_wallet_address`,
					`status`,
					`miner_fee`,
					`tvm_fee`,
					`admin_trans`
					) VALUES (
					'".$tvm_discription."',
					'".$tx_id."',
					'".$data['sender_ibm']."',
					'".$data['receiver_ibm']."',
					'".$data['level_amount']."',
					'".$data['sender_address']."', 
					'".$data['receiver_address']."',
					'".$status."',
					'".$miner_fee."',
					'".$tvm_fee."',
					'1'
					)";
					if($this->db->dbCon->query($tvmQuery) && $this->db->dbCon->affected_rows == 1)
		{
		 
		  return $response = array("success"=>true,
           "error" => mysqli_error($this->db->dbCon),
           );
		}
          
        }
		   return false;
	}

 } 