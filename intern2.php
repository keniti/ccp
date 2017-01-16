<?php
	session_start();
	require('dbconnect.php');
	// 職種によってデータベースからデータを取り出すための関数
	function loadBusinessType($str){
		require('dbconnect.php');
		$sql = sprintf('SELECT * FROM `intern_datas` WHERE `business_type` = "%s" ORDER BY "created"',  $str);
		$record = mysqli_query($db, $sql) or die(mysqli_error());
		$r_table = array();
		while($rec = mysqli_fetch_assoc($record)){
			$r_table[] = $rec;
		}
		return $r_table;
	}
	//ページが引数なしに呼び出された時の関数
	function defaultBusinessType(){
		$sql = sprintf('SELECT * FROM `intern_datas` WHERE 1 ORDER BY "created"',  $str);
		$record = mysqli_query($db, $sql) or die(mysqli_error());
		$r_table = array();
		while($rec = mysqli_fetch_assoc($record)){
			$r_table[] = $rec;
		}
		return $r_table;
	}

	if (!empty($_GET['business_type']) && isset($_GET['business_type'])) {
		switch ($_GET['business_type']) {
			case 'A':
				$table = loadBusinessType('A');
				break;
			case 'B':
				$table = loadBusinessType('B');
				break;
			case 'C':
				$table = loadBusinessType('C');
				break;
			case 'D':
				$table = loadBusinessType('D');
				break;
			case 'E':
				$table = loadBusinessType('E');
				break;
			case 'F':
			 	$table = loadBusinessType('F');
			 	break;
			 case 'G':
			 	$table = loadBusinessType('G');
			 	break;
			 case 'H':
			 	$table = loadBusinessType('H');
			 	break;
			 case 'I':
			 	$table = loadBusinessType('I');
			 	break;
			 case 'J':
			 	$table = loadBusinessType('J');
			 	break;
			 case 'K':
			 	$table = loadBusinessType('K');
			 	break;
			 case 'L':
			 	$table = loadBusinessType('L');
			 	break;
			 case 'M':
			 	$table = loadBusinessType('M');
			 	break;
			 case 'N':
			 	$table = loadBusinessType('N');
			 	break;
			 case 'O':
			 	$table = loadBusinessType('O');
			 	break;
			 case 'P':
			 	$table = loadBusinessType('P');
			 	break;
			 case 'Q':
			 	$table = loadBusinessType('Q');
			 	break;
			 case 'R':
			 	$table = loadBusinessType('R');
			 	break;
			 case 'S':
			 	$table = loadBusinessType('S');
			 	break;
			 case 'T':
			 	$table = loadBusinessType('T');
			 	break;
			 default:
				$table = defaultBusinessType();
				break;
		}
	}
	else{
		$sql = sprintf('SELECT * FROM `intern_datas` WHERE 1 ORDER BY "created"');
		$record = mysqli_query($db, $sql) or die(mysqli_error());
		$table = array();
		while($rec = mysqli_fetch_assoc($record)){
			$table[] = $rec;
		}
	}
 ?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>就職先データ</title>
    <link rel="shortcut icon" href="img/logo/tpu_logo.png">
		<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/common.css">
		<link rel="stylesheet" href="css/intern.css">
	</head>
	<body>
		<header>
      <img class="logo" src="img/logo/tpu_logo_set.svg" alt="TPUのロゴ"/>
      <!-- ナビメニュー -->
      <div class="nav-menu">
        <ul id="menu">
          <li id="home"><a class="unselected_tab" href="home.php">ホーム</a></li>
          <li id="info-career"><a class="selected_tab" href="info_career.php">就職情報</a></li>
          <li id="intern"><a class="unselected_tab" href="recruitment.php">求人情報</a></li>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
		<!-- コンテンツ部分 -->
		<div class="contents">
			<h2>過去5年分の就職者情報</h2>
			<p>
				下記には、
				<?php print(date('Y')); ?>
				年度から過去5年間のそれぞれの企業への就職者人数を表示しています。
			</p>
			<div　id = "table-01">
				<!-- 参考サイト：http://bashalog.c-brains.jp/08/06/13-165130.php -->
				<table id="table-02">
					<tr>
						<th>社名</th>
						<th>職種</th>
						<th>就職者人数</th>
					</tr>
					<?php
						foreach ($table as $table) {
							echo "<tr>";
								echo "<td>";
									echo $table['company_name'];
								echo "</td>";
								echo "<td>";
									echo $table['business_type'];
								echo "</td>";
								echo "<td>";
									$data_to_year = explode(",", $table['number_of_employer']);
									$num = array();
									for ($j=0; $j < 5; $j++) {
										$num[$j] = explode("_", $data_to_year[$j]);
									}
									$sum = 0;
									for ($j=0; $j < 5; $j++) {
										$sum += $num[$j][1];
									}
									echo $sum;
								echo "</td>";
							echo "</tr>";
						}
					 ?>
				</table>
			</div>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>
