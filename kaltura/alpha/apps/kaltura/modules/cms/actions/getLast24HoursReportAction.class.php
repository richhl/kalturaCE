<?php

require_once ( "kalturaCmsAction.class.php" );

class getLast24HoursReportAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		
		$this->users = $this->getGraphData($partner_id, 'kuser');
		$this->shows = $this->getGraphData($partner_id, 'kshow');
		$this->entries = $this->getGraphData($partner_id, 'entry');
		
		sfView::SUCCESS;
	}
	
	private function getGraphData($partner_id, $table) {
		/*$c = new Criteria();
		// group by should be by hour (year, moth, day must be inculded to for a proper order)
		//$c->addSelectColumn("DATE_FORMAT(".$timeColumn.", '%y-%m-%d %h:00:00') as dailyhours");
		$c->addAsColumn("dailyhours", "DATE_FORMAT(".$timeColumn.", '%y-%m-%d %h:00:00')");
		$c->addSelectColumn("count(".$countColumn.")");
		//$c->addAnd(entryPeer::CREATED_AT, date('Y-m-d H:i:s', time() - 24*60*60), Criteria::GREATER_THAN);
		//$c->addAnd(entryPeer::PARTNER_ID, $partner_id);
		//$c->addAnd("dailyhours", null, Criteria::ISNOTNULL);
		$c->addGroupByColumn("dailyhours");
		$c->addAscendingOrderByColumn("dailyhours");
		
		$rs = BasePeer::doSelect($c);
		*/
		
		$conn = Propel::getConnection();
		$sql = 
			"SELECT 
				STR_TO_DATE(DATE_FORMAT(".$table.".CREATED_AT, '%y-%m-%d %H:00:00'), '%y-%m-%d %H:00:00') AS dailyhours, 
				COUNT(".$table.".ID) as activity
			FROM 
				".$table." 
			 WHERE 
				".$table.".created_at IS NOT NULL AND 
				".$table.".partner_id = ".$partner_id." AND 
				".$table.".created_at > SUBDATE(SYSDATE(), INTERVAL 1 DAY)
			GROUP BY 
				dailyhours 
			ORDER BY 
				dailyhours ASC;";
		
		$rs = $conn->executeQuery($sql);

		$data = Array();
		
		// the starting hour from last day (snaped to hours)
		$starting_hour = strtotime('-1 day') - strtotime('-1 day') % (60 * 60);
		$now =  strtotime('now') - strtotime('now') % (60 * 60);
		
		/*
		$starting_hour = strtotime('2007-07-16');
		$now =  $starting_hour + 24*60*60;
		*/
		
		$rs->next();
		while ($starting_hour < $now)
		{
			/*
			print (date('c', $starting_hour));
			print ('   ');
			if ($rs->getRow())
				print (date('c', $rs->getTimestamp("dailyhours", null)));
			else 
				print 'null';
			print ('   ');
			*/
			
			$obj['hour'] = date('H:00', $starting_hour);
			if ($rs->getRow() && $starting_hour == $rs->getTimestamp("dailyhours", null))
			{
				$obj['activity'] = $rs->getInt("activity");
				$rs->next();
			}
			else
			{
				$obj['activity'] = 0;
			}
			
			$data[] = $obj;
			$starting_hour += 60 * 60;
		}
		
		/*
		while ($rs->next()) {
			print($rs->getTimestamp("dailyhours", null));
			continue;
				
			$dailyHour = $rs->getSring(2);
			
			// get the hour from our grouped by string
			$hour = substr($dailyHour, 9, 2); 
			
			$obj['hour'] = $hour;
			$obj['activity'] = $rs->getInt(2);
			
			while ($currentHour < $obj['hour'] && $currentHour < 23) {
				$objTemp['hour'] = $currentHour;
				$objTemp['activity'] = 0;
				$entries[] = $objTemp;				
				$currentHour++;
			}
			
			$entries[] = $obj;
			$currentHour++;
		}
		
		/*
		if (count($entries) == 0)
		{
			while ($currentHour < 23) {
				$objTemp['hour'] = $currentHour + 1;
				$objTemp['activity'] = 0;
				$entries[] = $objTemp;				
				$currentHour++;
			}
		}
		*/
		
		return $data;
	}
}
?>