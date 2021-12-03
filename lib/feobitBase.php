<?php
namespace Feobit\Calendar;


class feobitBase
{
    private $ModuleId     = 'feobit.calendar';
    private $feobitToken    = '';

    function __construct()
    {
        $this->feobitToken    = \Bitrix\Main\Config\Option::get($this->ModuleId, 'CALENDAR_INTEGRATION_IP', '');
    }

    function GetToken()
    {
        return $this->feobitToken;
    }

    
}