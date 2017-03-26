<?php 

namespace App\Gestion;

class PhotoGestion implements PhotoGestionInterface
{

    public function save($image)
	{
		if($image->isValid())
		{
			$chemin = config('images.path');
			$extension = $image->getClientOriginalExtension();

			do {
				$nom = str_random(10) . '.' . $extension;
			} while(file_exists($chemin . '/' . $nom));

			return $image->move($chemin, $nom);
		}

		return false;
	}

}