<?php

require_once ( "kalturaCmsAction.class.php" );

class getLast31DaysReportAction extends kalturaCmsAction
{
	public function executeImpl($partner_id) {
		
		$this->users = $this->getGraphData($partner_id, 'kuser');
		$this->shows = $this->getGraphData($partner_id, 'kshow');
		$this->entries = $this->getGraphData($partner_id, 'entry');
		
		sfView::SUCCESS;
	}
	
	private function getGraphData($partner_id, $table) {
		
		$conn = Propel::getConnection();
		$sql = 
			"SELECT 
				STR_TO_DATE(DATE_FORMAT(".$table.".CREATED_AT, '%y-%m-%d 00:00:00'), '%y-%m-%d 00:00:00') AS days, 
				COUNT(".$table.".ID) as activity
			FROM 
				".$table." 
			 WHERE 
				".$table.".created_at IS NOT NULL AND 
				".$table.".partner_id = ".$partner_id." AND 
				".$table.".created_at > SUBDATE(SYSDATE(), INTERVAL 1 MONTH)
			GROUP BY 
				days 
			ORDER BY 
				days ASC;";
		
		$rs = $conn->executeQuery($sql);

		$data = Array();
		
		$starting_day = strtotime('-31 day'); // the starting days is 31 days ago
		$starting_day = mktime(0, 0, 0, date('m', $starting_day), date('d', $starting_day), date('Y', $starting_day)); // we group by days

		$now =  strtotime('now');
		$now = mktime(0, 0, 0, date('m', $now), date('d', $now), date('Y', $now)); // we group by days

		$rs->next();
		while ($starting_day < $now)
		{
			/*
			print (date('c', $starting_day));
			print ('   ');
			if ($rs->getRow())
				print (date('c', $rs->getTimestamp("days", null)));
			else 
				print 'null';
			print ('   ');
			*/
			
			$obj['day'] = date('m-d', $starting_day);
			if ($rs->getRow() && $starting_day == $rs->getTimestamp("days", null))
			{
				$obj['activity'] = $rs->getInt("activity");
				$rs->next();
			}
			else
			{
				$obj['activity'] = 0;
			}
			
			$data[] = $obj;
			
			$starting_day += 60 * 60 * 24; // move to next day
		}
		
		return $data;
	}
}
?>