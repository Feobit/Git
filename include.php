<?php
use \Bitrix\Main\Loader;

if(Loader::includeModule('iblock')){
    Loader::registerAutoLoadClasses("feobit.calendar", array(
                "Feobit\Calendar\quickrunLog" => "/lib/quickrunLog.php",
                "Feobit\Calendar\CalendarToSite" => "/lib/CalendarToSite.php",
                "Feobit\Calendar\AgentStart" => "/lib/AgentStart.php",
        )
    );
}

?>