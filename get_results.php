<?php
$q = strval($_GET['q']);
$limit = 10;
$dbconn = pg_connect("host = 127.0.0.1 port = 5439 user = dsuser dbname = brandbattle password = Jjnlsf9hXd");
//echo "SELECT * FROM bvproduct WHERE clientname = '".$q."'";

$query = "SELECT * FROM productranking WHERE ";

$searchTerms = explode(" ", $q);

$counter = 0;
foreach($searchTerms as $term){
	if ($counter >0 )
		$query.=" AND ";
	$query .= " (LOWER(competitivesetname) LIKE LOWER('%".$term."%') OR LOWER(description) LIKE LOWER('%".$term."%') OR LOWER(name) LIKE LOWER('%".$term."%'))";
	$counter++;
}

$query.=  " ORDER BY avgrating DESC, numreviews DESC, recommendcount DESC, notrecommendcount ASC, views DESC LIMIT 10 ";

//echo $query;

$allproducts = pg_query($dbconn, $query);
$num_rows = pg_num_rows($allproducts);

for ($i = 0; $i < $num_rows; $i++){
$row = pg_fetch_array($allproducts, $i);

echo '<div class = "result-pane">
	<div class = "rank-panel">
		<p class = "rank">#'.($i+1).'</p>
	</div>
	<div class = "title-thumbnail-panel">
	<p class = "writing">
		Product Name: '.$row[1].' <br>
		Description: '.$row[2].'
	</p>
	</div>
	<div class = "information-panel">
		Rating: '.$row[3].' <br>
		# Reviews: '.$row[4].'<br>
		# Recommends: '.$row[5].'
	</div>
</div>';
}


//$row = $pg_fetch_array($result, 0);
//var_dump(debug_backtrace());

/*$con = mysqli_connect('localhost','peter','abc123','my_db');
if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"ajax_demo");
$sql="SELECT * FROM user WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

for ($i = 1; $i < $limit; $i++){
$row = pg_fetch_array($ids, $i);

$product = pg_query($dbconn, "SELECT * FROM product WHERE upi = '".$row[0]."'");
$views = pg_query($dbconn, "SELECT * FROM productpageviewstats WHERE upi = '".$row[0]."'");
$view = pg_fetch_array($views, 0);
$name = pg_fetch_array($product, 0);

echo '<div class = "result-pane">
	<div class = "rank-panel">
		<p class = "rank">#'.$i.'</p>
	</div>
	<div class = "title-thumbnail-panel">
		Product ID: '.$row[0].' <br>
		Product Name: '.$name[1].' <br>
		Daily Product Views: '.$view[2].'
	</div>
	<div class = "information-panel">Rating: '.$row[3].'</div>
</div>';
}

//echo 'done';


//mysqli_close($con);
/*for ($i = 1; $i < 100; $i++){
	$row = pg_fetch_array($result, $i);
	echo $row[0];
	echo '<br>';
}*/



?>