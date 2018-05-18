<?php
	
	

	
		$image = explode('.',$nom_image);

		$image_extention = end($image);

		if(in_array(strtolower($image_extention), array('jpg','png','jpeg')))
		{
			$image_size = getimagesize($img_tmp);

			if($image_size['mime'] == 'image/jpeg')
			{
				$image_src = imagecreatefromjpeg($img_tmp);

			}else if($image_size['mime'] == 'image/png')
			{
				$image_src = imagecreatefrompng($img_tmp);

			}else
			{
				$image_src = false;

				echo "Veuillez faite entrer une image valide";
			}

			if($image_src !== false)
			{
				$image_width = 200;

				if($image_size[0] == $image_width)
				{
					$image_finale = $image_src;


				}else
				{
					$new_width[0] = $image_width;
					$new_height[1] = 200;

					$image_finale= imagecreatetruecolor($new_width[0], $new_height[1]);

					imagecopyresampled($image_finale, $image_src, 0, 0, 0, 0, $new_width[0], $new_height[1], $image_size[0], $image_size[1]);

				}

				imagejpeg($image_finale,'uploads/'.$nom_image);
			}
		}else
		{
			echo "L'image doit etre en 'jpg', 'jpeg'ou 'png'";
		}
	
?>