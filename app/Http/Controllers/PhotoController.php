<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImagesRequest;
use App\Gestion\PhotoGestionInterface;

class PhotoController extends Controller
{
    public function getForm()
	{
		return view('photo');
	}

	public function postForm(ImagesRequest $request, PhotoGestionInterface $photogestion)
	{
		if($photogestion->save($request->file('image'))) {
			return view('photo_ok');
		}

		return redirect('photo')
			->with('error','Désolé mais votre image ne peut pas être envoyée !');
	}
}
