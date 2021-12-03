<?php
namespace Feobit\Calendar;
//require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");


use  Bitrix\Main\Localization\Loc;


Loc::loadMessages(__FILE__);

class CalendarToSite extends feobitBase
{
    
    function logFile($textLog, $filename = "logFile.txt")
{	
	$file = $_SERVER["DOCUMENT_ROOT"]. "/local/modules/feobit.calendar/".$filename;
	$text = "=======================\n";
	$text .= print_r($textLog, 1); //Выводим переданную переменную
	$text .= "\n". date('Y-m-d H:i:s') ."\n"; //Добавим актуальную дату после текста или дампа массива
	file_put_contents($file, $text . "\n", FILE_APPEND); 
}
	
    function __construct()
    {
        parent::__construct();
    }

    public function Exchange()
    {
        $calendarId = $this->GetToken();
        self::LogFile($calendarId, 'calendarId.log'); //

        require_once ($_SERVER["DOCUMENT_ROOT"]. '/calendar/get_google_calendar.php');
        
    }
}
