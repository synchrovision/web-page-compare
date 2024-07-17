<?php
chdir(__DIR__);
if(php_sapi_name()==='cli'){
	passthru('php -S localhost:8001 main.php & open http://localhost:8001/');
	return;
}
if($_SERVER['REQUEST_URI']!=='/'){
	return false;
}
$data=[];
$csv=fopen('urls.csv','r');
while($row=fgetcsv($csv)){
	$data['list'][]=$row;
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"> 
<title>Web Page Compare</title>
<link rel="stylesheet" href="style.css"/>
<script>
(cb=>document.readyState!=='loading'?cb():document.addEventListener('DOMContentLoaded',cb))(()=>{
	document.querySelectorAll('.wpc-app>.header>.rows>.row').forEach((row)=>{
		row.addEventListener('click',()=>row.classList.add('-clicked'));
	});
	
});
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>
	<div class="wpc-app">
		<div class="header">
			<ul class="rows">
				<?php foreach($data['list'] as $i=>$item): ?>
				<li class="row">
					<a target="screen1" href="<?=$item[0]?>" class="link"><?=$item[0]?></a>
					<a target="_blank" href="<?=$item[0]?>" class="open"><span class="material-symbols-outlined">ungroup</span></a>
					<a target="screen2" href="<?=$item[1]?>" class="link"><?=$item[1]?></a>
					<a target="_blank" href="<?=$item[1]?>" class="open"><span class="material-symbols-outlined">ungroup</span></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<div class="cols">
			<div class="col">
				<iframe src="<?=$data['list'][0][0]?>" name="screen1" frameborder="0" class="screen"></iframe>
			</div>
			<div class="col">
				<iframe src="<?=$data['list'][0][1]?>" name="screen2" frameborder="0" class="screen"></iframe>
			</div>
		</div>
	</div>
</body>
</html>