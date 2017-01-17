<?php
	session_start();
	require('dbconnect.php');
	//職種で呼ばれた場合は、A,B,...がくる
	//学科で呼ばれた場合は、機械だとか知能だとかがくる
	if(!empty($_GET) && isset($_GET)){
		$job_kind = $_GET['business_type'];
		$sql = sprintf('SELECT * FROM `employee` WHERE `job_kind` = "%s"', $job_kind);
		$record = mysqli_query($db,$sql) or die(mysqli_error($db));
		$data = array();
		while($rec = mysqli_fetch_assoc($record)){
			$data[] = $rec;
		}
	}
	else{
		$sql = sprintf('SELECT * FROM `employee` WHERE 1');
		$record = mysqli_query($db,$sql) or die(mysqli_error($db));
		$data = array();
		while($rec = mysqli_fetch_assoc($record)){
			$data[] = $rec;
		}
	}
	//データベースに登録された就職者の人数についてのカラム（String型）から人数を計算するメソッド
	function count_employer($str){
		$depertment_data = explode(":", $str);
		$each_employer_num = array();
		$num_of_employer = 0;
		//学科分け
		for($i=0;$i<count($depertment_data);$i++){
			$each_employer_num[$i] = explode("_", $depertment_data[$i]);
		}
		//就職者の人数部分を取り出して足し合わせ
		for($j=0;$j<count($each_employer_num);$j++){
			$num_of_employer += $each_employer_num[$j][1];
		}
		return $num_of_employer;
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
    <link rel="stylesheet" href="css/intern.css">
    <link rel="stylesheet" href="css/common.css">
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
		<div class="past-info">

		</div>
		<h2>過去5年分の就職者情報</h2>
		<p>
			下記には、
			<?php
				$m = date('m');
				if($m < 4){
					echo date('Y')-1;
				}
				else if($m >= 4){
					echo date('Y');
				}
			?>
			年度より過去5年間のそれぞれの企業への就職者人数を表示しています。
		</p>
		<div　id = "table-01">
			<!-- 参考サイト：http://bashalog.c-brains.jp/08/06/13-165130.php -->
			<table id="table-02">
				<tr>
					<th>社名</th>
					<?php
						if(empty($_GET['business_type']) && !isset($_GET['business_type'])){
							echo "<th>職種</th>";
						}
					?>
					<th>就職者人数</th>
				</tr>
				<?php foreach($data as $data): ?>
					<tr class="datas">
						<td>
							<?php echo $data['company_name']; ?>
						</td>
						<?php if(empty($_GET['business_type']) && !isset($_GET['business_type'])): ?>
							<td>
								<?php echo $data['job_kind']; ?>
							</td>
						<?php endif; ?>
						<td>
							<?php
								$num = count_employer($data['5_ago']) +
									count_employer($data['4_ago']) +
									count_employer($data['3_ago']) +
									count_employer($data['2_ago']) +
									count_employer($data['last_year']);
								echo $num;
							?>
						</td>
					</tr>
				<?php endforeach; ?>
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
		<?php include('footer.php'); ?>
	</body>
</html>
