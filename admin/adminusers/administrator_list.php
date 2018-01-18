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
<link rel="stylesheet" type="text/css" href="../../public/css/bootstrap.min.css">
<script src="../../public/js/jquery-1.9.1.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="../../public/js/jquery.cookie.js"></script>
<script src="../../public/js/shopFrame.js" type="text/javascript"></script>
<script src="../../public/js/Sellerber.js" type="text/javascript"></script>
<script src="../../public/js/layer/layer.js" type="text/javascript"></script>
<script src="../../public/js/jquery.dataTables.min.js"></script>
<script src="../../public/js/jquery.dataTables.bootstrap.js"></script>
<title>管理员列表</title>
</head>
<!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <script src="js/css3-mediaqueries.js"  type="text/javascript"></script>
  <![endif]-->
<body>
<div class="margin Competence_style" id="page_style">
    <div class="operation clearfix">

<a href="add.php"  class="btn button_btn bg-deep-blue" title="添加管理员"><i class="fa  fa-edit"></i>&nbsp;添加管理员</a>
  <select class="select Competence_sort" name="admin-role" size="1" id="Competence_sort">
					<option value="0">--选择分类--</option>
					<option value="1">超级管理员</option>
					<option value="2">普通管理员</option>
					<option value="3">栏目编辑</option>
				</select>
   <div class="search  clearfix">

   <input name="" type="text"  class="form-control col-xs-8"/><button class="btn button_btn bg-deep-blue " onclick=""  type="button"><i class="fa  fa-search"></i>&nbsp;搜索</button>
</div>
</div>
<div class="compete_list">
       <table id="sample_table" class="table table_list table_striped table-bordered dataTable no-footer">
		 <thead>
			<tr>
			  <th class="">id</th>
			   <th>头像</th>
			  <th>登录名</th>
			  <th>手机</th>
              <th>邮箱</th>
              <th>角色</th>
			  <th class="">加入时间</th>  
              <th>状态</th>         
			  <th class="">操作</th>
             </tr>
		    </thead>
			
			
		<?php
		$sql="select * from adminusers";
		$result=mysqli_query($link,$sql);
		
		//获取表中的数据数量
			$num=mysqli_num_rows($result);
		//每页的数量
			$pagesize=3;
		//查看当前是第几页
			$page=isset($_GET['page'])?$_GET['page']:1;
		//获取最大的页数
			$bag=ceil($num/$pagesize);
		
		if($page>$bag){
			$page=$bag;
		}
		if($page<1){
			$page=1;
		}
		
		
		$limit = ($page-1)*$pagesize;
		$sql = "select * from adminusers  limit {$limit},{$pagesize}";
			
		//执行sql语句
		$result = mysqli_query($link,$sql);
			
		
		while($stu=mysqli_fetch_assoc($result)){
			echo "<tr>";
			echo "<td>{$stu['id']}</td>";
			echo "<td><a href='updateimg.php?id={$stu['id']}&img1={$stu['img']}&image1={$stu['image']}'><img src='{$stu['img']}'></a></td>";
			echo " <td>{$stu['username']}</td>";
			echo "<td>{$stu['phone']}</td>";
			echo "<td>{$stu['Email']}</td>";
			echo "<td>";
			 if($stu['role']=='1'){
				echo "超级管理员";
			}else if($stu['role']=='2'){
				echo "普通管理员";
			}else{
				echo "黑名单";
			}
			echo "</td>";
			
			$a=date('Y-m-d H:i:s',$stu['addtime']);
			echo " <td>$a</td>";
			echo "<td class='td-status'>";
			
				echo "<span class='label label-success label-sm'>已启用</span>";
				
			echo "</td>";
		
			
			echo "<td class='td-manage'>";
				echo "<a title='停用' onclick='Competence_close(this,'12')' href='javascript:;' class='btn button_btn btn-Dark-success'>停用</a> ";
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
	
			
			
			
             <!-- <tbody>
			  <tr>
				<td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
				<td>admin123456</td>
				<td>13567878908</td>
				<td >3456778@qq.com</td>
				<td>超级管理员</td>
                <td>2016-9-20 10:23:23</td>
                <td class="td-status"><span class="label label-success label-sm">已启用</span></td>
				<td class="td-manage">
                 <a title="停用" onclick="Competence_close(this,'12')" href="javascript:;" class="btn button_btn btn-Dark-success">停用</a> 
                 <a title="编辑" onclick="Competence_modify('560')" href="javascript:;" class="btn button_btn bg-deep-blue">编辑</a>        
                 <a title="删除" href="javascript:;" onclick="Competence_del(this,'1')" class="btn button_btn btn-danger">删除</a>
                 
				</td>
			   </tr>
               <tr>
				<td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
				<td>化海天堂</td>
				<td>13567878908</td>
				<td >3456778@qq.com</td>
				<td>普通管理员</td>
                <td>2016-9-20 10:23:23</td>
                <td class="td-status"><span class="label label-success label-sm">已启用</span></td>
				<td class="td-manage">
                  <a title="停用" onclick="Competence_close(this,'12')" href="javascript:;" class="btn button_btn btn-Dark-success">停用</a> 
                 <a title="编辑" onclick="Competence_modify('560')" href="javascript:;" class="btn button_btn bg-deep-blue">编辑</a>        
                 <a title="删除" href="javascript:;" onclick="Competence_del(this,'1')" class="btn button_btn btn-danger">删除</a>
                 
				</td>
			   </tr>
               <tr>
				<td class="center"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></td>
				<td>admin</td>
				<td>13567878908</td>
				<td >3456778@qq.com</td>
				<td>普通管理员</td>
                <td>2016-9-10 10:23:23</td>
                <td class="td-status"><span class="label label-success label-sm">已启用</span></td>
				<td class="td-manage">
                   <a title="停用" onclick="Competence_close(this,'12')" href="javascript:;" class="btn button_btn btn-Dark-success">停用</a> 
                 <a title="编辑" onclick="Competence_modify('560')" href="javascript:;" class="btn button_btn bg-deep-blue">编辑</a>        
                 <a title="删除" href="javascript:;" onclick="Competence_del(this,'1')" class="btn button_btn btn-danger">删除</a>
                
				</td>
			   </tr>												
		      </tbody> -->
	        </table>
			
			

		<?php
				echo "<nav aria-label='Page navigation'>";
				echo "<ul class='pager'>";
				$ss=<<<EOF
				
				<li><a href='administrator_list.php?page=1'>
					<span aria-hidden="true">&laquo;</span>
				</a></li>
EOF;
				echo $ss;
				echo "<li><a href='administrator_list.php?page=1'>首页</a></li>";
				$uppage=$page-1;
				echo "<li><a href='administrator_list.php?page={$uppage}'>上一页</a></li> ";
				$nextpage=$page+1;
				echo "<li><a href='administrator_list.php?page={$nextpage}'>下一页</a></li> ";
				
				echo "<li>";
				echo "<a href='administrator_list.php?page={$bag}'>";
				echo "<span aria-hidden='true'>&raquo;</span>";
				echo "</a>";
				echo "</li>";
			
			
				
				echo "</ul>";
				echo "<li>当前是{$page}页，一共有{$bag}页</li>";
				echo "</nav>";
				
			?>	
			
			
     </div>
</div>
</body>
</html>
<script>
$(function(){
	$("#Competence_sort").click(function(){
		var option=$(this).find("option:selected").text();
		var value=$(this).val();
		if(value==0){
			  
			$("#sample_table tbody tr").show()
			}
			else{
		$("#sample_table tbody tr").hide().filter(":contains('"+(option)+"')").show();	
			}
		}).click();	
	});

/*******滚动条*******/
$("body").niceScroll({  
	cursorcolor:"#888888",  
	cursoropacitymax:1,  
	touchbehavior:false,  
	cursorwidth:"5px",  
	cursorborder:"0",  
	cursorborderradius:"5px"  
});
/*管理员-停用*/
function Competence_close(obj,id){
	layer.confirm('确认要停用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn button_btn btn-gray" onClick="Competence_start(this,id)" href="javascript:;" title="启用">启用</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success label-sm">已停用</span>');
		$(obj).remove();
		layer.msg('已停用!',{icon: 5,time:1000});
	});
}

/*管理员-启用*/
function Competence_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		$(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn button_btn  btn-Dark-success" onClick="Competence_close(this,id)" href="javascript:;" title="停用">停用</a>');
		$(obj).parents("tr").find(".td-status").html('<span class="label label-success label-sm">已启用</span>');
		$(obj).remove();
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
/****复选框选中******/
$('table th input:checkbox').on('click' , function(){
					var that = this;
					$(this).closest('table').find('tr > td:first-child input:checkbox')
					.each(function(){
						this.checked = that.checked;
						$(this).closest('tr').toggleClass('selected');
					});
						
				});
</script>
