<?php
//connect to databese
require('dbconnect.php');
//エラーを非表示にする
//ini_set('display_errors', 0);

if (empty($_POST['employment']) && empty($_POST['intern']) && empty($_POST['local']) && empty($_POST['industryType'])) {
  $page = $_REQUEST['page'];
  if($page = '') {
    $page = 1;
  }
  $page = max($page, 1);
  $recordset = 'SELECT COUNT(*) AS cnt FROM employment_datas';
  $recordSet = mysqli_query($db, $recordset);
  $r_table = mysqli_fetch_assoc($recordSet);
  $maxPage = ceil($r_table['cnt'] / 5);
  $start = ($page - 1) * 5;

  $sql = sprintf('SELECT * FROM employment_datas, company_datas, location_datas, industries WHERE employment_datas.company_id=company_datas.company_id AND company_datas.location_id=location_datas.location_id AND company_datas.indust_id=industries.indust_id ORDER BY id DESC LIMIT ' . $start. ',5');
  $record = mysqli_query($db, $sql) or die(mysqli_error());
  $table = array();
  while($set = mysqli_fetch_assoc($record)){
    $table[] = $set;
  }
}
else if(isset($_POST['industryType'])){
  //formでpostされた情報を受け取る
  $result_indust = $_POST['industryType'];
  //value値を['industryType']と同じ業種へ変換
  //$ja = array(20 => '建設業', 21 => '情報通信業', 22 => '教育・学習支援業', 23 => '製造業', 24 => '金融業・保険業', 25 => '公務', 2000 => 'その他');
  foreach ($result_indust as $value) {
    $sql = sprintf('SELECT * FROM ');
		$record = mysqli_query($db, $sql) or die(mysqli_error());
    $table = array();
    while($rec = mysqli_fetch_assoc($record)){
      $table[] = $rec;
    }
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
    <link rel="shortcut icon" href="img/logo/tpu_logo.png">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/recruitment.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <!-- .selectorのcheckboxを単一選択にする -->
    <script type="text/javascript">
        jQuery(function($){
            $(function(){
              $('.select').on('click', function() {
                if ($(this).prop('checked')){
                    // 一旦全てをクリアして再チェックする
                    $('.select').prop('checked', false);
                    $(this).prop('checked', true);
                }
              });
            });
        });
    </script>
  </head>
  <body>
    <header>
      <div class="header-logo">
        <a href="home.php"><img class="logo" src="img/logo/tpu_logo_set.svg" alt="TPUのロゴ"/></a>
      </div>
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
        <ul class="selector">
          <li><input type="checkbox" name="employment" class="select" value="11">就職求人情報</li>
          <li><input type="checkbox" name="intern" class="select" value="12">インターンシップ求人情報</li>
        </ul>
        <ul class="local_1">
          <li><input type="checkbox" name="local" class="local[]" value="2">すべて選択</li>
        </ul>
        <ul class="local_2">
          <li><input type="checkbox" name="local" class="local[]" value="21">北海道・東北</li>
          <li><input type="checkbox" name="local" class="local[]" value="22">関東</li>
          <li><input type="checkbox" name="local" class="local[]" value="23">甲信越</li>
          <li><input type="checkbox" name="local" class="local[]" value="24">富山</li>
          <li><input type="checkbox" name="local" class="local[]" value="25">石川・福井</li>
          <li><input type="checkbox" name="local" class="local[]" value="26">東海</li>
          <li><input type="checkbox" name="local" class="local[]" value="27">近畿</li>
          <li><input type="checkbox" name="local" class="local[]" value="28">四国・中国・九州</li>
        </ul>
        <ul class="indust_1">
          <li><input type="checkbox" name="industryType[]" value="3">すべて選択</li>
        </ul>
        <ul class="indust_2">
          <li><input type="checkbox" name="industryType[]" value="30">農業・林業</li>
          <li><input type="checkbox" name="industryType[]" value="31">漁業</li>
          <li><input type="checkbox" name="industryType[]" value="32">鉱業，採石業，砂利採取行</li>
          <li><input type="checkbox" name="industryType[]" value="33">建設業</li>
          <li><input type="checkbox" name="industryType[]" value="34">製造業</li>
          <li><input type="checkbox" name="industryType[]" value="35">電気・ガス・熱供給・水道業</li>
          <li><input type="checkbox" name="industryType[]" value="36">情報通信業</li>
          <li><input type="checkbox" name="industryType[]" value="37">運輸業，郵便業</li>
          <li><input type="checkbox" name="industryType[]" value="38">卸売業，小売業</li>
          <li><input type="checkbox" name="industryType[]" value="39">金融業，保険業</li>
        </ul>
        <ul class="indust_3">
          <li><input type="checkbox" name="industryType[]" value="300">不動産業，物品賃貸業</li>
          <li><input type="checkbox" name="industryType[]" value="301">学術研究，専門・技術サービス</li>
          <li><input type="checkbox" name="industryType[]" value="302">宿泊業，飲食サービス業</li>
          <li><input type="checkbox" name="industryType[]" value="303">生活関連サービス業，娯楽業</li>
          <li><input type="checkbox" name="industryType[]" value="304">教育，学習支援業</li>
          <li><input type="checkbox" name="industryType[]" value="305">医療，福祉</li>
          <li><input type="checkbox" name="industryType[]" value="306">複合サービス事業</li>
          <li><input type="checkbox" name="industryType[]" value="307">サービス業(他に分類されないもの)</li>
          <li><input type="checkbox" name="industryType[]" value="308">公務(他に分類されるものを除く)</li>
          <li><input type="checkbox" name="industryType[]" value="3000">分類不能の産業</li>
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
          <th class="company_name">企業名</th>
          <th class="indust_type">業種</th>
          <th class="address">所在地</th>
        </tr>
        <?php
        if (empty($_POST['employment']) && empty($_POST['intern']) && empty($_POST['local']) && empty($_POST['industryType'])){
          while($table = mysqli_fetch_assoc($recordSet))
          foreach($r_table as $table){
            echo $table['id'];
        ?>
            <tr>
              <td class="company_name"><a href="#"><?php print(htmlspecialchars($table['company_name'])); ?></a></td>
              <td class="indust_type"><?php print(htmlspecialchars($table['indust_name'])); ?></td>
              <td class="address"><?php print(htmlspecialchars($table['location_name'])); ?></td>
            </tr>
<?php     }
          for ($x=1; $x <= $maxPage ; $x++) { ?>
            <a href="recruitment.php?page=<?php echo $x ?>"><?php echo $x; ?></a>
<?php     }
        }else if(isset($_POST['industryType']) && $value == 3){
          while ($table = mysqli_fetch_assoc($record)) { ?>
            <div id="result">
              <tr>
                <td class="company_name"><a href="#"><?php print(htmlspecialchars($table['company_name'])); ?></a></td>
                <td class="indust_type"><?php print(htmlspecialchars($table['indust_name'])); ?></td>
                <td class="address"><?php print(htmlspecialchars($table['address'])); ?></td>
              </tr>
            </div>
<?php     }
        }else if(isset($_POST['industryType']) && $value != 3){
          while ($table = mysqli_fetch_assoc($record)) { ?>
            <div id="result">
              <tr>
                <td class="company_name"><a href="#"><?php print(htmlspecialchars($table['company_name'])); ?></a></td>
                <td class="indust_type"><?php print(htmlspecialchars($table['indust_type'])); ?></td>
                <td class="address"><?php print(htmlspecialchars($table['address'])); ?></td>
              </tr>
            </div>
<?php     }
        } ?>
      </table>
    </section>
    <?php include('footer.php'); ?>
  </body>
</html>
