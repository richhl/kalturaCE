<?php
require_once('myBatchBase.class.php');
//define('MODULES' , SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR."modules".DIRECTORY_SEPARATOR);

class myNewBatchPartnerUsage extends myBatchBase
{
	const SLEEP_TIME = 1;
	
	public function myNewBatchPartnerUsage()
	{
		self::initDb();
	}
	
	private function last_day_for_month( $dateParts )
	{
		$intDate = strtotime($dateParts[0].'-'.$dateParts[1].'-01');
		
		return date('t', $intDate);
	}
	
	public function doDailyStorageAggregation( $date )
	{
		// set the dates
		$currentDate = $date;
		$dateParts = explode('-', $date);
		$dateParts[2] = $dateParts[2] - 1;
		if ($dateParts[2] == 0)
		{
			$dateParts[1] = $dateParts[1] - 1;
			if ( $dateParts[1] == 0)
			{
				$dateParts[1] = 12;
				$dateParts[0] = $dateParts[0] - 1;
			}
			$dateParts[2] = $this->last_day_for_month($dateParts);
		}
		if ($dateParts[1] < 10 && strlen($dateParts[1]) == 1)
		{
			$dateParts[1] = '0'.$dateParts[1];
		}
		if ($dateParts[2] < 10 && strlen($dateParts[2]) == 1)
		{
			$dateParts[2] = '0'.$dateParts[2];
		}
		
		$previousDate = implode('-', $dateParts);
		TRACE("calculating storage agg. for date $currentDate");

		
		// set start points
		$partners_exists = true;
		$start_pos = 0;
		$bulk_size = 500;
		
		// loop partners
		while($partners_exists)
		{
			// pull bulk of partners
			$c = new Criteria();
			$c->addAnd(PartnerPeer::CREATED_AT, $previousDate, Criteria::LESS_EQUAL);
			$c->setOffset($start_pos);
			$c->setLimit($bulk_size);
			$partners = PartnerPeer::doSelect($c);
			if (!$partners)
			{
				TRACE( "No more partners. offset: $start_pos , limit: $bulk_size ." );
				// set flag to exit while loop
				$partners_exists = false;
			} 
			else
			{
				TRACE( "Looping ". ($start_pos + $bulk_size -1) ." partners, offset: $start_pos ." );
				// loop bulk of partners
				foreach($partners as $partner)
				{
					/*
					if ($partner->getId() != 593 && $partner->getId() != 395 && $partner->getId() != 387 )
					{
						continue;
					}
					TRACE("testing... not skiping partner ".$partner->getId());
					*/

					// get 2 rows
					$partnerActivityCriteria = new Criteria();
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, array( $previousDate , $currentDate ), Criteria::IN );
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_STORAGE );
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , PartnerActivity::PARTNER_SUB_ACTIVITY_STORAGE_SIZE );
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::PARTNER_ID , $partner->getId() );
					$partnerActivityCriteria->setLimit ( 2 );
					$activities = PartnerActivityPeer::doSelect( $partnerActivityCriteria );
					if (count($activities) == 0)
					{
						TRACE( "could not load any entries for partner ".$partner->getId() );
						// assuming new partner, never uploaded entries, no use of adding rows ?
						// TODO: verify point with Eran
					}
					if (count($activities) == 1)
					{
						TRACE( "loaded one row with date ".$activities[0]->getActivityDate() );
						if ( $activities[0]->getActivityDate() == $currentDate )
						{
							//TRACE("not here...");
							// user uploaded first entry today - Hooray ! starting aggregation
							$activities[0]->setAmount1( $activities[0]->getAmount() );
							$activities[0]->save();
						}
						elseif ( $activities[0]->getActivityDate() == $previousDate )
						{
							//TRACE("date of yesterday... entering new... ");
							// result of yesterday, add today's row with zero amount value (did not upload entry today)
							$partnerActivity = new PartnerActivity;
							$partnerActivity->setActivity ( PartnerActivity::PARTNER_ACTIVITY_STORAGE );
							$partnerActivity->setSubActivity ( PartnerActivity::PARTNER_SUB_ACTIVITY_STORAGE_SIZE );
							$partnerActivity->setPartnerId ( $partner->getId() );
							$partnerActivity->setActivityDate ( $currentDate );
							// findEntrySizes script did not find entries for that partner today, assuming 0 storage delta
							$partnerActivity->setAmount ( 0 );
							// set aggregated value to yesterdays aggregated value
							$partnerActivity->setAmount1 ( $activities[0]->getAmount1() );
							$partnerActivity->save();
						}
						else
						{
							//TRACE('-'.$previousDate .'- is not like -'.$activities[0]->getActivityDate().'-');
						}
					}
					elseif (count($activities) == 2)
					{
						if ( $activities[0]->getActivityDate() > $activities[1]->getActivityDate() )
						{
							$activities[0]->setAmount1( $activities[1]->getAmount1() + $activities[0]->getAmount() );
							$activities[0]->save();
						}
						else
						{
							$activities[1]->setAmount1( $activities[0]->getAmount1() + $activities[1]->getAmount() );
							$activities[1]->save();
						}
					}
					unset($activities);
					unset($partnerActivityCriteria);
				}
			}
			unset($partners);
			$start_pos += $bulk_size;
		}
	}
	
	public function doMonthlyAggregation( $date )
	{
		// set the dates
		$dateParts = explode('-', $date);
		$currentDate = $dateParts;
		$currentDate[2] = $currentDate[2] - 3;
		if ($currentDate[2] <= 0)
		{
			$currentDate[1] = $currentDate[1] - 1;
			if ( $currentDate[1] == 0)
			{
				$currentDate[1] = 12;
				$currentDate[0] = $currentDate[0] - 1;
			}
			// if $currentDate[2] before reduction = 3, $currentDate[2] after reduction = 0
			// if $currentDate[2] = 0 and last_day_for_month return 30, $currentDate[2] = 30
			// if $currentDate[2] before reduction = 2, $currentDate[2] after reduction = -1
			// if $currentDate[2] = -1 and last_day_for_month return 30, $currentDate[2] = 30 + (-1) = 29
			$currentDate[2] = $this->last_day_for_month($currentDate) + $currentDate[2];
		}
		if ($currentDate[1] < 10 && strlen($currentDate[1]) == 1)
		{
			$currentDate[1] = '0'.$currentDate[1];
		}
		if ($currentDate[2] < 10 && strlen($currentDate[2]) == 1)
		{
			$currentDate[2] = '0'.$currentDate[2];
		}
		
		$firstOfMonth = $currentDate[0].'-'.$currentDate[1].'-01';		
		$currentDate = implode('-', $currentDate);
		TRACE("calculating monthly agg. for date $currentDate");
		
		// set start points
		$partners_exists = true;
		$start_pos = 0;
		$bulk_size = 500;
		
		// loop partners
		while($partners_exists)
		{
			// pull bulk of partners
			$c = new Criteria();
			$c->addAnd(PartnerPeer::CREATED_AT, $currentDate, Criteria::LESS_EQUAL);
			$c->setOffset($start_pos);
			$c->setLimit($bulk_size);
			$partners = PartnerPeer::doSelect($c);
			if (!$partners)
			{
				TRACE( "No more partners. offset: $start_pos , limit: $bulk_size ." );
				// set flag to exit while loop
				$partners_exists = false;
			} 
			else
			{		
				TRACE( "Looping ". ($start_pos + $bulk_size -1) ." partners, offset: $start_pos ." );
				// loop bulk of partners
				foreach($partners as $partner)
				{
					/*
					if ($partner->getId() != 593 && $partner->getId() != 395 && $partner->getId() != 387 )
						continue;

					TRACE("testing... not skiping partner ".$partner->getId());
					*/
					
					// get row from partner_activity where date is 1st of current month and type is 6
					$partnerActivityCriteria = new Criteria();
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $firstOfMonth );
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_MONTHLY_AGGREGATION );
					$partnerActivityCriteria->addAnd ( PartnerActivityPeer::PARTNER_ID , $partner->getId() );
					$activityTotal = PartnerActivityPeer::doSelect( $partnerActivityCriteria );
					if (count($activityTotal) > 1)
					{
						TRACE( "loaded more than one monthly aggregation row for partner. something went wrong. partner ".$partner->getID() );
					}
					elseif (count($activityTotal) == 0 || !$activityTotal)
					{
						// no rows for this month, either today is 1st of month or new partner. adding row for partner
						$partnerActivity = new PartnerActivity;
						$partnerActivity->setActivity ( PartnerActivity::PARTNER_ACTIVITY_MONTHLY_AGGREGATION );
						$partnerActivity->setPartnerId ( $partner->getId() );
						$partnerActivity->setActivityDate ( $firstOfMonth );

						$storageTotal = $this->getStorageAggregationFor( $partner->getId() , $currentDate );
						$storageAddition = $storageTotal / date('t', strtotime($currentDate));
						$partnerActivity->setAmount1 ( $storageAddition );

						$partnerActivity->setAmount2 ( $this->getTrafficFor( $partner->getId() , $currentDate ) );

						$total_amount = (($partnerActivity->getAmount1()*1024) + $partnerActivity->getAmount2());
						$partnerActivity->setAmount ( $total_amount );
						$partnerActivity->save();						
					}
					else
					{
						$currentStorage = $activityTotal[0]->getAmount1();
						$storageTotal = $this->getStorageAggregationFor( $partner->getId() , $currentDate );
						$storageAddition = $storageTotal / date('t', strtotime($currentDate));
						$activityTotal[0]->setAmount1( $currentStorage + $storageAddition );
						
						$currentTraffic = $activityTotal[0]->getAmount2();
						$trafficAddition = $this->getTrafficFor( $partner->getId() , $currentDate );
						$activityTotal[0]->setAmount2( $currentTraffic + $trafficAddition );
						
						// storage is saved in MB, traffic is saved in KB, normalizing storage for correct sum result
						$total_amount = (($activityTotal[0]->getAmount1()*1024) + $activityTotal[0]->getAmount2());
						$activityTotal[0]->setAmount( $total_amount );
						$activityTotal[0]->save();
						
					}
					unset($partnerActivityCriteria);
					unset($activityTotal);
				}
			}
			unset($partners);
			$start_pos += $bulk_size;
		}
	}
	
	private function getStorageAggregationFor( $partnerId, $date )
	{
		$partnerActivityCriteria = new Criteria();
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $date );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_STORAGE );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , PartnerActivity::PARTNER_SUB_ACTIVITY_STORAGE_SIZE );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::PARTNER_ID , $partnerId );
		$activity = PartnerActivityPeer::doSelect( $partnerActivityCriteria );
		//TRACE("$partnerId and $date resulted in ".count($activity). " rows");
		
		if (count($activity))
		{
			return $activity[0]->getAmount1();
		}
		return 0;
	}
	
	private function getTrafficFor( $partnerId, $date )
	{
		$partnerActivityCriteria = new Criteria();
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY_DATE, $date );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::ACTIVITY , PartnerActivity::PARTNER_ACTIVITY_TRAFFIC );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::SUB_ACTIVITY , 
			array( 	PartnerActivity::PARTNER_SUB_ACTIVITY_WWW,
				PartnerActivity::PARTNER_SUB_ACTIVITY_LIMELIGHT ),
			Criteria::IN );
		$partnerActivityCriteria->addAnd ( PartnerActivityPeer::PARTNER_ID , $partnerId );
		$activity = PartnerActivityPeer::doSelect( $partnerActivityCriteria );

		//TRACE("traffic ! $partnerId and $date resulted in ".count($activity). " rows");
		$_traffic = 0;
		if (count($activity) == 2)
		{
			$_traffic = $activity[0]->getAmount();
			//TRACE("DB value (act[0]) = ".$activity[0]->getAmount().' my value = '.$_traffic);
			$_traffic += $activity[1]->getAmount();
			//TRACE("DB value (act[1]) = ".$activity[1]->getAmount().' my value = '.$_traffic);
		}
		elseif (count($activity) == 1)
		{
			$_traffic = $activity[0]->getAmount();
			//TRACE("DB value (act[0] only) = ".$activity[0]->getAmount().' my value = '.$_traffic);
		}
		
		return $_traffic;
	}	

}

?>