<?php
require('dbconnect.php');
require('calendar.php');

$record = mysqli_query($db, 'SELECT * FROM news ORDER BY id DESC LIMIT 5');
$recordSet=mysqli_query($db, 'SELECT * FROM calendar_datas');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Top</title>
    <link rel="shortcut icon" href="img/logo/tpu_logo.png">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/home.css">
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
      <div class="topImage">
        <img src="img/pic/s_career_3.jpg" alt="" />
      </div>
      <div class="tabs">
        <ul>
          <li><a href="#information">新着情報</a></li>
          <li><a href="#calendar">スケジュール</a></li>
          <li><a href="#sirumoku">シルモク</a></li>
        </ul>
      </div>
      <div id="information">
        <div class="center">
          <p class="contentsTitle">新着情報</p>
          <p class="b_contentsTitle">News</p>
        </div>
        <div class="info-content">
          <?php
          while ($table = mysqli_fetch_assoc($record)) {
          ?>
            <div class="info-topic">
              <div class="info-date"><p><?php echo $table['year'], "/", $table['month'], "/", $table['day']; ?></p></div>
              <div class="info-title"><p><?php echo htmlspecialchars($table['title']); ?></p></div>
            </div>
            <div class="info-tags">
              <div class="info-tag"><p><?php echo htmlspecialchars($table['target']); ?></p></div>
              <div class="info-tag"><p><?php echo htmlspecialchars($table['category']); ?></p></div>
            </div>
          <?php
          }
          ?>
        </div>
        <div class="allnews">
          <span><a href="allnews.php">新着情報一覧</a></span>
        </div>
      </div>
      <div id="calendar">
        <div class="center">
          <p class="contentsTitle">スケジュール</p>
          <p class="b_contentsTitle">Schedule</p>
        </div>
        <h3><?php echo $year; ?>年<?php echo $month; ?>月</h3>
        <table>
          <tr class="day">
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
          </tr>
          <tr class="days">
            <?php
            $cnt = 0;
            foreach ($calendar as $key => $value):
            ?>
            <td>
              <?php $cnt++;
              echo $value['day'];
              echo "</br>";
              while($table = mysqli_fetch_assoc($recordSet)){
                if (htmlspecialchars($table['day']) == $value['day'] && htmlspecialchars($table['month']) == $month && htmlspecialchars($table['year']) == $year) {
                  echo htmlspecialchars($table['event']);
                }
              }
              ?>
            </td>
            <?php if ($cnt == 7): ?>
          </tr>
          <?php
          $cnt = 0;
          endif;
          endforeach;
          ?>
        </table>
      </div>
      <div id="sirumoku">
        <div class="center">
          <p class="contentsTitle">シルモク</p>
          <p class="b_contentsTitle">企業を知る木曜日</p>
        </div>
        <div class="image">
          <img src="img/pic/sirumoku.jpg" alt="" />
          <div class="tab_link">
            <a href="sirumoku-subscription.php"><span class="tab_link_inside">申し込みはこちら</span></a>
          </div>
        </div>
        <div class="intro">
          <p>
            県内企業が自社の魅力・実力を学生に紹介する
          </p>
          <p>
            学内企業説明会
          </p>
          <p class="intro_margin">
            富山県に関係のある企業の方にお越しいただき
          </p>
          <p>
            業務内容や自社製品について紹介していただきます。
          </p>
        </div>
        <div class="sirumoku_datas">
          <table>
            <tr class="s_data_list">
              <th class="s_data_day">開催日</th>
              <th class="s_data_time">時間</th>
              <th class="s_data_name">企業名</th>
            </tr>
            <tr class="s_data_topic">
              <th class="s_data_day">10月30日(木)</th>
              <th class="s_data_time">14:50 〜 16:20</th>
              <th class="s_data_name">株式会社リッチェル<br>株式会社スギノマシン</th>
            </tr>
          </table>
        </div>
        <div class="s_past">
          <span><a href="sirumoku.php">過去のシルモクをみる</a></span>
        </div>
      </div>
    </div>
    <?php include('footer.php'); ?>
  </body>
</html>
