<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Product</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="js/bootstrap.js"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
	<body>
		<?php
			$db = new mysqli("localhost", "root", "", "product");
			// Insert data
			
			if(isset($_POST['send'])){
				$id = $_POST['id'];
				$bname = $_POST['bname'];
				$color = $_POST['color'];
				$model = $_POST['model'];
				$quality = $_POST['quality'];
				$size = $_POST['size'];
				$price = $_POST['price'];
				$waranty = $_POST['waranty'];
				$insert = "INSERT INTO shoes VALUES ('', '$bname', '$color', '$model', '$quality', '$size', '$price', '$waranty')";
				if(mysqli_query($db, $insert)){
					echo "Inserted";
					header ("Location: index.php");
				}else{
					echo "Not Inserted";
				}
				
			}
		?>
		
		<?php
			// Show data In Input Form
			if(isset($_POST['edit'])){
				$edit_id = $_POST['edit_id'];
				$input_sql = "SELECT * FROM shoes WHERE id='$edit_id' ";
				$input_query = mysqli_query($db, $input_sql);
				$show_in_input = mysqli_fetch_assoc($input_query);
			}
		
		?>
		
		<?php
			//Data Update
			if(isset($_POST['update'])){
				
				$id = $_POST['id'];
				$bname = $_POST['bname'];
				$color = $_POST['color'];
				$model = $_POST['model'];
				$quality = $_POST['quality'];
				$size = $_POST['size'];
				$price = $_POST['price'];
				$waranty = $_POST['waranty'];
				$update = "UPDATE shoes SET id='$id', b_name='$bname', color='$color', model_no='$model', quality='$quality', size='$size', price='$price', waranty='$waranty' WHERE id='".$_POST['id']."' ";
				if(mysqli_query($db, $update)){
					header ("Location: index.php");
				}else{
					echo "Not Updated";
				}
			}
		?>
		
		<?php
			// Data Delete
			if(isset($_POST['deletew'])){
				$delete_id = $_POST['delete_id'];
				$delete_sql = "DELETE FROM shoes WHERE id='$delete_id' ";
				if(mysqli_query($db, $delete_sql)){
					echo "<script>alert('Are you sure to delete the file?')</script>";
				}else{
					echo "<script>alert('Your file was save')</script>";
				}
				
			}

		?>
		<div class="container">
		<?php if(isset($_POST['delete'])){ ?>
			<div class="row">
				<div class="col-sm-12">
					<form action="" method="POST">
						<input class="form" type="hidden" name="delete_id" value="<?php echo $_POST['delete_id']; ?>">
						<button type="submit" name="deletew">Yes </button>
						<button type="submit" name="no">No</button>
					</form>
				</div>
			</div>
		<?php } ?>
			<div class="row">
				<div class="col-sm-4">
					<form action="" method="POST">
						<input class="form-control" type="hidden" name="id" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['id']; } ?> "><br>
						<input class="form-control" type="text" name="bname" placeholder="Name" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['b_name']; } ?>">
						<input class="form-control" type="text" name="color" placeholder="color" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['color']; } ?>">
						<input class="form-control" type="text" name="model" placeholder="model" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['model_no']; } ?>">
						<input class="form-control" type="text" name="quality" placeholder="quality" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['quality']; } ?>">
						<input class="form-control" type="number" name="size" placeholder="size" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['size']; } ?>">
						<input class="form-control" type="number" name="price" placeholder="price" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['price']; } ?>">
						<input class="form-control" type="text" name="waranty" placeholder="waranty" value="<?php if(!empty($show_in_input['id'])){ echo $show_in_input['waranty']; } ?>">
						<?php
							if(isset($_POST['edit'])){
								echo "<input class='btn btn-success' type='submit' name='update' value='Update'>";
							}else{
								echo "<input class='btn btn-success' type='submit' name='send'>";
							}
						?>
					</form>
				</div>
			
				<div class="col-sm-8">
					<center>
						<form action="" method="POST">
							<input style="width:250px;" class="form-control" type="text" name="search_id" placeholder="Findout">
							<input class="btn btn-success" style="width:250px;" type="submit" name="search" value="Search">
						</form>
					</center>
					<br><br>
					<?php
						if(isset($_POST['search'])){
							$search_id= $_POST['search_id'];
							$additional_sql = "SELECT COUNT(*) FROM shoes WHERE id like '%$search_id%' OR b_name like '%$search_id%'  OR color like '%$search_id%'  OR model_no like '%$search_id%'  OR quality like '%$search_id%'  OR size like '%$search_id%' ";
							$addition_query = mysqli_query($db, $additional_sql);
							$product_item = mysqli_fetch_row($addition_query);
							if($product_item[0] > '0'){
								echo $search_id .' ' . 'product item are' .' ' . $product_item[0];
							}
						}
					?>
					<table class="table">
						<tr style="background-color:#4da6ff; color:#eee;">
							<th style="border-right:2px solid #fff; border-top:2px solid #fff; border-bottom:2px solid #fff;">ID No:</th>
							<th class="th">Brand Name</th>
							<th class="th">Color</th>
							<th class="th">Model No:</th>
							<th class="th">Quality</th>
							<th class="th">Size</th>
							<th class="th">Price</th>
							<th class="th">Waranty</th>
							<?php if(isset($_POST['search'])){ echo ''; }else{ echo '<th class="th">Edit</th>'; } ?>
							<?php if(isset($_POST['search'])){ echo ''; }else{ echo '<th style="border-left:2px solid #fff; border-top:2px solid #fff; border-bottom:2px solid #fff;">Delete</th>'; } ?>
						</tr>
						<?php
						if(isset($_POST['search'])){
							$search_id = $_POST['search_id'];
							$select = "SELECT * FROM shoes WHERE id like '%$search_id%' OR b_name like '%$search_id%'  OR color like '%$search_id%'  OR model_no like '%$search_id%'  OR quality like '%$search_id%'  OR size like '%$search_id%' ";
						}else{
							$select = "SELECT * FROM shoes"; 
						}
							$query = mysqli_query($db, $select);
							while($row = mysqli_fetch_assoc($query)){ ?>
						<tr style="margin-bottom:5px;">
							<td style="background-color:#417d6f; color:#fff;;"><?php echo $row['id']; ?></td>
							<td style="background-color:#99ccff;"><?php echo $row['b_name']; ?></td>
							<td style="background-color:#99ddff;"><?php echo $row['color']; ?></td>
							<td style="background-color:#99ccff;"><?php echo $row['model_no']; ?></td>
							<td style="background-color:#99ddff;"><?php echo $row['quality']; ?></td>
							<td style="background-color:#99ccff;"><?php echo $row['size']; ?></td>
							<td style="background-color:#99ddff;"><?php echo $row['price']; ?></td>
							<td style="background-color:#99ccff;"><?php echo $row['waranty']; ?></td>
							<td style="background-color:#99ddff;">
								<form action="" method="POST">
									<?php if(isset($_POST['search'])){ echo ''; }else{ echo '<input style="background-color:#5cd65c;" type="submit" name="edit" value="Edit">'; } ?>
									<input class="form" type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
									
								</form>
							</td>
							<td style="background-color:#99ccff;">
								<form action="" method="POST">
									<?php if(isset($_POST['search'])){ echo ''; }else{ echo '<input style="background-color:#ff8c66;" type="submit" name="delete" value="Delete">'; } ?>
									<input class="form" type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
									
								</form>
							</td>
						</tr>
							<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>