<!DOCTYPE html>
<!-- saved from url=(0046)http://1.wqing7.applinzi.com/wq/menu.php?act=& -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=8">
</head>
<body>
	
<div class="result-title">
    <div class="result-list">
    	<a href="index.php?r=reply/words"><i class="icon-font"></i>管理规则</a>
        <a href="index.php?r=reply/addwords"><i class="icon-font"></i>添加规则</a>       
    </div>
</div>
 <div class="search-wrap">
        <div class="search-content">
            <form action="" method="post">
                <table class="search-tab">
                    <tbody><tr>
                        
                        <th width="70">关键字:</th>
                        <td><input class="common-text" placeholder="关键字" name="keywords" id="" type="text"></td>
                        <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                    </tr>
                    </tbody></table>
            </form>
        </div>
    </div>
<div class="main">
	<div class="result-wrap">
		<div class="result-content">
		<table class="result-tab" width="80%" >
			<tr>
				<th>所属公众号</th>
				<th>规则名称</th>
				<th>关键字</th>
				<th>回　复</th>
				<th>操作</th>
			</tr>
			<?php foreach($arr as $v){
            ?>
			<tr class="control-group">
				<td><?=$v['aname']?></td>
				<td><?=$v['w_name']?></td>
				<td><?=$v['w_keywords']?></td>
				<td><?=$v['w_content']?></td>
				<td><span class="pull-right"><a href="index.php?r=reply/delwords&wid=<?php echo $v['wid']?>">删除</a></span></td>
			</tr>
			<?php
	        }
	        ?>
		</table>
     	</div>  
	</div>
</div>
</body>