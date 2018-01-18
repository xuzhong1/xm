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
<script type="../../public/text/javascript" src="js/Validform/Validform.min.js"></script>
<script type="../../public/text/javascript" src="js/jquery.cookie.js"></script>
<script src="../../public/js/shopFrame.js" type="text/javascript"></script>
<script src="../../public/js/Sellerber.js" type="text/javascript"></script>
<script src="../../public/js/layer/layer.js" type="text/javascript"></script>
<title>修改管理</title>
</head>
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>

	<?php
		$id=$_GET['id'];
		$sql="select * from adminusers where id={$id}";
		$result=mysqli_query($link,$sql);
		$stu=mysqli_fetch_assoc($result);
	
	?>
<div class="margin add_administrator" id="page_style">
    <div class="add_style add_administrator_style">
    <div class="title_name">修改管理</div>
    <form action="action.php?a=add" method="post" id="form-admin-add" enctype="multipart/form-data">
    <ul>
	
	<input type="hidden" class="input-text col-xs-12" value="<?php echo $stu['id'];?>" placeholder="" id="user-tel" name="id" datatype="m" >
     <li class="clearfix">
     <label class="label_name col-xs-2 col-lg-2"><i>*</i>用户名：</label>
     <div class="formControls col-xs-6">
     <input type="text" class="input-text col-xs-12" value="<?php echo $stu['username'];?>" placeholder="" id="user-name" name="username" datatype="*2-16" nullmsg="用户名不能为空"></div>
    <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
	
	

	 
	  <li class="clearfix">
 
     <div class="formControls col-xs-6">
     <input type="hidden" class="input-text col-xs-12" value="<?php echo $stu['pass'];?>" placeholder="" id="user-name" name="pass" datatype="*2-16" ></div>
    <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
     
 
     <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2" ><i class="c-red">*</i>手&nbsp;机：</label>
      <div class="formControls col-xs-6">
		<input type="text" class="input-text col-xs-12" value="<?php echo $stu['phone'];?>" placeholder="" id="user-tel" name="phone" datatype="m" nullmsg="手机不能为空">
	  </div>
	 <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
	 
     <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2"><i class="c-red">*</i>邮&nbsp;箱：</label>
      <div class="formControls col-xs-6">
		<input type="text" class="input-text col-xs-12" placeholder="@" name="email" value="<?php echo $stu['Email'];?>" id="email" datatype="e" nullmsg="请输入邮箱！">
	   </div>
		<div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
	 
	 <li class="clearfix">
      <label class="label_name col-xs-2 col-lg-2" ><i class="c-red">*</i>角&nbsp;色：</label>
      <div class="formControls col-xs-6">
		<input type="text" class="input-text col-xs-12" value="<?php echo $stu['role'];?>" placeholder="" id="user-tel" name="role" datatype="m" >
	  </div>
	 <div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
	 
	  <li class="clearfix">
  
      <div class="formControls col-xs-6">
		<input type="hidden" class="input-text col-xs-12" placeholder="@" name="state" value="<?php echo $stu['state'];?>" id="code" datatype="e" >
	   </div>
		<div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
	 
	 <li class="clearfix">
  
      <div class="formControls col-xs-6">
		<input type="hidden" class="input-text col-xs-12" placeholder="@" name="addtime" value="<?php echo $stu['addtime'];?>" id="code" datatype="e" >
	   </div>
		<div class="col-4"> <span class="Validform_checktip"></span></div>
     </li>
     
    
         <li class="clearfix">
			<div class="col-xs-2 col-lg-2">&nbsp;</div>
			<div class="col-xs-6">
	  <input class="btn button_btn bg-deep-blue " type="submit" id="Add_Administrator" value="提交注册">
      <input name="reset" type="reset" class="btn button_btn btn-gray" value="取消重置" />
      <a href="javascript:ovid()" onclick="javascript :history.back(-1);" class="btn btn-info button_btn"><i class="fa fa-reply"></i> 返回上一步</a>
			</div>
		</li>
    </ul>
    </form>
    </div>
    <div class="split_line"></div>
    <div class="Notice_style l_f">
      
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
//表单验证提交
$("#form-admin-add").Validform({		
		 tiptype:2,
		callback:function(data){
		//form[0].submit();
		if(data.status==1){ 
                layer.msg(data.info, {icon: data.status,time: 1000}, function(){ 
                    location.reload();//刷新页面 
                    });   
            } 
            else{ 
                layer.msg(data.info, {icon: data.status,time: 3000}); 
            } 		  
			var index =parent.$("#iframe").attr("src");
			parent.layer.close(index);
			//
		}				
	});
//字数限制
function checkLength(which) {
	var maxChars = 100; //
	if(which.value.length > maxChars){
	   layer.open({
	   icon:2,
	   title:'提示框',
	   content:'您输入的字数超过限制!',	
    });
		// 超过限制的字数了就将 文本框中的内容按规定的字数 截取
		which.value = which.value.substring(0,maxChars);
		return false;
	}else{
		var curr = maxChars - which.value.length; //250 减去 当前输入的
		document.getElementById("sy").innerHTML = curr.toString();
		return true;
	}
};	
</script>
