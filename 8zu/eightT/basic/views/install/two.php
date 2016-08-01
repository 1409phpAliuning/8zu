<!DOCTYPE html>
<!-- saved from url=(0039)http://127.0.0.1/wq/install.php?refresh -->
<html lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>安装系统 - EightT - 公众平台自助开源引擎</title>
		<link rel="stylesheet" href="./public/css/css/bootstrap.min.css">
		<style>
			html,body{font-size:13px;font-family:"Microsoft YaHei UI", "微软雅黑", "宋体";}
			.pager li.previous a{margin-right:10px;}
			.header a{color:#FFF;}
			.header a:hover{color:#428bca;}
			.footer{padding:10px;}
			.footer a,.footer{color:#eee;font-size:14px;line-height:25px;}
		</style>
		<!--[if lt IE 9]>
		  <script src="./assets/css/html5shiv.min.js"></script>
		  <script src="./assets/css/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="background-color:#28b0e4;">
		<div class="container">
			<div class="header" style="margin:15px auto;">
				<ul class="nav nav-pills pull-right" role="tablist">
					<li role="presentation" class="active"><a href="javascript:;">安装EightT系统</a></li>
					<li role="presentation"><a href="http://www.we7.cc/">EightT官网</a></li>
					<li role="presentation"><a href="http://bbs.we7.cc/">访问论坛</a></li>
				</ul>
				<img src="./public/css/css/install.php">
			</div>
			<div class="row well" style="margin:auto 0;">
				<div class="col-xs-3">
					<div class="progress" title="安装进度">
						<div class="progress-bar progress-bar-info progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
							50%
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							安装步骤
						</div>
						<ul class="list-group">
							<a href="javascript:;" class="list-group-item list-group-item-success"><span class="glyphicon glyphicon-copyright-mark"></span> &nbsp; 许可协议</a>
							<a href="javascript:;" class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-eye-open"></span> &nbsp; 环境监测</a>
							<a href="javascript:;" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> &nbsp; 参数配置</a>
							<a href="javascript:;" class="list-group-item"><span class="glyphicon glyphicon-ok"></span> &nbsp; 成功</a>
						</ul>
					</div>
				</div>
				<div class="col-xs-9">
							<div class="panel panel-default">
			<div class="panel-heading">服务器信息</div>
			<table class="table table-striped">
				<tbody><tr>
					<th style="width:150px;">参数</th>
					<th>值</th>
					<th></th>
				</tr>
				<tr class="warning">
					<td>服务器操作系统</td>
					<td><?= $arr['system'] ?></td>
					<td>建议使用 Linux 系统以提升程序性能</td>
				</tr>
				<tr class="">
					<td>Web服务器环境</td>
					<td><?= $_SERVER['SERVER_SOFTWARE']?></td>
					<td></td>
				</tr>
				<tr class="">
					<td>PHP版本</td>
					<td><?= $arr['php_edition']?></td>
					<td></td>
				</tr>
				<tr class="">
					<td>程序安装目录</td>
					<td><?= $arr['path']?></td>
					<td></td>
				</tr>
				<tr class="">
					<td>上传限制</td>
					<td><?=$arr['path_max']?>M</td>
					<td></td>
				</tr>
			</tbody></table>
		</div>

		<div class="alert alert-info">PHP环境要求必须满足下列所有条件，否则系统或系统部份功能将无法使用。</div>
		<div class="panel panel-default">
			<div class="panel-heading">PHP环境要求</div>
			<table class="table table-striped">
				<tbody><tr>
					<th style="width:150px;">选项</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="success">
					<td>PHP版本</td>
					<td>5.4或者5.4以上</td>
					<td><?php if (version_compare("5.4", PHP_VERSION, "<")) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>MySQL</td>
					<td>支持(建议支持PDO)</td>
					<td><?php if (extension_loaded('mysql')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></span></td>
					<td rowspan="2"></td>
				</tr>
				<tr class="success">
					<td>PDO_MYSQL</td>
					<td>支持(强烈建议支持)</td>
					<td><?php if (extension_loaded('PDO_MYSQL')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
				</tr>
				<!--<tr class="success">
					<td>allow_url_fopen</td>
					<td>支持(建议支持cURL)</td>
					<td><?php /*if (@fopen('http://127.0.0.1/dwzchd/list.php','r')) {
                            echo '<span class="glyphicon glyphicon-ok text-success"></td>';
                        }else{
                            echo '<span class="glyphicon glyphicon-remove text-warning"></td>';
                        }
                        */?></td>
					<td rowspan="2"></td>
				</tr>-->
				<tr class="success">
					<td>cURL</td>
					<td>支持(强烈建议支持)</td>
					<td><?php if (extension_loaded('curl')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
                    <td></td>
				</tr>
				<tr class="success">
					<td>openSSL</td>
					<td>支持</td>
					<td><?php if (extension_loaded('openSSL')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>GD2</td>
					<td>支持</td>
					<td><?php if (extension_loaded('gd')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>DOM</td>
					<td>支持</td>
					<td><?php if (extension_loaded('dom')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>session.auto_start</td>
					<td>关闭</td>
					<td><?php if (!extension_loaded('session.auto_start')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>asp_tags</td>
					<td>关闭</td>
					<td><?php if (!extension_loaded('ASP')) {
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
			</tbody></table>
		</div>

		<div class="alert alert-info">系统要求EightT整个安装目录必须可写, 才能使用EightT所有功能。</div>
		<div class="panel panel-default">
			<div class="panel-heading">目录权限监测</div>
			<table class="table table-striped">
				<tbody><tr>
					<th style="width:150px;">目录</th>
					<th style="width:180px;">要求</th>
					<th style="width:50px;">状态</th>
					<th>说明及帮助</th>
				</tr>
				<tr class="success">
					<td>/</td>
					<td>整目录可写</td>
					<td><?php if (@file_put_contents('../a.txt','456')) {
                            //unlink('/a.txt');
                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
				<tr class="success">
					<td>/</td>
					<td>data目录可写</td>
					<td><?php if (@file_put_contents('../config/a.txt','123')) {

                            echo '<span class="" style="color: #008000">√</td>';
                        }else{
                            echo '<span class=""  style="color:red">×</td>';
                        }
                        ?></td>
					<td></td>
				</tr>
			</tbody></table>
		</div>
		<form class="form-inline" role="form" method="post" action="index.php?r=install/three">
			<input type="hidden" name="do" id="do">
			<ul class="pager">
				<li class="previous"><a href="javascript:;" onclick="$(&#39;#do&#39;).val(&#39;back&#39;);$(&#39;form&#39;)[0].submit();"><span class="glyphicon glyphicon-chevron-left"></span> 返回</a></li>
				<li class="previous"><a href="javascript:;" onclick="$(&#39;#do&#39;).val(&#39;continue&#39;);$(&#39;form&#39;)[0].submit();">继续 <span class="glyphicon glyphicon-chevron-right"></span></a></li>
                        </ul>

		</form>
				</div>
			</div>
			<div class="footer" style="margin:15px auto;">
				<div class="text-center">
					<a href="http://www.we7.cc/">关于EightT</a> &nbsp; &nbsp; <a href="http://bbs.we7.cc/">EightT帮助</a> &nbsp; &nbsp; <a href="http://www.we7.cc/">购买授权</a>
				</div>
				<div class="text-center">
					Powered by <a href="http://www.we7.cc/"><b>EightT</b></a> v0.7 © 2014 <a href="http://www.we7.cc/">www.we7.cc</a>
				</div>
			</div>
		</div>
		<script src="./public/css/css/jquery.min.js"></script>
		<script src="./public/css/css/bootstrap.min.js"></script>

</body></html>