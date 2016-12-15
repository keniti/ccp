<?php
//connect to databese
require('dbconnect.php');
//page遷移
$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : "";
if($page == ""){
  $page = 1;
}
$page = max($page, 1);
//最終ページの取得
$sql = 'SELECT COUNT(*) AS cnt FROM company_datas';
$record = mysqli_query($db, $sql);
$count = mysqli_fetch_assoc($record);
$maxPage = ceil($count['cnt']/10);
$start = ($page-1)*10;
$record = mysqli_query($db, 'SELECT * FROM company_datas ORDER BY id DESC LIMIT' . $start . ',10');
//formでpostされた情報を受け取る
ini_set('display_errors', 0);
$result = $_POST['industryType'];
$recordSet = mysqli_query($db, 'SELECT * FROM company_datas ORDER BY id DESC');
//value値を['industryType']と同じ業種へ変換
$ja = array(10 => '建設業', 11 => '情報通信業', 12 => '教育・学習支援業', 13 => '製造業', 14 => '金融業・保険業', 15 => '公務', 1000 => 'その他');
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
        <ul>
          <li><input type="checkbox" name="industryType[]" value="1">すべて選択</li>
          <li><input type="checkbox" name="industryType[]" value="10">建設業</li>
          <li><input type="checkbox" name="industryType[]" value="11">情報通信業</li>
          <li><input type="checkbox" name="industryType[]" value="12">教育・学習支援業</li>
          <li><input type="checkbox" name="industryType[]" value="13">製造業</li>
          <li><input type="checkbox" name="industryType[]" value="14">金融業・保険業</li>
          <li><input type="checkbox" name="industryType[]" value="15">公務</li>
          <li><input type="checkbox" name="industryType[]" value="1000">その他</li>
        </ul>
        <input class="submit" type="submit" name="検索">
        <input class="reset" type="reset" name="リセット">
      </form>
    </div>
    <section>
      <table>
        <tr>
          <th>企業名</th>
          <th>業種</th>
          <th>住所</th>
          <th>HP</th>
        </tr>
        <?php
        if (empty($_POST['industryType'])){
          while ($table = mysqli_fetch_assoc($recordSet)) {
        ?>
          <tr>
            <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
            <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
            <td><?php print(htmlspecialchars($table['address'])); ?></td>
            <td><a href="<?php print(htmlspecialchars($table['url_list'])); ?>">HP</a></td>
          </tr>
<?php     }
        }else{
          foreach ($result as $value) {
            if($value == 1){
              $recordSet = mysqli_query($db, "SELECT * FROM company_datas ORDER BY id DESC");
              while ($table = mysqli_fetch_assoc($recordSet)) { ?>
                <div id="result">
                  <tr>
                    <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
                    <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
                    <td><?php print(htmlspecialchars($table['address'])); ?></td>
                    <td><a href="<?php print(htmlspecialchars($table['url_list'])); ?>">HP</a></td>
                  </tr>
                </div>
  <?php       }
            }else{
              $recordSet = mysqli_query($db, "SELECT * FROM company_datas WHERE indust_type='$ja[$value]'");
              while ($table = mysqli_fetch_assoc($recordSet)) { ?>
                <div id="result">
                  <tr>
                    <td><a href="#"><?php print(htmlspecialchars($table['company_n'])); ?></a></td>
                    <td><?php print(htmlspecialchars($table['indust_type'])); ?></td>
                    <td><?php print(htmlspecialchars($table['address'])); ?></td>
                    <td><a href="<?php print(htmlspecialchars($table['url_list'])); ?>">HP</a></td>
                  </tr>
                </div>
<?php         }
            }
          }
        } ?>
      </table>
      <ul>
        <?php if($page>1){ ?>
          <li><a href="recruitment.php?page=<?php print($page-1); ?>">前のページ</a></li>
        <?php
        }else if($page<$maxPage){
        ?>
          <li><a href="recruitment.php?page=<?php print($page+1); ?>">次のぺージ</a></li>
        <?php
        }else{}
        ?>
      </ul>
    </section>
    <?php include('_footer.html'); ?>
  </body>
</html>
