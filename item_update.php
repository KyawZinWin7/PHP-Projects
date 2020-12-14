<?php

	require('db_connect.php');
	$id = $_POST['id'];
	var_dump($id);
	$name = $_POST['name'];
	var_dump($name);
	$oldphoto = $_POST['oldphoto'];
	var_dump($oldphoto);
	$newphoto = $_FILES['newphoto'];

	$price = $_POST['price'];
	var_dump($price);
	$discount = $_POST['discount'];
	$codeno = $_POST['codeno'];
	$description = $_POST['description'];
	var_dump($description);
	$c_brand = $_POST['c_brand'];
	var_dump($c_brand);
	
	$c_subcategory = $_POST['c_subcategory'];
	var_dump($c_subcategory);
	

	if ($newphoto['size'] > 0) {

		$source_dir = 'images/item/';
		$filename = mt_rand(100000, 999999);
		$file_exe_array = explode('.', $newphoto['name']);
		$file_exe = $file_exe_array[1];

		$fullpath = $source_dir.$filename.'.'.$file_exe;
		move_uploaded_file($newphoto['tmp_name'], $fullpath);
	}
	else{
		$fullpath = $oldphoto;
	}

	



	$sql = "UPDATE items  SET codeno=:value1, name=:value2, photo=:value3, price=:value4, discount=:value5, description=:value6, brand_id=:value7, subcategory_id=:value8 WHERE id=:value9";
	$stmt = $pdo->prepare($sql);
	$stmt ->bindParam(':value1', $codeno);
	$stmt ->bindParam(':value2', $name);
	$stmt ->bindParam(':value3',$fullpath);
	$stmt ->bindParam(':value4',$price);
	$stmt ->bindParam(':value5',$discount);
	$stmt ->bindParam(':value6',$description);
	$stmt ->bindParam(':value7',$c_brand);
	$stmt ->bindParam(':value8',$c_subcategory);
	$stmt ->bindParam(':value9', $id);
	$stmt->execute();



	header('location:item_list.php');

?>