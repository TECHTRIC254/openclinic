<?php
/**
 * This file is part of OpenClinic
 *
 * Copyright (c) 2002-2004 jact
 * Licensed under the GNU GPL. For full terms see the file LICENSE.
 *
 * $Id: xhtml_start.php,v 1.1 2004/06/20 11:59:14 jact Exp $
 */

/**
 * xhtml_start.php
 ********************************************************************
 * Contains the common XHTML content of the web pages (xml prolog, DOCTYPE, title page and meta data)
 ********************************************************************
 * Author: jact <jachavar@terra.es>
 */

  if (str_replace("\\", "/", __FILE__) == $_SERVER['SCRIPT_FILENAME'])
  {
    header("Location: ../index.php");
    exit();
  }

  // To prevent 'short_open_tag = On' mistake
  echo '<?xml version="1.0" encoding="' . OPEN_ENCODING . '" standalone="no" ?>' . "\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo str_replace("_", "-", OPEN_LANGUAGE); ?>" dir="<?php echo OPEN_DIRECTION; ?>">
<head>
<title><?php echo $title; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo OPEN_CHARSET; ?>" />

<?php //echo <!--meta http-equiv="Content-Style-Type" content="text/css2" /--> ?>

<meta http-equiv="Cache-Control" content="no-store,no-cache,must-revalidate" />

<meta http-equiv="Pragma" content="no-cache" />

<meta http-equiv="Expires" content="-1" />

<meta http-equiv="imagetoolbar" content="no" />

<meta name="robots" content="noindex,nofollow" />

<meta name="MSSmartTagsPreventParsing" content="TRUE" />

<meta name="author" content="Jose Antonio Chavarr�a" />

<meta name="copyright" content="2002-2004 Jose Antonio Chavarr�a" />

<meta name="keywords" content="OpenClinic, open source, gpl, healthcare, php, mysql, coresis" />

<meta name="description" content="OpenClinic is an easy to use, open source, medical records system written in PHP" />