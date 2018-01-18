<?php
	header("content-type:text/html;charset=utf-8");

	/**
		*实现图片缩放
		*@param string $img 用户上传的图片
		*@param int $size 设置缩小后的尺寸
		*@param string $path 设置缩小后的图像要储存的路径
		*@return int 1表示成功 0表示失败 
	**/

	function suoimg($img,$size=400,$path){

		//获取上传图片的信息
		$info = getimagesize($img);

		//判断文件类型
		switch($info[2]){
			case 1:$im1 = imagecreatefromgif($img);break;
			case 2:$im1 = imagecreatefromjpeg($img);break;
			case 3:$im1 = imagecreatefrompng($img);break;
			default:die("格式错误！");break;
		}

		//指定图片的大小
		if ($info[0] > $info[1]) {
			$width = $size;
			$hight = $info[1] * ($size/$info[0]);
		}else{
			$hight = $size;
			$width = $info[0] * ($size/$info[1]);
		}

		// 创建一个画布
		$im2 = imagecreatetruecolor($width, $hight);

		//实现缩放
		imagecopyresampled($im2, $im1, 0, 0, 0, 0, $width, $hight, $info[0], $info[1]);

		//生成随机名
		$name = time().mt_rand(100000,999999);

		//输出图像
		$result = imagepng($im2,"./{$path}/{$name}.png");

		//释放资源
		imagedestroy($im1);
		imagedestroy($im2);

		//判断输出成功与否
		if ($result) {
			return "./{$path}/{$name}.png";
		}else{
			return "0";
		}
	}

	//suoimg($_FILES['file']['tmp_name'],$_POST['num'],"admin");

	/**
		*实现单文件上传
		*@param string $uploads 用户上传的文件
		*@param string $path 设置文件的储存路径
		*@param array $type 设置允许上传的文件类型
		*@return string 上传结果 
	**/
	
	function uploads($uploads,$path,$type){
		//判断文件上传是否有错误
		if ($uploads['error']>0) {
			switch ($uploads['error']) {
				case '1':
						echo "表示上传文件的大小超出了约定值。";
					break;
				case '2':
						echo "表示上传文件大小超出了HTML表单隐藏域属性的MAX＿FILE＿SIZE元素所指定的最大值。";
					break;
				case '3':
						echo "表示文件只被部分上传。";
					break;
				case '4':
						echo "表示没有上传任何文件。";
					break;
				case '6':
						echo "表示找不到临时文件夹。";
					break;
				case '7':
						echo "表示文件写入失败。";
					break;
				
				default:
						echo "未知错误";
					break;
			}
			exit;
		}

		//判断文件的上传大小
		if ($uploads['size']>$_POST['MAX_FILE_SIZE']) {
			die("表示上传文件的大小超出了约定值。");
		}

		//判断文件类型
		$arr = pathinfo($uploads['name']);
		$hz = $arr['extension'];
		if (!in_array($hz, $type)) {
			die("文件格式不支持");
		}

		//上传后的文件名
		$path = rtrim($path,"/")."/";
		$srcname = $path.time().mt_rand(100000,999999).".".$hz;

		//上传文件
		if (move_uploaded_file($uploads['tmp_name'], $srcname)) {
			return $srcname;
		}else{
			return 0;
		}
		
	}


	//uploads($_FILES['file'],"./admin",["jpg","png","gif","txt"]);

?>