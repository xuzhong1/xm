<?php
	include("../../public/config.php");
	//连接数据库
	$link=mysqli_connect(HOST,USER,PASS)or die("数据库连接失败：".mysqli_connert_error());
	//选择数据库
	mysqli_select_db($link,DBNAME);
	//设置字符集
	mysqli_set_charset($link,"utf8");
	
?>
<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
	</head>
	<body>
		<center>	
			<?php
				
				switch($_REQUEST['a']){
					case 'del':
					$id=$_GET['id'];
					$sql="delete from users where id={$id}";
					
					if(mysqli_query($link,$sql)){
						echo "<h2>删除成功</h2>";
					}else{
						echo "<h2>删除失败</h2>";
					}
					
					break;
					
				
				
					case 'update':
					$id=$_POST['id'];
					$username=$_POST['username'];
					$name=$_POST['name'];
					$pass=$_POST['pass'];
					$sex=$_POST['sex'];
					$address=$_POST['address'];
					$code=$_POST['code'];
					$phone=$_POST['phone'];
					$email=$_POST['email'];
					$state=$_POST['state'];
					$addtime=$_POST['addtime'];
					
					$sql="update users set username='{$username}',name='{$name}',sex='{$sex}',address='{$address}',code={$code},phone={$phone},email='{$email}' where id={$id}";
					//die($sql);
					if(mysqli_query($link,$sql)){
						echo "修改成功";
					}else{
						echo "修改失败";
					}
					break;
				}
				//关闭数据库连接
				mysqli_close($link);
			
			
			?>
			
		</center>
	</body>
</html>