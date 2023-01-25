<?php
	session_start();
	include_once "db.php";

	if(isset($_POST['categories'])) {
		$category_data = $db->query("SELECT * FROM category");
		
		if($category_data->rowCount()) {
			while($category = $category_data->fetch(PDO::FETCH_OBJ)) {

				echo "<li class='dropdown-item'
				onClick='showSubCategories(". $category->category_id.", \"" . $category->name ."\")'>". $category->name ."</li>";

			}
		} else {
			echo "No Categories";
		}	
	}


	if(isset($_POST['category_id'])) {
		$sub_category_data = $db->prepare("SELECT * FROM sub_category WHERE category_id= :category_id");
		$sub_category_data->bindParam(':category_id', $_POST['category_id']);

		if ($sub_category_data->execute()) {

			if($sub_category_data->rowCount()) {
				while($sub_category = $sub_category_data->fetch(PDO::FETCH_OBJ)) {
		
					echo "<li class='dropdown-item' onClick='showSubCategory(". $sub_category->sub_category_id .", \"" . $sub_category->name ."\")' data-id='". $sub_category->sub_category_id ."'>". $sub_category->name ."</li>";
		
				}
			} else {
				echo "No Sub Categories";
			}	

		} else { 

			echo "No Sub Categories";

		}

	}	

	

	 
?>
