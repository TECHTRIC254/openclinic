<?php
/**
 * This file is part of OpenClinic
 *
 * Copyright (c) 2002-2004 jact
 * Licensed under the GNU GPL. For full terms see the file LICENSE.
 *
 * $Id: log_access_list.php,v 1.1 2004/03/24 18:52:40 jact Exp $
 */

/**
 * log_access_list.php
 ********************************************************************
 * List of user's accesses in a date
 ********************************************************************
 * Author: jact <jachavar@terra.es>
 * Last modified: 24/03/04 19:52
 */

  ////////////////////////////////////////////////////////////////////
  // Checking for get vars. Go back to log statistics if none found.
  ////////////////////////////////////////////////////////////////////
  if (count($_GET) == 0)
  {
    header("Location: ../admin/log_stats.php?table=access");
    exit();
  }

  ////////////////////////////////////////////////////////////////////
  // Controlling vars
  ////////////////////////////////////////////////////////////////////
  $tab = "admin";
  $nav = "logs";
  $restrictInDemo = true; // There are not logs in demo version

  require_once("../shared/read_settings.php");
  require_once("../shared/login_check.php");
  require_once("../classes/Access_Query.php");
  require_once("../lib/error_lib.php");

  ////////////////////////////////////////////////////////////////////
  // Retrieving get vars
  ////////////////////////////////////////////////////////////////////
  $year = intval($_GET["year"]);
  $month = intval($_GET["month"]);
  $day = intval($_GET["day"]);
  $hour = intval($_GET["hour"]);

  $accessQ = new Access_Query();
  $accessQ->connect();
  if ($accessQ->errorOccurred())
  {
    showQueryError($accessQ);
  }

  $total = $accessQ->select($year, $month, $day, $hour);
  if ($accessQ->errorOccurred())
  {
    $accessQ->close();
    showQueryError($accessQ);
  }

  ////////////////////////////////////////////////////////////////////
  // Show page
  ////////////////////////////////////////////////////////////////////
  $title = _("Access Logs");
  require_once("../shared/header.php");

  ////////////////////////////////////////////////////////////////////
  // Navigation links
  ////////////////////////////////////////////////////////////////////
  require_once("../shared/navigation_links.php");
  $links = array(
    _("Admin") => "../admin/index.php",
    _("Logs") => "../admin/log_stats.php?table=access",
    $title => ""
  );
  showNavLinks($links, "logs.png");
  unset($links);

  if ($total == 0)
  {
    echo '<p>' . _("No logs in this date.") . "</p>\n";
  }
  else
  {
?>

<h3><?php echo _("Access Logs List:"); ?></h3>

<table>
  <thead>
    <tr>
      <th>
        <?php echo _("Access Date"); ?>
      </th>

      <th>
        <?php echo _("Login"); ?>
      </th>

      <th>
        <?php echo _("Profile"); ?>
      </th>
    </tr>
  </thead>

  <tbody>
<?php
    $rowClass = "odd";
    while ($access = $accessQ->fetchAccess())
    {
?>
    <tr class="<?php echo $rowClass; ?>">
      <td>
        <?php echo $access["access_date"]; ?>
      </td>

      <td class="center">
        <?php echo $access["login"]; ?>
      </td>

      <td class="center">
        <?php echo $access["profile"]; ?>
      </td>
    </tr>
<?php
      // swap row color
      ($rowClass == "odd") ? $rowClass = "even" : $rowClass = "odd";
    } // end while
    unset($access);
?>
  </tbody>
</table>

<?php
  } // end if-else
  $accessQ->freeResult();
  $accessQ->close();
  unset($accessQ);

  echo '<p><a href="' . (isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '../index.php') . '">';
  echo _("Back return") . "</a></p>\n";

  require_once("../shared/footer.php");
?>