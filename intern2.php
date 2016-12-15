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

	if (!empty($_POST['business_type']) && isset($_POST['business_type'])) {
		switch ($_POST['business_type']) {
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
			default:
				$table = loadBusinessType('1');
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
		<link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/intern.css">
    <link rel="stylesheet" href="css/common.css">
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
		      <li id="intern"><a class="selected_tab" href="intern.php">インターン情報</a></li>
		    </ul>
		  </div>
		  <div class="clear"></div>
		</header>
		<!-- コンテンツ部分 -->
		<div class="past-info">

		</div>
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
		<!-- 以下テスト用 -->
<!-- 		
		<form action='intern.php' method='post'>
			<input type='hidden' name='business_type' value='B'>
			<input type='submit' value='B'>
		</form>
		<form action='intern.php' method='post'>
			<input type='hidden' name="business_type" value='C'>
			<input type="submit" value='C'>
		</form> -->
		<?php include('_footer.html'); ?>
	</body>
</html>
