<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
		<link id="basic-css" rel="stylesheet" type="text/css" href="public/less.php?default.less">
		<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
		<style>
			body
			{
				margin: 0;
				font-family: 'Ubuntu', serif;
				background: #FAFAFA;
				width: 100%;
				height: 100%;
			}
			h1
			{
				margin: 0;
				padding: 10px 20px;
			}
			h3
			{
				margin: 0;
			}
			p
			{
				color: #FFD7BE;
				padding: 20px;
				margin: 0;
			}
			a
			{
				text-decoration: none;
				color: #CFCB73;
				-webkit-transition: all 0.25s linear;
			}
			a:hover
			{
				text-decoration: none;
				color: #A65656;
				/*padding-left: 10px;*/
				-webkit-transition: all 0.25s linear;
			}
			.inside
			{
				margin: 0;
				height:100%;
			}
			.settings
			{
				float:left;
				vertical-align: top;
				text-align: left;
				position: fixed;
				top: 50px;
				left: 250px;
				right: 0px;
				border: 1px solid rgba(204,204,204,0.75);
				background-image: -webkit-gradient(
				    linear,
				    left bottom,
				    left top,
				    color-stop(0.03, rgba(204,204,204,0.5)),
				    color-stop(0.89, rgba(238,238,238,0.5))
				);
				padding: 10px;
				height: 100%;
			}
			.settings_bottombar
			{
				position: fixed;
				height: 50px;
				top: 0px;
				left: 0px;
				right: 0px;
				background-image: url('public/theme/expression/images/bar_noise.png');
			}
			.settings_bottombar > #gradient_overlay
			{
				position: fixed;
				height: 50px;
				top: 0px;
				left: 0px;
				right: 0px;
				border: 1px solid rgba(204,204,204,0.75);
				background-image: -webkit-gradient(
				    linear,
				    left bottom,
				    left top,
				    color-stop(0.03, rgba(204,204,204,0.5)),
				    color-stop(0.89, rgba(238,238,238,0.5))
				);
				background-image: -moz-linear-gradient(
				    center bottom,
				    rgba(170,170,170,0.75) 3%,
				    rgba(236,236,236,0.75) 89%
				);
			}
			.setting_group
			{
				width:100%;
			}
			.admin_links
			{
				float:left;
				vertical-align: top;
				width: 10%;
				margin: 60px 0 0 10px;
				top: 50px;
				bottom: 0px;
				/*margin: 0px;
				padding: 20px;*/
			}
		</style>
		<title>
			Windowpane - Admin Control Panel
		</title>
		<script>
		$(document).ready(function(){
			$('.clickable').click(function () {
				var viewable_element = $('.setting_groups').find('#'+$(this).attr('name'));
				viewable_element.siblings().hide();
				viewable_element.fadeIn(300);
				return true;
			});
		});
		</script>
	</head>
	<body>
		<div class="admin_links">
			<a name="settings" class="clickable" href="#"><b>Settings</b></a><br>
			<a name="themes" class="clickable" href="#"><b>Themes</b></a><br>
			<a name="applications" class="clickable" href="#"><b>Applications</b></a><br>
			<a name="data" class="clickable" href="#"><b>Data</b></a><br>
			<a name="templates" class="clickable" href="#"><b>Templates</b></a><br>
			<a name="plugins" class="clickable" href="#"><b>Plugins</b></a>
		</div>
		<div class="settings">
			<h1 id="admin_control_panel">Admin Control Panel</h1>
			<div class="settings_bottombar">
				<div id="gradient_overlay">
					<div class="aspen" name="button">Pooop</div>
				</div>
			</div>
			<div class="setting_groups">
				<div class="setting_group" id="settings" style="z-index: 1;">
					<h3>Settings</h3>
					<p></p>
				</div>
				<div class="setting_group" id="themes" style="z-index: 2; display:none;">
					<h3>Themes</h3>
					<p></p>
				</div>
				<div class="setting_group" id="applications" style="z-index: 3; display:none;">
					<h3>Applications</h3>
					<p></p>
				</div>
				<div class="setting_group"id="data" style="z-index: 4; display:none;">
					<h3>Data</h3>
					<p></p>
				</div>
				<div class="setting_group" id="templates" style="z-index: 5; display:none;">
					<h3>Templates</h3>
					<p></p>
				</div>
				<div class="setting_group" id="plugins" style="z-index: 6; display:none;">
					<h3>Plugins</h3>
					<p></p>
				</div>
			</div>
		</div>
	</body>
</html>
