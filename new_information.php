<?php
require('dbconnect.php');
/*　以下whereのidの値をhomeからくるidの値を変数として入れる*/
$recordSet = mysqli_query($db, 'SELECT * FROM news WHERE id = 1');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新着情報</title>
    <link rel="shortcut icon" href="img/logo/tpu_logo.png">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/new_information.css">
  </head>
  <body>
    <!-- ヘッダー -->
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
      <?php while ($table = mysqli_fetch_assoc($recordSet)) {?>
      <ol class="path">
        <li><a href="home.php">ホーム</a></li>
        <li>></li>
        <li><a href="home.php">新着情報(<?php echo(htmlspecialchars($table['category']));?>)</a></li>
        <li>></li>
        <li><?php echo(htmlspecialchars($table['title']));?></li>
      </ol>
      <div class="clear"></div>
    </header>


    <!-- コンテンツ -->
    <div class="container contents">
      <div class="row">
        <div class="col-md4">
            <blockquote>
              <p><?php echo(htmlspecialchars($table['title']));?></p>
            </blockquote>
          </div>
          <br />
          <br />


          <table class="news">
          	<tr>
          		<th scope="row">タイトル名</th>
          		<td><?php echo(htmlspecialchars($table['title']));?></td>
          	</tr>
            <tr>
              <th scope="row">日付</th>
              <td><?php echo(htmlspecialchars($table['year']));?>年<?php echo(htmlspecialchars($table['month']));?>月<?php echo(htmlspecialchars($table['day']));?>日</td>
            </tr>
          	<tr>
          		<th scope="row">対象学年</th>
          		<td><?php echo(htmlspecialchars($table['target']));?></php></td>
          	</tr>
          	<tr>
          		<th scope="row">詳細</th>
          		<td><?php echo(htmlspecialchars($table['text']));?></td>
          	</tr>
          </table>

          <br />
          <br />
          <?php }?>

        </div>
      </div>
    <!-- フッター -->
    <?php include('footer.php'); ?>

  </body>
</html>
