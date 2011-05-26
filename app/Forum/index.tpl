<!DOCTYPE html>
<html>
	<head>
		<title>Windowpane</title>
		<meta http-equiv="Content-Type" content="text/html; charset="UTF-8"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js"></script>
		<!-- <script type="text/javascript" src="public/theme/expression/scripts/clouds.js" charset="utf-8"></script> -->
		<link id="basic-css" rel="stylesheet" type="text/css" href="public/less.php?default.less">
		<link id="theme-css" rel="stylesheet" type="text/css" href="public/less.php?theme/expression/style.less">
	</head>
		<body>
		<div class="headerbar">
			<div class="headerbar_overlay"></div>
			<h1><?php echo "$title"; ?></h1>
		</div>
		<div style="margin-top:150px;"></div>
		<!-- Main Column -->
		<?php ?>
		<div>
			<table width="100%">
				<tbody>
					<tr>
					</tr>
				</tbody>
			</table>
			<div id="windowpane-content">
				<pre><?php echo Print_r(Windowpane::GetUserPlatform(),true); ?></pre>
				<?php echo $content ?>
			</div>
		</div>
	</body>
</html>