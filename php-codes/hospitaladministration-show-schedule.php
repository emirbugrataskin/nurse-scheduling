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
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Hospital Administration Show Schedule page - Nurse Scheduling System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
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
                                <a href="hospitaladministration-show-schedule.php" class="nav-link active"><i class="fe fe-list"></i> Show Schedule</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="hospitaladministration-report.php" class="nav-link "><i class="fe fe-check-square"></i> Report</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">
            <div class="col-lg-12">
                <div class="card card-aside">
                    <div class="card-body d-flex flex-column">

                        <h6>Schedule</h6>
                        <!-- Table of min. hours  -->
                        <table class="tg">
                                <tr>
                                    <th class="tg-c3ow">Days/Nurse Name</th>
                                    <?php
                                        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                        if ($db->connect_errno > 0) {
                                             die('Unable to connect to database [' . $db->connect_error . ']');
                                        }

                                            $i=1;
                                            $result2 = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4'");
                                            $row_cnt = $result2->num_rows;
                                            $personal_id  = $row['personal_id'];
                                            $result4 = $db->query("SELECT DISTINCT name,surname FROM nurseschedulebyshift INNER JOIN personal ON nurseschedulebyshift.user_id=personal.user_id");
                                            $result4_rowcnt = $result4->num_rows;

                                            while($i<=$result4_rowcnt){
                                                
                                                $result = $db->query("SELECT DISTINCT name,surname FROM nurseschedulebyshift INNER JOIN personal ON nurseschedulebyshift.user_id=personal.user_id LIMIT $i");
                                                

                                                while($row = mysqli_fetch_object($result)){
                                                    $hems_isim = $row->name;
                                                    $hems_soyisim = $row->surname; 
                                                }
                                                echo '<th class="tg-baqh">'.$hems_isim.' '.$hems_soyisim.'</th>';
                                                
                                                $i++;
                                            }
                                            $result3 = $db->query("SELECT DISTINCT dayIndex FROM `nurseschedulebyshift`");  
                                            $row_count = $result3->num_rows;
                                            $index_day =1;
                                            $result3 = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4'");
                                            while($index_day<=$row_count){
                                            echo'<tr> <td class="tg-baqh">'.$index_day.'</td> ';
                                            $i1="1st Shift";
                                            $i2="2nd Shift";
                                            $i3=1;
                                            while($i3<=$result4_rowcnt){
                                                echo'<td class="tg-baqh">'.$i1.' & '.$i2.' ';
                                                $i3++;
                                            }
                                            echo'</td></tr> ';
                                                while($i<=$result4_rowcnt){
                                                echo'<td class="tg-baqh">1</td>';
                                                }
                                                $index_day++;
                                        }
                                ?>
                            </table>
                    </div>
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
                            <li class="list-inline-item"><a href="https://docs.google.com/document/d/1lIVltkIwNedM9aU89IxjCY0GATJaUQ-n4St19w-2LiQ/edit?ts=5df655cf" target="_blank">Documentation</a></li>
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