<?php
/*-------------------------------------------------------------------------------
# JD MarqueeAholic - Marquee module for Joomla 3.x v1.5.0
# -------------------------------------------------------------------------------
# author    JoomDev (Formerly GraphicAholic)
# copyright Copyright (C) 2020 Joomdev, Inc. All rights reserved.
# @license - GNU General Public License version 2 or later
# Websites: https://www.joomdev.com
--------------------------------------------------------------------------------*/
// No direct access
defined('_JEXEC') or die('Restricted access');
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
$moduleclass_sfx = $params->get('moduleclass_sfx');
JHtml::_('bootstrap.framework');
// Import the file / foldersystem
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
$LiveSite 	= JURI::base();
$document = JFactory::getDocument();
$modbase = JURI::base(true).'/modules/mod_marqueeaholic/';
$loadjQuery = $params->get('loadjQuery');	
$loadScripts = $params->get('loadScripts');		
if($loadScripts == 1) {
$document->addScript ($modbase.'js/jquery.marquee.min.js');
$document->addScript ($modbase.'js/jquery.pause.js');
$document->addScript ($modbase.'js/jquery.easing.min.js');
}
$document->addStyleSheet($modbase.'css/marquee.css');
$marqueeDuplication	= $params->get('marqueeDuplication');
if($marqueeDuplication == "0") $marqueeDuplication = "false";
if($marqueeDuplication == "1") $marqueeDuplication = "true";
$marqueePause	= $params->get('marqueePause');
if($marqueePause == "0") $marqueePause = "false";
if($marqueePause == "1") $marqueePause = "true";
$marqueeURL	= $params->get('marqueeURL');
$outsideSource	= $params->get('outsideSource');
$externalURL	= $params->get('externalURL');
$wordCount	= $params->get('wordCount');
$feedCount	= $params->get('feedCount');
$linkWindow	= $params->get('linkWindow');
$rssDisplay	= $params->get('rssDisplay');
$marqueeDirection	= $params->get('marqueeDirection');
$feedSpacing	= $params->get('feedSpacing');
if($feedSpacing == "oneSpacing") $feedSpacing = "<br /><br />";
if($feedSpacing == "twoSpacing") $feedSpacing = "<br /><br /><br />";
if($feedSpacing == "threeSpacing") $feedSpacing = "<br /><br /><br /><br />";
if($feedSpacing == "fourSpacing") $feedSpacing = "<br /><br /><br /><br /><br /><br />";
if ($marqueeDirection == 'up' || $marqueeDirection == 'down') { $oneSpacing	= "<br />"; }
if ($marqueeDirection == 'left' || $marqueeDirection == 'right') { $feedSpacing	= ""; }
$supportingTags	= $params->get('supportingTags');
$hyperlinkMarquee	= $params->get('hyperlinkMarquee');
$titleSize	= $params->get('titleSize');
$moduleID = $module->id;

if($outsideSource == 3) {
JLoader::register('ModMarqueeAholicHelper', __DIR__ . '/helpers/cathelper.php');

$list            = ModMarqueeAholicHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'), ENT_COMPAT, 'UTF-8');

require JModuleHelper::getLayoutPath('mod_marqueeaholic', $params->get('layout', 'default'));
} else {
require JModuleHelper::getLayoutPath('mod_marqueeaholic','default',$params);
}
?>