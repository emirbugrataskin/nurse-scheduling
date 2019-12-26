<?php
include('session.php');
if ($db->connect_errno > 0) {
  die('Unable to connect to database [' . $db->connect_error . ']');
}
$result = $db->query("select * from personal where username='$_SESSION[login_user]'");
while ($row = $result->fetch_assoc()) {
  $name         = $row['name'];
  $surname      = $row['surname'];
  $username     = $row['username'];
  $user_id      = $row['user_id'];
  $personal_id  = $row['personal_id'];
  $email        = $row['email'];
}
$result->free();
if ($personal_id == 1){
    $usertype = "Hospital Manager";
}
?>

<!doctype html>
<html lang="en" dir="ltr">
<head>
    <style type="text/css">
        .tg th {border: 1px solid rgba(0, 40, 100, 0.12)!important}
        .tg td {border: 1px solid rgba(0, 40, 100, 0.12)!important}
        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
        .tg td{font-family:Arial, sans-serif;font-size:18px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg th{font-family:Arial, sans-serif;font-size:16px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg .tg-baqh{text-align:center;vertical-align:top}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="../favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
    <title>Hospital Administration Report page - Nurse Scheduling System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../assets/js/column-chart.js"></script>
    <script>
        requirejs.config({
            baseUrl: '.'
        });
    </script>
    <!-- Dashboard Core -->
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <script src="../assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="../assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="../assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="../assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="../assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="../assets/plugins/input-mask/plugin.js"></script>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="./hospitaladministration-index.php">
                        <img src="../images/logo.jpeg" class="header-brand-img" alt="tabler logo">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">


                        <div class="dropdown">
                            <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">

                    <span class="ml-2 d-none d-lg-block">
                    <a href="logout.php"><span class="text-default"><?php echo $name . " " . $surname ?></span> </a>
                      <small class="text-muted d-block mt-1"><?php echo $usertype  ?></small>
                    </span>
                            </a>
                        </div>
                    </div>
                    <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                        <span class="header-toggler-icon"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg order-lg-first">
                        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                                <a href="./hospitaladministration-index.php" class="nav-link "><i class="fe fe-home"></i> Home</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="hospitaladministration-nurse-list.php" class="nav-link"><i class="fe fe-users"></i> Nurse List</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="hospitaladministration-show-schedule.php" class="nav-link"><i class="fe fe-list"></i> Show Schedule</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="hospitaladministration-report.php" class="nav-link active"><i class="fe fe-check-square"></i> Report</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">
                <!-- info about schedule-->
                <div class="col-lg-12" style="float: left;">
                    <div class="card card-aside">
                        <div class="card-body d-flex flex-column">
                        <?php echo'
                                <h1>Value of Parameters</h1>

                                <p>Number of days in the planning period: 5</p>
                                <p>Number of nurses: 4</p>
                                <p>Number of shifts: 2 </p>
                                <p>Minimum number of night shift for nurses: 1</p>
                                <p>Maximum number of night shift for nurses: 3</p>
                                <p>Rate of assignable maximum number of night shift constraint: 1</p>
                                <p>Rate of assignable minimum number of night shift constraint: 1</p>
                                <p>Rate of maximum free consecutive day constraint: 1</p>
                                <p>Rate of maximum consecutive working day constraint: 1</p>
                                <p>Rate of working next day after worked previous day’s night shift: 1</p>
                                <p>Rate of assigning no more than one shift in a day: 1</p>
                                <p>Rate of assigning senior nurse to each shift for everyday: 1</p>
                                <p>Rate of can’t working on consecutive night shifts: 1</p>'

                        ?>
                        </div>
                    </div>
                </div>
                <!-- show some compare-->
                <div class="col-lg-6" style="float:left;">

                    <div class="card card-aside">

                        <div class="card-body d-flex flex-column">
                            <h6 >Rate of maximum free consecutive day constrain</h6>
                            <table class="tg">
                                <tr>
                                    <th class="tg-c3ow">Nurse Name</th>
                                    <th class="tg-baqh">Day Number</th>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">Tuğkan</td>
                                    <td class="tg-baqh">0</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">Emir</td>
                                    <td class="tg-baqh">1</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">İlayda</td>
                                    <td class="tg-baqh">2</td>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">İdris</td>
                                    <td class="tg-baqh">3</td>
                                </tr>
                            </table>
                            <h6 style="margin-top: 20px;">Number of night shift for nurses</h6>
                            <table class="tg">
                                <tr>
                                    <th class="tg-c3ow">Nurse Name</th>
                                    <th class="tg-baqh">Day Number</th>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">Tuğkan</td>
                                    <td class="tg-baqh">0</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">Emir</td>
                                    <td class="tg-baqh">1</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">İlayda</td>
                                    <td class="tg-baqh">2</td>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">İdris</td>
                                    <td class="tg-baqh">3</td>
                                </tr>
                            </table>

                        </div>

                    </div>

                </div>
                <!-- show some compare-->
                <div class="col-lg-6" style="float:left;">

                    <div class="card card-aside">

                        <div class="card-body d-flex flex-column">

                            <h6>Annual Leave Numbers</h6>
                            <table class="tg">
                                <tr>
                                    <th class="tg-c3ow">Nurse Name</th>
                                    <th class="tg-baqh">Day Number</th>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">Tuğkan</td>
                                    <td class="tg-baqh">0</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">Emir</td>
                                    <td class="tg-baqh">1</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">İlayda</td>
                                    <td class="tg-baqh">2</td>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">İdris</td>
                                    <td class="tg-baqh">3</td>
                                </tr>
                            </table>

                            <h6 style="margin-top: 20px;">States maximum consecutive working day is exceeded or not for each nurse and day</h6>
                            <table class="tg">
                                <tr>
                                    <th class="tg-c3ow">Nurse Name</th>
                                    <th class="tg-baqh">Day Number</th>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">Tuğkan</td>
                                    <td class="tg-baqh">0</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">Emir</td>
                                    <td class="tg-baqh">1</td>

                                </tr>
                                <tr>
                                    <td class="tg-baqh">İlayda</td>
                                    <td class="tg-baqh">2</td>
                                </tr>
                                <tr>
                                    <td class="tg-baqh">İdris</td>
                                    <td class="tg-baqh">3</td>
                                </tr>
                            </table>

                        </div>

                    </div>

                </div>
                <!-- stacked chart-->
                <div class="col-lg-12">
                    <div class="card card-aside">
                        <div class="card-body d-flex flex-column">
                            <div id="columnchart_stacked" style="width: 900px; height: 420px;"></div>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item"><a href="./documentation.html" target="_blank">Documentation</a></li>
                                <li class="list-inline-item"><a href="./faq.html">FAQ</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                    Copyright © 2019 <a href="https://capstone.eng.bau.edu.tr/db-active-4999.php?showDepartment=any&showCode=333" target="_blank">Capstone BAU</a>. All rights reserved.
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>