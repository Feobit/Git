<?php
use Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);

if(class_exists("feobit_calendar")) return;

class feobit_calendar extends CModule{
    var $MODULE_ID = "feobit.calendar";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_GROUP_RIGHTS = "Y";

    var $errors;

    function __construct()
    {

        //$arModuleVersion = array();
        //$path = str_repeat("\\", "/", __FILE__);
        //$path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include_once(__DIR__."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)){
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }else {
            $this->MODULE_VERSION = "1.0.0";
            $this->MODULE_VERSION_DATE ="2021-10-02 00:00:00";
        }

        $this->MODULE_NAME = Loc::getMessage('FEOBIT_INTEGRATION_MODULE_NAME');
        $this->MODULE_DESCRIPTION =Loc::getMessage('FEOBIT_INTEGRATION_MODULE_DESC');
        $this->MODULE_PATH = $this->getModulePath();
    }

    protected function getModulePath()
    {
        $modulePath = explode('/', __FILE__);
        $modulePath = array_slice($modulePath, 0, array_search($this->MODULE_ID, $modulePath) + 1);

        return join('/', $modulePath);
    }

    
    function CreateLogFolder()
    {
        $dir = $_SERVER['DOCUMENT_ROOT']."/feobit_calendar_log";
        if(!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        return true;
    }

    function DoInstall()
    {
        $this->CreateLogFolder();
        \Bitrix\Main\ModuleManager::RegisterModule($this->MODULE_ID);
        //$this->RegisterAgent();
        return true;
    }

    function DoUninstall()
    {
        //$this->RemoveAgent();
        \Bitrix\Main\ModuleManager::unRegisterModule($this->MODULE_ID);
        return true;
    }
}
?>