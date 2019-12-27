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
if ($personal_id == 4){
    $usertype = "Head Nurse";
}
?>
<!doctype html>
<html lang="en" dir="ltr">
<head>
    <style type="text/css">
        .tg th {border: 1px solid rgba(0, 40, 100, 0.12)!important}
        .tg td {border: 1px solid rgba(0, 40, 100, 0.12)!important}
        .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
        .tg td{font-family:Arial, sans-serif;font-size:10px;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg th{font-family:Arial, sans-serif;font-size:8px;font-weight:normal;padding:5px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:black;}
        .tg .tg-baqh{text-align:center;vertical-align:top}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
        .disabledbutton {pointer-events: none;opacity: 0.4;}
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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="icon" href="../favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.ico" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Make Schedule Page - Nurse Scheduling System</title>
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="../assets/js/require.min.js"></script>
    <!-- Dashboard Core -->
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <script src="../assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="../assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="../assets/plugins/charts-c3/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="../assets/plugins/input-mask/plugin.js"></script>
    <script src="../assets/js/make-schedule.js"></script>
</head>
<body class="">
<div class="page">
    <div class="page-main">
        <!--header-->
        <div class="header py-4">
            <div class="container">
                <div class="d-flex">
                    <a class="header-brand" href="./headnurse-make-schedule.php">
                        <img src="../images/logo.jpeg" class="header-brand-img" alt="tabler logo">
                    </a>
                    <div class="d-flex order-lg-2 ml-auto">
                        <div class="dropdown d-none d-md-flex">


                        </div>
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
                    <a href="headnurse-index.php" class="nav-link"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="headnurse-make-schedule.php" class="nav-link active"><i class="fe fe-calendar"></i> Make Schedule</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="headnurse-show-schedule.php" class="nav-link"><i class="fe fe-calendar"></i> Show Schedule</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="headnurse-availability.php" class="nav-link"><i class="fe fe-calendar"></i> Headnurse Availability</a>
                  </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- body-->
        <div class="my-3 my-md-5">
            <!--  inside body  -->
            <div class="container">
                <div class="row row-cards row-deck">
                    <!-- Left side  -->
                    <div class="col-lg-6" id="disableLeft">
                        <div class="card card-aside">
                            <div class="card-body d-flex flex-column">
                                <!-- Period  -->
                            <form action="" method="post">    
                            <div class="form-group">
                                <div class="form-label">Select Period(day)  Shifts(1st Shift 08:00-16:00 | 2nd Shift 16:00-08:00)</div>
                                <div class="custom-controls-stacked">
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="example-inline-radios7" value="7">
                                        <span class="custom-control-label">7</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="example-inline-radios14" value="14">
                                        <span class="custom-control-label">14</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="example-inline-radios21" value="21">
                                        <span class="custom-control-label">21</span>
                                    </label>
                                    <label class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" class="custom-control-input" name="example-inline-radios28" value="28">
                                        <span class="custom-control-label">28</span>
                                    </label>
                                    <div class="form-group">
                                    <button name="Period" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plane"></span> Period</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                                <!-- Nurse info  -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-label">Nurse List</div>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <thead>
                                                <tr>
                                                    <th class="pl-0">Nurses</th>
                                                    <th>Min Hour</th>
                                                    <th>Max Hour</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <td class="pl-0">
                                                    <?php
                                                        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                                        if ($db->connect_errno > 0) {
                                                          die('Unable to connect to database [' . $db->connect_error . ']');
                                                        }
                                                        $i=1;
                                                        $result2 = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4'");
                                                        $row_cnt = $result2->num_rows;
                                                        $personal_id  = $row['personal_id'];
                                
                                                        while($i<=$row_cnt){
                                                        $result = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4' LIMIT $i");
                                                        $hems_isim;
                                                        $hems_soyisim;

                                                            while($row = mysqli_fetch_object($result)){
                                                                $hems_isim = $row->name;
                                                                $hems_soyisim = $row->surname; 
                                                            }
                                                            echo 
                                                            '<tr>
                                                            <td class="pl-0">
                                                            </select><input type="text" class="form-control" name="example-disabled-input" placeholder="Disabled.." value=" '.$hems_isim.' '.$hems_soyisim.'  " disabled="">
                                                            </td>
                                                            <td>
                                                            <input class="form-control" type="number" min="0"></td>
                                                            <td class="pr-0">
                                                            <input class="form-control" type="number" min="0"></td>  
                                                            </td>
                                                            </tr>';
                                                            $i++;
                                                      }   
                                                    ?>
                                                </tbody></table>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary" name ="saveLeft_period" id="saveLeft" onclick="disbtnLeft();">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right side  -->
                    <div class="col-lg-6" id="disableRight">
                        <div class="card card-aside">
                            <div class="card-body d-flex flex-column">
                                <!-- Period  -->
                                <div class="card container">
                                    <div class="form-group">
                                        <div class="form-label">Sort your constraints top to bottom</div>
                                    </div>
                                    <div class="form-group" style>
                                        <div class="custom-controls-stacked">
                                            <div class="col-sm-4 col-md-12" style="margin-bottom:10px; margin-top:10px;">
                                                <p>Number of night shift for Nurses</p>
                                                <div class="col-3"><p>MinNightShift</p><input type="number" min="0"  class="form-control" placeholder="Value"></div>
                                                <p  style="margin-top:10px;">MaxNightShift</p>
                                                <div class="col-3"><input type="number" min="0"  class="form-control" placeholder="Value"></div>


                                                <div class="form-label" style="margin-top:10px">Enter value</div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder1">
                                                <span class="input-group-text" style="font-size: 10px;">Total hours that below minimum working hour for each nurse</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm"  maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder2">
                                                <span class="input-group-text" style="font-size: 12px;">Total hours that exceed maximum working hour for each nurse</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm"  maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder3">
                                                <span class="input-group-text" style="font-size: 12px;">Number of deficit nurse number for each day and each hour</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder4">
                                                <span class="input-group-text" style="font-size: 10px;">Number of night shifts that is less than assignable minimum night shift number for each nurse</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm"  maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder5">
                                                <span class="input-group-text" style="font-size: 9px;">Number of night shifts that is more than assignable maximum night shift number for each nurse</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm"  maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder6">
                                                <span class="input-group-text" style="font-size: 10px;">States maximum consecutive working day is exceeded or not for each nurse and each day</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder7">
                                                <span class="input-group-text" style="font-size: 12px;">Number of assigned additional shifts for each nurse and each day</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder8">
                                                <span class="input-group-text" style="font-size: 9px;">Shows next day worked or not after worked previous day’s night shift for each nurse and each day</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder9">
                                                <span class="input-group-text" style="font-size: 12px;">Shows senior nurse is assigned each day and each shift or not</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm"  maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder10">
                                                <span class="input-group-text" style="font-size: 8px;">Shows total not working hours in the shift which covers that hours for each nurse, each day and each shift</span>
                                                </span>
                                                </div>

                                                <div class="input-group" style="margin-top:10px;">
                                                    <input type="text" class="form-control-sm" maxlength="5" size="2">
                                                    <span class="input-group-append" id="constraintsOrder11">
                                                <span class="input-group-text" style="font-size: 12px;">Shows nurse i worked or not on consecutive night shifts </span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary" id="saveRight" onclick="disbtnRight();">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                               
                            </div>
                        </div>
                    </div>
                    <!-- Mid side (Table) min. hours  -->
                    <div class="container">
                    <div class="col-lg-12" id="disableMinHours">
                        <div class="card card-aside">
                            <div class="card-body d-flex flex-column">

                                <p>Minimum necessary nurse number for each day and hour
                                    <!-- Table of min. hours  -->
                                <table class="tg">
                                    <tr> 
                                        <th class="tg-c3ow">Days/Hours</th>
                                <?php
                                $day_limit=0;
                                if (isset($_POST['Period'])){
                                    if((isset($_POST['example-inline-radios7']))){
                                        $day_limit=7;
                                    }
                                    elseif (isset($_POST['example-inline-radios14'])){
                                        $day_limit=14;
                                    }
                                    elseif (isset($_POST['example-inline-radios21'])){
                                        $day_limit=21;
                                    }
                                    elseif (isset($_POST['example-inline-radios28'])){
                                        $day_limit=28;
                                    }
                            }
                                $i1 = 0;
                                while($i1<24)
                                        {  
                                            $i2 = $i1+1;
                                            echo '<th class="tg-baqh">'.sprintf("%002d",$i1).' -  ';if($i2!=24) echo sprintf("%002d",$i2); else {echo '00';}  '</th>';
                                            $i1++;
                                        }
                                        $i1=0;
                                echo '</tr>';

                                $i1 = 0; $day = 1; $deger = 0;
                                while($day<$day_limit+1){
                                    echo '<tr> <td class="tg-baqh"> ' .$day. ' </td>';
                                        while($i1<24)
                                        {  
                                            $i2 = $i1+1;
                                            $deger = 'Day=' . $day . '|' . 'Shift=' . sprintf("%002d",$i1) . '-' . sprintf("%002d",$i2);
                                            echo '<td class="tg-baqh">  <select name="minNurse">
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select> </td>';
                                            $i1++;
                                        }
                                        $i1=0;
                                        $day++;
                                    } 
                                ?>
                            </table>
                                <div class="text-right" style="margin-top:20px;">
                                    <button type="button" class="btn btn-primary" id="saveMinHours" onclick="disbtnMinHours();">Save</button>
                                </div>
                            </div>

                        </div>

                    </div>
                    </div>
                    <!-- Mid side (Table) annual permit  -->
                    <div class="container">
                    <div class="col-lg-12" id="disableAnnualPermit">
                        <div class="card card-aside">
                            <div class="card-body d-flex flex-column">

                                <p> States annual leave </p>
                                <table class="tg">
                                    <tr>
                                        <th class="tg-c3ow">Days/Nurse Name</th>
                                        <?php
                                        $day_limit=0;
                                        if (isset($_POST['Period'])){
                                            if((isset($_POST['example-inline-radios7']))){
                                                $day_limit=7;
                                            }
                                            elseif (isset($_POST['example-inline-radios14'])){
                                                $day_limit=14;
                                            }
                                            elseif (isset($_POST['example-inline-radios21'])){
                                                $day_limit=21;
                                            }
                                            elseif (isset($_POST['example-inline-radios28'])){
                                                $day_limit=28;
                                            }
                                        }
                                        $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                                        if ($db->connect_errno > 0) {
                                             die('Unable to connect to database [' . $db->connect_error . ']');
                                        }

                                            $i=1;
                                            $result2 = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4'");
                                            $row_cnt = $result2->num_rows;
                                            $personal_id  = $row['personal_id'];
                                
                                            while($i<=$row_cnt){
                                                $result = $db->query("SELECT name,surname from personal WHERE personal_id ='2' OR personal_id='3' OR personal_id='4' LIMIT $i");
                                                $hems_isim;
                                                $hems_soyisim;

                                                while($row = mysqli_fetch_object($result)){
                                                    $hems_isim = $row->name;
                                                    $hems_soyisim = $row->surname; 
                                                }
                                                echo '<th class="tg-baqh">'.$hems_isim.' '.$hems_soyisim.'</th>';
                                                $i++;
                                            }   
                                    ?>
                                    </tr>
                                    <?php
                                $i1 = 0; $day = 1; $deger = 0;
                                while($day<$day_limit+1){
                                    echo '<tr> <td class="tg-baqh"> ' .$day. ' </td>';
                                        while($i1<$row_cnt)
                                        {  
                                            $i2 = $i1+1;
                                            echo '<td class="tg-baqh"><select name="AnnualPermit">
                                                <option value="0" selected="">No</option>
                                                <option value="0">Yes</option>
                                            </select></td>';
                                            $i1++;
                                        }
                                        $i1=0;
                                        $day++;
                                    } 
                                ?>
                                </table>       
                                <div class="text-right" style="margin-top:20px;">
                                    <button type="button" name="optimize"class="btn btn-primary" id="disbtnAnnualPermit" onclick="disbtnAnnualPermit()">Save Annual Leave</button>
                                </div>
                                <?php
                                        $day_limit=0;
                                        if (isset($_POST['optimize'])){

                                        }
                                ?>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
                <!-- when all buttons are clicked, go to the show schedule page -->
                <div class="container">
                <div class="col-12 text-right">
                    <p>Click the button if you are sure that you have completed all forms correctly.</p>
                    <a href="write.php" style="color:white; text-decoration: none; margin-top:10px; margin-bottom:10px;" ><button type="button" class="btn btn-primary" id="optimizeButton" onclick=" " style="margin-bottom:20px;">Make Schedule</button></a>
                </div>
                </div>
            <!-- end of the inside body-->
            </div>
    </div>
        <!-- footer-->
    <footer class="footer">
        <div class="container">

            <div class="row align-items-center flex-row-reverse">
                <div class="col-auto ml-lg-auto">
                    <div class="row align-items-center">
                        <div class="col-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="https://docs.google.com/document/d/1lIVltkIwNedM9aU89IxjCY0GATJaUQ-n4St19w-2LiQ/edit?ts=5df655cf" target="_blank">Documentation</a></li>
                        </ul>>
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
</div>
</body>
</html>