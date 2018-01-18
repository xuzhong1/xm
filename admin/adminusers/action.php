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
					$sql="delete from adminusers where id={$id}";
					
					if(mysqli_query($link,$sql)){
						echo "<h2>删除成功</h2>";
					}else{
						echo "<h2>删除失败</h2>";
					}
					
					
					break;
					
				
				
					case 'update':
					include("function.php");
					$id=$_POST['id'];
					$username=$_POST['username'];
					
					$pass=$_POST['pass'];
					
				
					
					$phone=$_POST['phone'];
					$email=$_POST['email'];
					$state=$_POST['state'];
					$addtime=$_POST['addtime'];
					$role=$_POST['role'];
					
					$sql="update adminusers set  username='{$username}',phone={$phone},email='{$email}',role={$role} where id={$id}";
					//die($sql);
					if(mysqli_query($link,$sql)){
						echo "修改成功";
					}else{
						echo "修改失败";
					}
					break;
					
					
					case 'add':
					
					include("function.php");
					$id=$_POST['id'];
					$name=$_POST['username'];
					//$sex=$_POST['sex'];
					$pass=$_POST['userpassword'];
					$phone=$_POST['phone'];
					$email=$_POST['email'];
					//$img=$_FILES['img'];
					//var_dump($img);
					$img=suoimg($_FILES['img']['tmp_name'],50,"images");
					$image=uploads($_FILES['img'],"./images",["jpg","png","gif"]);
					$date=time(); 

				
				
				
				
					$sql="insert into adminusers (id,img,image,username,pass,phone,email,addtime) values (id,'{$img}','{$image}','{$name}',{$pass},{$phone},'{$email}',{$date})";
					//die($sql);
					if(mysqli_query($link,$sql)){
						echo "<h2>添加成功</h2>";
					}else{
						echo "<h2>添加失败</h2>";
					}
					
						
					break;
					
					
					case "updateimg":
						include("function.php");
						$id=$_POST['id'];
						$img1=$_POST['img1'];
						$image1=$_POST['image1'];
						$img=suoimg($_FILES['img']['tmp_name'],50,"images");
						$image=uploads($_FILES['img'],"./images",["jpg","png","gif"]);
						$sql="update adminusers set img='{$img}',image='{$image}' where id={$id}";
						mysqli_query($link,$sql);
						$rows = mysqli_affected_rows($link);
						if($rows){
								echo "<h2>更新成功</h2>";
								if (file_exists($img1)) {
									//删除原头像
									unlink($img1);
									//echo "111";
								}
								if (file_exists($image1)) {
									//删除原头像原图
									unlink($image1);
								}
								
							}else{
								echo "<h2>更新失败</h2>";
							}
				
					break;
				}
				//关闭数据库连接
				mysqli_close($link);
			
			
			?>
			
		</center>
	</body>
</html>