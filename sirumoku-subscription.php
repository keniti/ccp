<?php
  require('dbconnect.php');
  $sql_date=sprintf('SELECT * FROM `sirumoku_data` WHERE 1');
  $record_date=mysqli_query($db,$sql_date);
  $sql_department=sprintf('SELECT * FROM `departments` WHERE 1');
  $record_department=mysqli_query($db,$sql_department);
  $sql_prefecture=sprintf('SELECT * FROM `prefectures` WHERE 1');
  $record_prefcture=mysqli_query($db,$sql_prefecture);
  // while($table=mysqli_fetch_assoc($recordSet)){
  //   print(htmlspecialchars($table['date']));
  // }
  $date = date('Y-m-d');
  $deadline=date('Y-m-d', strtotime("+3 day"));
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>シルモク参加申込</title>
    <link rel="shortcut icon" href="img/logo/tpu_logo.png">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <header>
      <img class="logo" src="img/logo/tpu_logo_set.svg" alt="TPUのロゴ"/>
      <!-- ナビメニュー -->
      <div class="nav-menu">
        <ul id="menu">
          <li id="home"><a class="selected_tab" href="home.php">ホーム</a></li>
          <li id="info-career"><a class="unselected_tab" href="info_career.php">就職情報</a></li>
          <li id="intern"><a class="unselected_tab" href="recruitment.php">求人情報</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    <div class="contents">
      <form id="form" action="sirumoku-subscription-check.php" method="post">
        <select class="" name="date">
          <option value="none">選択してください</option>
          <?php
          while($table_date=mysqli_fetch_assoc($record_date)){
            if($table_date['date'] > $deadline){
          ?>
              <option name="date" value="<?php print(htmlspecialchars($table_date['date'])); ?>"><?php print(htmlspecialchars($table_date['date'])); ?></option>
          <?php
            }
          }
          ?>
        </select>
        <input type="text" name="name" placeholder="氏名">
        <input type="text" name="student_number" placeholder="学籍番号">
        <input type="submit" name="" value="参加申込する">
      </form>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
