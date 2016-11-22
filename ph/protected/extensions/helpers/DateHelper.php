<?php 
class DateHelper  {
	const DATETIME_FORMAT = 'Y-m-d H:i:s'; // need ":s" detail for etags on perfonyCaldav
	/** 
     * Handles a date in the format YYYYMMDD. 
     * 
     * Doesn't take a genius to modify it to use some other format. 

     * We provide either of the following units: 
     *   'h' -> 'hour', 'i' -> 'minute', 's' -> 'second', 
     *   'm' -> 'month','d' -> 'day'   , 'y' -> 'year' 
     */ 
    public static function cleanDate($date){
        $dividers = array(' ', ':', '_', '-', '/', '|'); 
        return str_replace($dividers, '', $date); 
    }
    
    public static function cleanToDate($date){ 
        $date = self::cleanDate($date);
        list($y, $m, $d)  = array(substr($date, 0, 4), substr($date, 4, 2), substr($date, 6)); 
        list($h, $i, $s) = array(1, 0, 0); 
        return date('Y-m-d', mktime($h, $i, $s, $m, $d, $y)); 
    }
    public static function dateTime($date){ 
        $date = self::cleanDate($date);
        return array('year'=>substr($date, 0, 4), 
        			'month'=>substr($date, 4, 2), 
        			'day'=>substr($date, 6,2),
                    'hour'=>substr($date, 8,2),
                    'minute'=>substr($date, 10,2),
                    ); 
    }    
    public static function getNextDate($date, $amount, $unit='d',$format='Y-m-d'){ 
        $date = self::cleanDate($date);
        $unit = strtolower($unit); 
        list($y, $m, $d)  = array(substr($date, 0, 4), substr($date, 4, 2), substr($date, 6)); 
        list($h, $i, $s) = array(1, 0, 0); 
        $x = substr($unit, 0, 1); 
        $$x += $amount; 
        return date($format, mktime($h, $i, $s, $m, $d, $y)); 
    } 
    public static function getNextDateTime($date, $amount, $unit='d', $hours='1', $min='0',$format='Y-m-d'){ 
        $date = self::cleanDate($date);
        $unit = strtolower($unit); 
        list($y, $m, $d)  = array(substr($date, 0, 4), substr($date, 4, 2), substr($date, 6)); 
        list($h, $i, $s) = array($hours, $min, 0); 
        $x = substr($unit, 0, 1); 
        $$x += $amount; 
        return date($format, mktime($h, $i, $s, $m, $d, $y)); 
    } 
    public static function firstOfMonth($format="m/d/Y") {
        return date($format, strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
    }
    /**
     * Get datetime for last day of current week (time : 00:00:00)
     * @param unknown_type $format default m/d/Y
     * @param $bnbOfWeekToAdd if >0, will get last day of current week + X weeks
     */
    public static function lastOfWeek($format="m/d/Y",$bnbOfWeekToAdd=0) {
    	$day=date('N'); // 1=monday 7=sunday    	
    	if($day==7 && $bnbOfWeekToAdd == 0)
    		return date($format,strtotime(date('m').'/'.date('d').'/'.date('Y').' 00:00:00'));
    	else
        	return date($format, strtotime('-1 second',strtotime('+'.((7-$day)+(7*$bnbOfWeekToAdd)).' day',strtotime(date('m').'/'.date('d').'/'.date('Y').' 00:00:00'))));
    }
    /**
     * Use yii dateformatter
     * @param unknown_type $dateWidth long/medium/short or null
     * @param unknown_type $timeWidth long/medium/short or null
     * @param unknown_type $dayOfWeekWidth add day of week at the end (by default null). Can be "short" (3chars), "medium" or "long" (full day in letter)
     * @return formatted datetime as a string
     */
    public static function formatTimeToString($time,$dateWidth,$timeWidth,$dayOfWeekWidth=null){
    	$res = (isset($time)) ? Yii::app()->dateFormatter->formatDateTime($time,$dateWidth,$timeWidth):"";
    	if(isset($dayOfWeekWidth) && isset($time)){
    		$res .=' [';
    		if($dayOfWeekWidth=='short')
    			$res .=Yii::t(PTranslate::CAT_WORDING,strtolower(date('D',$time)));
    		else
    			$res .=Yii::t(PTranslate::CAT_WORDING,strtolower(date('l',$time)));
    		$res .=']';
    	}
    		
    	return $res;
    }
    /**
     * Get datetime for last day of current month (time : 00:00:00)
     * @param unknown_type $format default m/d/Y
     */
    public static function lastOfMonth($format="m/d/Y") {
        return date($format, strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
    }
    
    /**
     * Get datetime for first day of next month
     */
    public static function nextMonthStartDate($format,$currentYear,$currentMonth,$nbMonthToAdd=1){
        return date($format,strtotime($currentYear."-".$currentMonth."-01 +".$nbMonthToAdd." months"));
    }
    
    //Mysql Date Formatting
    // SELECT UNIX_TIMESTAMP('1973-11-29 21:33:09'); >> returns a timestamp integer format 
    // SELECT FROM_UNIXTIME(123456789); >> return a datetime human readable format 
    
    /**
     * Check if given date is empty (null,empty,mysql null : 1970...; 0 for timestamp and 0000-00-00 00:00:00 date)
     * @param unknown_type $date
     * @return bool TRUE is date is empty, else FALSE
     */
   public static function isEmptyDate($date){
       return ($date == null || $date =="" || $date === "0"
       		|| (strlen($date>5) && strpos($date,'-')!==false && ( intval(substr($date,0,4))<=1970 || substr($date,0,5)=="0000-")) // if it's not a timestamp and if year <=1970 or 0000-
       	);
   }
   /**
    * converts to timestamps and sums up the bits
    * @param  $date
    * @param string $time format H:i
    */
   public static function datetimeToTimestamp($date,$time)
   {
       $timeT = explode(":",$time);
       return (strtotime($date)+ ( (int)$timeT[0]*3600 ) + ( (int)$timeT[1]*60 ));
   }
   
   /**
    * Convert a datetime (like 2013-12-25 10:01:59) into an ISO 8601 UTC format like (20131225T100159Z).
    * Usefull for caldav stuff for example
    * @param string $datetime date in datetimeformat
    */
   public static function datetimeToIso8601_UTC($datetime)
   {
   		return self::timestampToIso8601_UTC(strtotime($datetime));
   }
	/**
    * Convert a timestamp (like 1354507200) into an ISO 8601 UTC format like (20131225T100159Z).
    * Usefull for caldav stuff for example
    * @param timestamp $timestamp timestamp representation of a datetime
    */
   public static function timestampToIso8601_UTC($timestamp)
   {
   		return self::applyTimeZone($timestamp,'UTC','iso8601');
   }
   /**
    * Converts a Date Time value into the user Timezone if it's different 
    * first convert to UTC then make timezone + daytime conversions  
    * @param timestamp $time : is the system timzone : must be a timestamp like strtotime or time
    * @param php::timezone $tz is a Php timezone string. If not filled will use userPref or system TZ (if not loggedin) : http://php.net/manual/fr/timezones.php
    */
   public static function applyTimeZone($time,$tz=null,$type=null){
       $systemTZ = date_default_timezone_get();
       //echo "<br/>xxxxxxx applyTimeZone input time : ".date("Y-m-d H:i:s", $time);
       if(!$tz)
           $tz = UserPref::getValue(UserPref::PREF_USER_TIME_ZONE);
       if(!DateHelper::isEmptyDate($time)){
           if(date_default_timezone_get() != $tz ){
               //pass the time to UTC timezone 
               //date_default_timezone_set("UTC");
               //$utcTime = date("Y-m-d H:i", $time);
               //$utcTime = strtotime($utcTime);
               //now tranform back to User timezone
               /*Yii::app()->localtime->TimeZone = $tz;
               $return = array('datetime' => Yii::app()->localtime->toLocalDateTime(date('Y-m-d H:i:s',$utcTime),'short','short'),
                               'date'     => Yii::app()->localtime->toLocalDate(date('Y-m-d H:i:s',$utcTime),'short','short'),
               				   'time'     => Yii::app()->localtime->toLocalTime(date('Y-m-d H:i:s',$utcTime),'short','short'));*/
               date_default_timezone_set($tz);
               
           }
          
           $return = array('datetime' => date(self::DATETIME_FORMAT, $time),
                           'date' => date("Y-m-d", $time),
                           'time' => date("H:i", $time),
           				   'timestamp' => $time, // current time() val. timestamp NEVER EVER depends on timezone 
           				   'iso8601'=>date('Ymd',$time).'T'.date('His',$time).(($tz=='UTC')?'Z':'') // used for caldav stuff with date like 20121026T021118Z 
                           );
            //echo "<br/>xxxxxxx applyTimeZone output time : ".$return['datetime'];
       }else
           $return = null;
       date_default_timezone_set($systemTZ);
       return ($type != null) ? $return[$type] : $return;
   }
   /**
    * Converts a user input who is on a different timezone than the system into the system's timzone time
    * @param unknown_type $time , any date format 
    * @param unknown_type $systTZ, date_default_timezone_get()
    * @param unknown_type $userTZ
    * @param unknown_type $type 
    */
    public static function applySystTimeZone($time,$systTZ=null,$userTZ=null,$type=null){
        if(!$systTZ)
           $systTZ = date_default_timezone_get();
        if(!$userTZ)
           $userTZ = UserPref::getValue(UserPref::PREF_USER_TIME_ZONE);
       if(date_default_timezone_get() != $userTZ )
       {
            //swap TZ referential
            //echo "<br/>applySystTimeZone input time : $time";
            date_default_timezone_set($userTZ);
            //time must be instanciated after the timezone set , otherwise will be under the sysem TZ
            $time = strtotime($time);
            //echo "<br/>applySystTimeZone <b>".date_default_timezone_get().'</b>:'.date("Y-d-mTG:i:sz",$time);
            
            //date_default_timezone_set("UTC");
            //echo "<br/>applySystTimeZone <b>".date_default_timezone_get().'</b>:'.date("Y-d-mTG:i:sz", $time);
            
            date_default_timezone_set($systTZ);
            //echo "<br/>applySystTimeZone <b>".date_default_timezone_get().'</b>:'.date("Y-d-mTG:i:sz",$time);
       }
       else 
       {
           $time = strtotime($time);
           
       }
       $return = array('datetime'=>date("Y-m-d H:i",$time),
                        'date'=> date("Y-m-d",$time),
       				    'time'=>date("H:i",$time));
       return ($type != null) ? $return[$type] : $return;
   }
/**
    * takes a timezone as param 
    * and return the H:i UTC Timezone offset
    */
   public static function getTimezoneOffset($tz){
        $this_tz = new DateTimeZone($tz);
        $now = new DateTime("now", $this_tz);
        $offset = $this_tz->getOffset($now);
        return ($offset % 3600 == 0) ? ($offset/3600).":00" : (($offset/3600)-(($offset%3600)/3600)).":".((abs( $offset)%3600)/60) ;
   }
	/**
    * takes a timezone as param 
    * and return the H:i UTC Timezone offset difference with the system TZ
    */
   public static function getTimezoneOffsetSystDiff($tz){
        $systTZ = new DateTimeZone(date_default_timezone_get());;
        $now = new DateTime("now", $systTZ);
        $sysoffset = $systTZ->getOffset($now);
        //echo "<br/>".date_default_timezone_get().":".$sysoffset;
       
        $this_tz = new DateTimeZone($tz); 
        $now = new DateTime("now", $this_tz);
        $offset = $this_tz->getOffset($now);
        //echo "<br/>".$tz.":".$offset;
        
        $diffOffset = abs( $sysoffset - $offset);
        
        $ret = ($diffOffset % 3600 == 0) ? ($diffOffset/3600).":00" : (($diffOffset/3600)-(($diffOffset%3600)/3600)).":".((abs( $diffOffset)%3600)/60) ;
        if($offset < $sysoffset )
            $ret = "-".$ret ;
        return $ret ;
   }
	/**
    * Get a user friendly timezone representation returned in string.
    * If userTZ is empty, will use current user timezone
    * @param string $userTZ (can be null)
    */
   public static function displayUserFriendlyTimeZone($userTZ=null)
   {   		
   		if($userTZ == null)
   			$userTZ = UserPref::getValue(UserPref::PREF_USER_TIME_ZONE);
   		
   		$res = $userTZ. ' UTC';
   		$this_tz = new DateTimeZone($userTZ);
        $offset = $this_tz->getOffset(new DateTime("now", $this_tz));
   		if($offset == 0)
   			$res .= '±';   		
   		else if($offset>0)
   			$res .= '+';
   		$res .= self::getTimezoneOffset($userTZ);	
   		return $res;
   }

   public static function fromNow($ts)
   {
    $now = new DateTime();
    $date = new DateTime();
    $date->setTimestamp($ts);
    $interval = $date->diff($now);

    return $interval->format("il y a : %aj %hh %imin");
     //return round(abs(time() - $ts) / 60)."min";
   }
}
