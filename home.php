<?php
require('dbconnect.php');
require('calendar.php');

$record = mysqli_query($db, 'SELECT * FROM news ORDER BY id DESC LIMIT 5');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Top</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <header>
      <img class="logo" src="img/tpu_logo_set.svg" alt="TPUのロゴ"/>
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
        <table>
          <?php
          while ($table = mysqli_fetch_assoc($record)) {
          ?>
            <tr>
              <td><?php print(htmlspecialchars($table['data'])); ?></td>
              <td><?php print(htmlspecialchars($table['title'])); ?></td>
              <td><?php print(htmlspecialchars($table['target'])); ?></td>
              <td><?php print(htmlspecialchars($table['category'])); ?></td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
        <div class="center">
          <div class="news_1">
      			<p>2016/10/12 <span></span>キャリア形成論 <span></span>「第3回　キャリア形成論」, 2年生へのお知らせ</p>
      		</div>

      		<div class="news_2">
      			<p>2016/10/03 <span></span>キャリア形成論 <span></span>「第2回　キャリア形成論」, 1年生へのお知らせ</p>
      		</div>

      		<div class="news_3">
      			<p>2016/09/12 <span></span>学内合同説明会 <span></span>「第3回　シルモク開催」, 参加申し込みに関するお知らせ</p>
      		</div>
        </div>
      <div id="calendar">
        <div class="center">
          <p class="contentsTitle">スケジュール</p>
          <p class="b_contentsTitle">Schedule</p>
        </div>
        <h3><?php echo $year; ?>年<?php echo $month; ?>月</h3>
        <table>
          <tr>
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
            $dsn = 'mysql:host=localhost;dbname=ccp';//データベース情報
            try {$pdo = new PDO(
            $dsn,'root','',
            [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
            );
          }catch (PDOException $e) {
            header('Content-Type: text/plain; charset=UTF-8', true, 500);
            exit($e->getMessage());
          }
          ?>
            <?php $cnt = 0; ?>
            <?php foreach ($calendar as $key => $value): ?>
            <td>
              <?php $cnt++; ?>
              <?php echo $value['day']; ?>
              <br>
              <?php
              $recordSet=mysqli_query($db, 'SELECT * FROM calendar_datas ORDER BY id DESC');
              while($table = mysqli_fetch_assoc($recordSet)){
                if (htmlspecialchars($table['day']) == $value['day'] && htmlspecialchars($table['month']) == $month && htmlspecialchars($table['year']) == $year) {
                  echo htmlspecialchars($table['event']);
                }
              }?>
            </td>
            <?php if ($cnt == 7): ?>
          </tr>
          <tr class="event">
          </tr>
          <tr>
            <?php $cnt = 0; ?>
            <?php endif; ?>
            <?php endforeach; ?>
          </tr>
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
            <a href="#"><span class="tab_link_inside">申し込みはこちら</span></a>
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
          <span><a href="#">過去のシルモクをみる</a></span>
        </div>
      </div>
    </div>
    <?php include('_footer.html'); ?>
  </body>
</html>
