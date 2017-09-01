<?php

class SetupWizard
{
  public static function displayInstallWizard($pdo, $page)
  {
    $max_pages = 3;

    if ($page == -1)
    {
      header("location: installer.php?action=install&page=0");
    }

    ?>
    <nav class="nav-installer">
      <a class="<?php if ($page == 0) { echo 'btn-disabled'; } else { echo 'btn-secondary'; } ?>" <?php if ($page > 0) { echo 'href=installer.php?action=install&amp;page=' . (int)($page - 1); } ?>>Back</a>
      <a class="<?php if ($page < $max_pages) { echo 'btn-primary'; } else { echo 'btn-disabled'; } ?>" <?php if ($page < $max_pages) { echo 'href=installer.php?action=install&amp;page=' . (int)($page + 1); } ?>>Next</a>
    </nav>
    <h2 class="heading-m">Setup Wizard</h2>
    <?php
    switch ($page)
    {
      case 0:
      {
        ?>
        <p>Thank you for taking a look at Open Business Manager.  With this software you can manage inventory, services, and invoices.</p>
        <?php
        break;
      }

      case 1:
      {
        ?>
        <p>Operations to perform:</p>
        <ol>
          <li>Drop the database if it exists</li>
          <li>Create a new database</li>
          <li>Create the configuration table</li>
          <li>Create the users table</li>
          <li>Create the clients table</li>
          <li>Create the inventory table</li>
          <li>Create the services table</li>
          <li>Create the invoices table</li>
          <li>Create the invoiced inventory table</li>
          <li>Create the invoiced services table</li>
          <li>Create the archived invoices table</li>
          <li>Create the archived invoiced inventory table</li>
          <li>Create the archived invoiced services table</li>
        </ol>

        <p>Click 'Next' to perform the above operations.</p>
        <?php
        break;
      }

      case 2:
      {
        SetupWizard::installSoftware($pdo);
        ?>
        <p>Open Business Manager installed successfully!</p>
        <?php
        break;
      }

      case 3:
      {
        ?>
        <p>Open Business Manager has been installed!</p>
        <?php
        break;
      }

      default:
      {
        ?>
        <p>Page not defined!</p>
        <?php
        break;
      }
    }
  }

  public static function displayUninstallWizard($pdo, $page)
  {
    switch ($page)
    {
      case 0:
      {
        break;
      }

      case 1:
      {
        break;
      }

      default:
      {
        ?>
        <p>Page not defined!</p>
        <?php
        break;
      }
    }
  }

  public static function installSoftware($pdo)
  {
    // Drop database
    try
    {
      $pdo->exec("DROP DATABASE IF EXISTS openbusiness");
      ?>
      <p>Database 'openbusiness' dropped.</p>
      <?php
    }
    catch (PDOException $e)
    {
      echo "<p>Failed to drop database: " . $e->getMessage() . "</p>";
    }

    // Create database
    try
    {
      $pdo->exec("CREATE DATABASE IF NOT EXISTS openbusiness");
      ?>
      <p>Database 'openbusiness' created successfully.</p>
      <?php
    }
    catch (PDOException $e)
    {
      echo "<p>Failed to create database: " . $e->getMessage() . "</p>";
    }


  }

  public static function uninstallSoftware($pdo)
  {
    // Drop database
    try
    {
      $pdo->exec("DROP DATABASE ypm");
    }
    catch (PDOException $e)
    {
      echo $e->getMessage();
    }
  }
}

// Setup PDO connection
$host = "localhost";
$user = "jared"; // change to whatever you want
$pass = "12345"; // change to whatever you want
$charset = "utf8";

$dsn = "mysql:host=$host;charset=$charset";
$opt = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$action = isset($_GET["action"]) ? $_GET["action"] : "";
$page = isset($_GET["page"]) ? $_GET["page"] : -1;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta lang="en-us" />
    <title>Install Wizard</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>

  <body>
    <div class="wrapper">
      <div class="container-app-padding">
        <?php
        switch ($action)
        {
          case "install":
          {
            SetupWizard::displayInstallWizard($pdo, $page);
            break;
          }

          case "uninstall":
          {
            SetupWizard::displayUninstallWizard($pdo, $page);
            break;
          }
        }
        ?>
      </div>
    </div>
  </body>
</html>
