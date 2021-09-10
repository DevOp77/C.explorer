<?php

class Statistics
{
	public function getEventComments($eventid,$memberid)
	{
			$sqlQuery = "Select m.id as memberid,m.lastname,m.firstname,m.photo, ec.id as commentid,e.id as eventid, e.title, ec.comment, ec.datecreated from event_comments ec inner join events e on e.id=ec.eventid  left join members m on ec.memberid=m.id where e.memberid='".$memberid."' and e.id='".$eventid."' order by ec.id desc";
			$QueryExecutor = new ExecuteQuery();
            $result = $QueryExecutor::customQuery($sqlQuery);	          
            
			return $result;
	}


	public function getEventAttending($eventid,$memberid)
	{
			$sqlQuery = "Select m.id as memberid,m.lastname,m.firstname,m.photo,a.id as attendid,e.id as eventid,e.title,a.datecreated from event_attending a inner join events e on a.eventid=e.id left join members m on m.id=a.memberid where e.memberid='".$memberid."' and e.id='".$eventid."' order by a.id desc";
			$QueryExecutor = new ExecuteQuery();
            $result = $QueryExecutor::customQuery($sqlQuery);	           
            		
			return $result;
	}

	public function getEventFollowing($eventid,$memberid)
	{
		$sqlQuery = "Select m.id as memberid,m.lastname,m.firstname,m.photo,f.id as followingid,e.id as eventid,e.title,f.datecreated from event_following f inner join events e on f.eventid=e.id left join members m on m.id=f.memberid where e.memberid='".$memberid."' and e.id='".$eventid."' order by f.id desc";
			$QueryExecutor = new ExecuteQuery();
            $result = $QueryExecutor::customQuery($sqlQuery);	           
            		
			return $result;
	}

}






?>