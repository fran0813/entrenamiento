<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Response;
use App\Category;
use App\Qualification;

class UserController extends Controller
{
    public function index()
    {
    	return view('user.index');
    }

    public function calificacion()
    {
    	return view('user.calificacion');
    }

     public function mostrarTablaCalificacion(Request $request)
    {
    	$html = "";
    	$cont = 0;
        $booleanCategoria = False;
        $idUser = Auth::user()->id;
    	
    	$html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>Numero</th>";
        $html .= "<th class='text-center'>Título</th>";
        $html .= "<th class='text-center'>Calificación</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        $qualifications = Qualification::where('user_id', $idUser)
        								->get();
    	foreach ($qualifications as $qualification) {
    		$cont++;
            $booleanCategoria = True;
    		$note = $qualification->note;
    		$idCategory = $qualification->category_id;

    		$categories = Category::where('id', $idCategory)
        								->get();
    		foreach ($categories as $category) {
    			$name = $category->name;
    		}

    		$html .= "<tr class='border-dotted'>";
    		$html .= "<td class='text-center'>$cont</td>";
    		$html .= "<td class='text-center'>$name</td>";

    		if ($note == null) {
    			$html .= "<td class='text-center'>No se ha calificado</td>";
    		} else {
    			$html .= "<td class='text-center'>$note</td>";
    		}
    		$html .= "</tr>";
    	}

    	$html .= "</tbody>
                </table>";

        if ($booleanCategoria == False) {
            $html = "<h1 class='text-center'>No se ha asignado categoria a este usuario</h1>";
        }

        return Response::json(array('html' => $html,));
    }
}
