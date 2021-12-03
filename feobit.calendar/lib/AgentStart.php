<?php
namespace  Feobit\Calendar;

class AgentStart
{
    // 
    public static function CalendarToSiteAgent()
    {
        $Quickrun = new CalendarToSite();
        $Quickrun->Exchange();
        return __CLASS__."::CalendarToSiteAgent();";
    }
    
}