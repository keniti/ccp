<?php
//connect to databese
require('dbconnect.php');
//formでpostされた情報を受け取る
//ini_set('display_errors', 0);
if (empty($_POST['industryType'])) {
  $record = mysqli_query($db, 'SELECT * FROM company_datas ORDER BY id DESC');
}
else if(isset($_POST['industryType'])){
  $result = $_POST['industryType'];
  //value値を['industryType']と同じ業種へ変換
  $ja = array(30 => '建設業', 31 => '情報通信業', 32 => '教育・学習支援業', 33 => '製造業', 34 => '金融業・保険業', 35 => '公務', 3000 => 'その他');
  foreach ($result as $value) {
    if($value == 3){
      $record = mysqli_query($db, "SELECT * FROM company_datas ORDER BY id DESC");
    }else{
      $record = mysqli_query($db, "SELECT * FROM company_datas WHERE indust_type='$ja[$value]'");
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>求人の検索結果</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/recruitment.css">
  </head>
  <body>
    <header>
      <h1>
        <img class="logo" src="img/tpu_logo_set.svg" alt="TPUのロゴ"/>
      </h1>
      <!-- ナビメニュー -->
      <div class="nav-menu">
        <ul id="menu">
          <li id="home"><a class="unselected_tab" href="home.php">ホーム</a></li>
          <li id="info-career"><a class="unselected_tab" href="info_career.php">就職情報</a></li>
          <li id="intern"><a class="selected_tab" href="recruitment.php">求人情報</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    <div class="searchform">
      <form class="searchform_re" action="recruitment.php#result" method="post">
        <ul class="local">
          <li><input type="checkbox" name="local" value="1">すべて選択</li>
          <li><input type="checkbox" name="local" value="11">県内</li>
          <li><input type="checkbox" name="local" value="12">県外</li>
        </ul>
        <ul>
          <li><input type="checkbox" name="department" class="department" value="2">すべて選択</li>
          <li><input type="checkbox" name="department" class="department" value="21">機械システム工学科</li>
          <li><input type="checkbox" name="department" class="department" value="23">知能デザイン工学科</li>
          <li><input type="checkbox" name="department" class="department" value="24">情報システム工学科</li>
          <li><input type="checkbox" name="department" class="department" value="25">生物工学科</li>
          <li><input type="checkbox" name="department" class="department" value="26">環境工学科</li>
        </ul>
        <ul class="indust_1">
          <li><input type="checkbox" name="industryType[]" calss="indust" value="3">すべて選択</li>
        </ul>
        <ul class="indust_2">
          <li><input type="checkbox" name="industryType[]" calss="indust" value="30">農業・林業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="32">漁業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="33">鉱業，採石業，砂利採取行</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="34">建設業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="35">製造業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="36">電気・ガス・熱供給・水道業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="37">情報通信業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="38">運輸業，郵便業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="39">卸売業，小売業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="300">金融業，保険業</li>
        </ul>
        <ul class="indust_3">
          <li><input type="checkbox" name="industryType[]" calss="indust" value="301">不動産業，物品賃貸業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="302">学術研究，専門・技術サービス</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="303">宿泊業，飲食サービス業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="304">生活関連サービス業，娯楽業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="305">教育，学習支援業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="306">医療，福祉</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="307">複合サービス事業</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="308">サービス業(他に分類されないもの)</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="309">公務(他に分類されるものを除く)</li>
          <li><input type="checkbox" name="industryType[]" calss="indust" value="3000">分類不能の産業</li>
        </ul>
        <div class="clear"></div>
        <input class="submit" type="submit" name="検索">
        <input class="reset" type="reset" name="リセット">
      </form>
    </div>
    <div class="clear"></div>
    <section>
      <table>
        <tr>
          <th>企業名</th>
          <th>業種</th>
          <th>所在地</th>
        </tr>
        <?php
        if (empty($_POST['industryType'])){
          while ($table = mysqli_fetch_assoc($record)) {
        ?>
          <tr>
            <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
            <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
            <td><?php print(htmlspecialchars($table['address'])); ?></td>
          </tr>
<?php     }
        }else if(isset($_POST['industryType']) && $value == 3){
          while ($table = mysqli_fetch_assoc($record)) { ?>
            <div id="result">
              <tr>
                <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
                <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
                <td><?php print(htmlspecialchars($table['address'])); ?></td>
              </tr>
            </div>
<?php     }
        }else if(isset($_POST['industryType']) && $value != 3){
          while ($table = mysqli_fetch_assoc($record)) { ?>
            <div id="result">
              <tr>
                <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
                <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
                <td><?php print(htmlspecialchars($table['address'])); ?></td>
              </tr>
            </div>
<?php     }
        } ?>
      </table>
    </section>
    <?php include('_footer.html'); ?>
  </body>
</html>
