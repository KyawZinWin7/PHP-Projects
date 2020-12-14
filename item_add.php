<?php

	require('db_connect.php');

	$name = $_POST['name'];
	$photo = $_FILES['photo'];
	$price = $_POST['price'];
	$discount = $_POST['discount'];
	$codeno = $_POST['codeno'];
	var_dump($codeno);
	$description = $_POST['description'];
	$choosebrand = $_POST['choosebrand'];
	// var_dump($choosebrand);
	$choosesubcategory = $_POST['choosesubcategory'];
	// var_dump($choosesubcategory);



	$source_dir = 'images/item/';


	$filename = mt_rand(100000, 999999);

	$file_exe_array = explode('.', $photo['name']);

	$file_exe= $file_exe_array[1];


	$fullpath = $source_dir.$filename.'.'.$file_exe;
	move_uploaded_file($photo['tmp_name'], $fullpath);



	$sql = "INSERT INTO items (codeno, name, photo, price, discount, description, brand_id, subcategory_id) VALUES(:value1,:value2,:value3,:value4,:value5,:value6,:value7,:value8)";
	$stmt = $pdo->prepare($sql);
	$stmt ->bindParam(':value1', $codeno);
	$stmt ->bindParam(':value2', $name);
	$stmt ->bindParam(':value3',$fullpath);
	$stmt ->bindParam(':value4',$price);
	$stmt ->bindParam(':value5',$discount);
	$stmt ->bindParam(':value6',$description);
	$stmt ->bindParam(':value7',$choosebrand);
	$stmt ->bindParam(':value8',$choosesubcategory);
	$stmt->execute();



	header('location:item_list.php');

?>