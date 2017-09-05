<!--
OpenBusinessManager is open source software designed to help your business manage your clients, inventory, services, budget, and invoices in a simple, user friendly way.
Copyright (C) 2017  Jared York

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta lang="en-us" />
    <title>Business Manager | Dashboard</title>
    <!-- CSS Reset link -->
    <link rel="stylesheet" type="text/css" href="css/reset.css" />

    <!-- App CSS links -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>

  <body>
    <nav class="navigation">
      <li class="nav-item"><a href="index.php?action=home">Home</a></li>
      <li class="nav-item"><a href="index.php?action=budget">Manage Budget</a></li>
    </nav>

    <input type="checkbox" id="nav-trigger" class="nav-trigger">
    <label for="nav-trigger"></label>

    <div class="wrapper">
      <div class="app-padding">
        <header class="header-main">
          <h3 class="heading-s">Open Business Manager</h3>
        </header>

        <div class="container-app-padding">
          <?php
          $action = isset($_GET["action"]) ? $_GET["action"] : "";

          switch ($action)
          {
            case "home":
            {
              ?>
              <h3 class="heading-s">Dashboard</h3>
              <?php
              break;
            }

            case "budget":
            {
              ?>
              <h3 class="heading-s">Manage Budget</h3>
              <h2 class="heading-m">Budget Manager</h2>
              <form action="php/budget.php?action=update-budget">
                <fieldset>
                  <legend>Update budget</legend>
                  <p class="input-form"><label for="checking-amount">Amount in checking:</label><input class="txtfield" name="checking_amount" type="text" /></p>
                  <p class="input-form"><label for="checking-buffer">Checking buffer:</label><input class="txtfield" name="checking_buffer" type="text" /></p>
                  <p class="input-form"><label for="savings-amount">Amount in savings:</label><input class="txtfield" name="savings_amount" type="text" /></p>
                  <p class="input-form"><label for="savings-buffer">Savings buffer:</label><input class="txtfield" name="savings_buffer" type="text" /></p>
                </fieldset>
              </form>
              <form action="php/budget.php?action=add-budget-category">
                <fieldset>
                  <legend>Add category</legend>
                  <p class="input-form"><label for="name">Category name:</label><input class="txtfield" name="name" type="text" /></p>
                  <p class="input-form"><label for="percent-of-budget">Percent of budget:</label><input class="txtfield" name="percentofbudget" type="text" /></p>
                  <button type="submit">Add</button>
                </fieldset>
              </form>
              <?php
              break;
            }

            default:
            {
              header("location: index.php?action=home");
              break;
            }
          }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>
