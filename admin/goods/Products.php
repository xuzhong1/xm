<?php
	include("../../public/config.php");
	//连接数据库
	$link=mysqli_connect(HOST,USER,PASS)or die("数据库连接失败：".mysqli_connert_error());
	//选择数据库
	mysqli_select_db($link,DBNAME);
	//设置字符集
	mysqli_set_charset($link,"utf8");
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../../public/css/shop.css" type="text/css" rel="stylesheet" />
<link href="../../public/css/Sellerber.css" type="text/css"  rel="stylesheet" />
<link href="../../public/css/bkg_ui.css" type="text/css"  rel="stylesheet" />
<link href="../../public/font/css/font-awesome.min.css"  rel="stylesheet" type="text/css" />
<script src="../../public/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../../public/js/jquery.cookie.js"></script>
<script src="../../public/js/shopFrame.js" type="text/javascript"></script>
<script src="../../public/js/Sellerber.js" type="text/javascript"></script>
<script src="../../public/js/layer/layer.js" type="text/javascript"></script>
<script src="../../public/js/laydate/laydate.js" type="text/javascript"></script>
<title>会员管理</title>
</head>
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>
<div class="margin" id="page_style">
   <div class="operation clearfix">
    <ul class="choice_search">
     <li class="clearfix col-xs-2 col-lg-2 col-ms-3 "><label class="label_name ">会员名称：</label><input name="" type="text"  class="form-control col-xs-6 col-lg-5"/></li>
      <li class="clearfix col-xs-4 col-lg-5 col-ms-5 "><label class="label_name ">注册时间：</label> 
     <input class="laydate-icon col-xs-4 col-lg-3" id="start" style=" margin-right:10px; height:28px; line-height:28px; float:left">
      <span  style=" float:left; padding:0px 10px; line-height:32px;">至</span>
      <input class="laydate-icon col-xs-4 col-lg-3" id="end" style="height:28px; line-height:28px; float:left"></li>
     <button class="btn button_btn bg-deep-blue " onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;搜索</button>
    </ul>
    </div>
<div class="bkg_List_style">
 <div class="bkg_List_operation clearfix">
  <ul class="bkg_List_Button_operation">
  
  <!-- <li class="btn bg-deep-blue"><a href="add.php" class="btn_add"><em class="bkg_List_icon icon_delete"></em>添加用户</a></li>-->
  
  </ul>
 </div>
 <div class="bkg_List clearfix">
  <table class="table  table_list table_striped table-bordered">
   <thead>
    <tr>
     <th  width="40"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
     <th>用户名</th>
     <th>真实姓名</th>
     
     <th>性别</th>
     <th>地址</th>
     <th>邮编</th>
     <th>电话</th>
     <th>Email</th>
     <th>状态</th>
	 <th>注册时间</th>
	 <th>操作</th>
    </tr>
   </thead>
   <?php
		$sql="select * from users";
		$result=mysqli_query($link,$sql);
		while($stu=mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>{$stu['id']}</td>";
			echo " <td>{$stu['username']}</td>";
			echo "<td>{$stu['name']}</td>";
			echo "<td>";
			 if($stu['sex']=='m'){
				echo "男";
			}else{
				echo "女";
			}
			echo "</td>";
			echo "<td>{$stu['address']}</td>";
			echo "<td>{$stu['code']}</td>";
			echo " <td>{$stu['phone']}</td>";
			echo " <td>{$stu['email']} </td>";
			echo "<td>{$stu['state']}</td>";
			echo "<td>{$stu['addtime']}</td>";
			echo "<td>";
                 echo "<a title='编辑' onclick='Competence_modify('560')' href='update.php?id={$stu['id']}' class='btn button_btn bg-deep-blue'>编辑</a>";        
                 echo "<a title='删除' href='action.php?a=del&id={$stu['id']}' onclick='Competence_del(this,'1')' class='btn button_btn btn-danger'>删除</a>";
			echo "</td>";
			echo "</tr>";

			
	}
				
				//释放结果集
					mysqli_free_result($result);

					//关闭数据库连接
					mysqli_close($link);				
		
   ?>
   
<!--   <tbody>
    <tr>
     <td><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
     <td>汇海天堂</td>
     <td>张明珠</td>
     <td>男</td>
     <td>1345665656</td>
     <td>4545455@qq.com</td>
     <td>江苏南京雨花台区</td>
     <td>2016-07-22 </td>
     <td>普通用户</td>
     <td>启用</td>
    </tr>
   </tbody>-->
  </table>
 </div>
</div>
</div>
</body>
</html>
<script>
/*******滚动条*******/
$("body").niceScroll({  
	cursorcolor:"#888888",  
	cursoropacitymax:1,  
	touchbehavior:false,  
	cursorwidth:"5px",  
	cursorborder:"0",  
	cursorborderradius:"5px"  
});
/******时间设置*******/
  var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
   // min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY-MM-DD', 
    //min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);
/********************列表操作js******************/
$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
</script>
