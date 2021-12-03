<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);

$module_id = "feobit.calendar";
$CALENDAR_INTEGRATION = $APPLICATION->GetGroupRight($module_id);

//writeToLog($CALENDAR_INTEGRATION, 'CALENDAR_INTEGRATION');
/*
function writeToLog($data, $title = '')
{
    $log = "\n------------------------\n";
    $log .= date("Y.m.d G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    file_put_contents('/var/www/v0438450/data/www/feokazanok.ru/local/modules/feobit.calendar/log_options_calendar.log', $log, FILE_APPEND);
    return true;
}
*/

if ($CALENDAR_INTEGRATION < "R")
    return;

Loader::includeModule($module_id);

$arAllOptions = array(
    array("CALENDAR_INTEGRATION_IP", Loc::getMessage('CALENDAR_INTEGRATION_IP'), "", array("text", 60)),

);


$strWarning = "";
if ($REQUEST_METHOD == "POST" && strlen($Update) > 0 && $CALENDAR_INTEGRATION == "W" && check_bitrix_sessid() && strlen($use_sonnet_button) <= 0) {
    

    foreach ($arAllOptions as $option) {
        $name = $option[0];
        $val = $$name;
       
     
        COption::SetOptionString($module_id, $name, $val, $option[1]);
    }
}

$aTabs = array(
    array("DIV" => "edit1", "TAB" =>  Loc::getMessage('CALENDAR_EDIT1_TAB_NAME'), "ICON" => "blog_settings", "TITLE" => Loc::getMessage('CALENDAR_EDIT1_TAB_NAME')),
    array("DIV" => "edit2", "TAB" => Loc::getMessage('CALENDAR_EDIT2_TAB_NAME'), "ICON" => "blog_settings", "TITLE" => Loc::getMessage('CALENDAR_EDIT2_TAB_NAME')),
    array("DIV" => "edit3", "TAB" => Loc::getMessage('CALENDAR_EDIT3_TAB_NAME'), "ICON" => "blog_path", "TITLE" => Loc::getMessage('CALENDAR_EDIT3_TAB_NAME')),
);
/*
$logFiles = array(
        array('title' => Loc::getMessage('CALENDAR_LOG_RESULT'), 'class' => Fbit\Quickrunintegration\PortalToQuickrun::GetClassName()),
        
);
*/
$tabControl = new CAdminTabControl("tabControl", $aTabs);
?><form method="POST" action="<? echo $APPLICATION->GetCurPage() ?>?mid=<?= htmlspecialcharsbx($mid) ?>&lang=<?= LANGUAGE_ID ?>"><?
                                                                                                                            bitrix_sessid_post();
                                                                                                                            $tabControl->Begin(); ?>

    <? $tabControl->BeginNextTab(); ?>

    <? foreach ($arAllOptions as $Option) {
        $val = COption::GetOptionString($module_id, $Option[0], $Option[2]);
   
        $type = $Option[3];
        //$type[0] = ($Option[0] == "CALENDAR_INTEGRATION_IP") ? 'token' : $type[0];
    ?>
        <tr>
            <td valign="top" width="50%"><?
                                            if ($type[0] == "checkbox")
                                                echo "<label for=\"" . htmlspecialcharsbx($Option[0]) . "\">" . $Option[1] . "</label>";
                                            else
                                                echo $Option[1];
                                            ?></td>
            <td valign="middle" width="50%">
                <? if ($type[0] == "text") : ?>
                    <? // writeToLog($type[0], 'type');?>
                    <input type="text" size="<? echo $type[1] ?>" value="<?echo htmlspecialcharsbx($val)?>" name="<? echo htmlspecialcharsbx($Option[0]) ?>">
                    <? // writeToLog($val, 'val_input');?>
                <? endif ?>
            </td>
        </tr>
    <?
    } ?>
    <? $tabControl->BeginNextTab(); ?>
    <div>
        <div>
            <h3><?= Loc::getMessage('CALENDAR_LOG_BLOCK_TITLE') ?></h3>
        </div>
        <?
        /*foreach ($logFiles as $file){?>
        <div>
            <p><?=$file['title']?></p>
            <?Fbit\Quickrunintegration\quickrunLog::GetLog($file['class'])?>
        </div>
    <?} */ ?>
    </div>


    <? $tabControl->BeginNextTab(); ?>
    <? require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/admin/group_rights.php"); ?>
    <? $tabControl->Buttons(); ?>

    <script language="JavaScript">
        function RestoreDefaults() {
            if (confirm('<? echo AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING")) ?>'))
                window.location = "<? echo $APPLICATION->GetCurPage() ?>?RestoreDefaults=Y&lang=<? echo LANG ?>&mid=<? echo urlencode($mid) . "&" . bitrix_sessid_get(); ?>";
        }
    </script>

    <input type="submit" <? if ($CALENDAR_INTEGRATION < "W") echo "disabled" ?> name="Update" value="<? echo Loc::getMessage("MAIN_SAVE") ?>">
    <input type="hidden" name="Update" value="Y">
    <input type="reset" name="reset" value="<? echo Loc::getMessage("MAIN_RESET") ?>">

    <? $tabControl->End();
    ?>
</form>