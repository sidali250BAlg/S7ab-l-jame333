<div style="border:solid 0.5px #ccc; border-radius: 10px; margin:20px; padding: 20px; box-shadow: 5px 10px 8px  #888; background-color: #eaeaf9 ">

	<div style="padding: 20px; margin:10px; border-bottom: solid 0.5px">

	<?php
	$sql = $connect->prepare("SELECT DISTINCT(nom_panneau) FROM panneau_index ");
						
	$sql->execute();
	$prods = $sql->fetchAll();

	foreach ($prods as $prod) 
	{
	?>
		<ul>
			<li style="color:blue"><?php echo $prod['nom_panneau']; ?></li>
		</ul>
	<?php
	}
	?>
						
	</div>

</div>