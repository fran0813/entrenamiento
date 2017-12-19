<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Response;
use App\Category;
use App\Note;
use App\Qualification;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin.index');
    }

    public function categoria()
    {
    	return view('admin.categoria');
    }

    public function asignarCategoria()
    {
        return view('admin.asignarCategoria');
    }

    public function calificarCategoria()
    {
        return view('admin.calificarCategoria');
    }

    public function idCategoria(Request $request)
    {
        $id = $_POST['id'];
        $request->session()->put('idCategory', $id);

        return Response::json(array('html' => 'ok'));
    }

    public function crearCategoria(Request $request)
    {
    	$html = "";
    	$booleanCategory = False;
    	$name = $_POST['name'];

    	$categories = Category::where('name', $name)
    						->get();
    	foreach ($categories as $category) {
    		$booleanCategory = True;
    	}

    	if ($booleanCategory == False) {
    		$create_category = new Category;
    		$create_category->name = $name;
    		$create_category->user_id = Auth::user()->id;
    		$create_category->save();
			$html = "Se ha creado con éxito";
    	} else {
    		$html = "No se puede crear, ya hay una categoría con el mismo nombre";
    	}

    	return Response::json(array('html' => $html,));    	
    }

    public function mostrarTablaCategoria(Request $request)
    {
    	$html = "";
    	$cont = 0;
        $booleanCategory = False;    	

    	$html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>Numero</th>";
        $html .= "<th class='text-center'>Título</th>";
        $html .= "<th class='text-center'>Funciones</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        $categories = Category::all();
    	foreach ($categories as $category) {
            $cont++;
            $booleanCategory = True;
    		$id = $category->id;
    		$name = $category->name;

    		$html .= "<tr class='border-dotted'>";
    		$html .= "<td class='text-center'>$cont</td>";
    		$html .= "<td class='text-center'>$name</td>";
    		$html .= "<td class='text-center' style='width: 50%;'>";
    		$html .= "<a id='$id' href='#' class='btn btn-info' value='actualizar' data-toggle='modal' data-target='#modalActualizarCategoria' style='margin-right: 1%;'>Editar</a>";
    		$html .= "<a id='$id' href='#' class='btn btn-danger' value='eliminar' data-toggle='modal' data-target='#modalEliminarCategoria' style='margin-right: 1%;'>Eliminar</a>";
            $html .= "<a id='$id' href='#' class='btn btn-primary' value='asignar' style='margin-right: 1%;'>Asignar usuarios</a>";
             $html .= "<a id='$id' href='#' class='btn btn-warning' value='calificar' style='margin-right: 1%;'>Calificar usuarios</a>";
    		$html .= "</td>";
    		$html .= "</tr>";
    	}

    	$html .= "</tbody>
                </table>";

        if ($booleanCategory == False) {
            $html = "<h1 class='text-center'>No hay categorías que mostrar</h1>";
        }

        return Response::json(array('html' => $html,));
    }

    public function mostrarActualizarCategoria(Request $request)
    {
    	$id = $_GET['id'];

    	$categories = Category::where('id', $id)
    						->get();
    	foreach ($categories as $category) {
    		$name = $category->name;
    	}

    	return Response::json(array('name' => $name,));    	
    }

    public function actualizarCategoria(Request $request)
    {
    	$html = "";
    	$booleanCategory = False;
    	$id = $_POST['id'];
    	$name = $_POST['name'];

    	$categories = Category::where('name', $name)
    						->get();
    	foreach ($categories as $category) {
    		$booleanCategory = True;
    	}

    	if ($booleanCategory == False) {
    		$update_category = Category::find($id);
            $update_category->name = $name;
            $update_category->save();
			$html = "Se ha actualizado con éxito";
    	} else {
    		$html = "No se puede actualizar, ya hay una categoría con el mismo nombre";
    	}

    	return Response::json(array('html' => $html,));    	
    }

    public function eliminarCategoria(Request $request)
    {
    	$html = "";
    	$id = $_POST['id'];

		$delete_category = Category::find($id);
        $delete_category->delete();
		$html = "Se ha eliminado con éxito";

    	return Response::json(array('html' => $html,));    	
    }

    public function mostrarTablaUsuarios(Request $request)
    {
        $html = "";
        $cont = 0;
        $booleanUser = False;
        $booleanQualification = False;
        $idCategory = null;

        if ($request->session()->get("idCategory")) {
            $idCategory = $request->session()->get("idCategory");
        }

        $html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>Numero</th>";
        $html .= "<th class='text-center'>Usuario</th>";
        $html .= "<th class='text-center'>Funciones</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        $users = User::join('role_user', 'users.id', 'role_user.user_id')
                    ->join('roles', 'roles.id', 'role_user.role_id')
                    ->select('users.id', 'users.name')
                    ->where('roles.name',  '!=', 'Admin')
                    ->orderBy('users.id', 'asc')
                    ->get();
        foreach ($users as $user) {
            $cont++;
            $booleanUser = True;
            $id = $user->id;
            $name = $user->name;

            $qualifications = Qualification::where('user_id', $id)
                                        ->where('category_id', $idCategory)
                                        ->get();
            foreach ($qualifications as $qualification) {
                $booleanQualification = True;
                $idQualification = $qualification->id;
            }

            if ($booleanQualification == False) {
                $html .= "<tr class='border-dotted'>";
                $html .= "<td class='text-center'>$cont</td>";
                $html .= "<td class='text-center'>$name</td>";
                $html .= "<td class='text-center'>";
                $html .= "<a id='$id' href='#' class='btn btn-info' value='asignar'>Asignar</a>";
                $html .= "</td>";
                $html .= "</tr>";
            } else {
                $html .= "<tr class='border-dotted' style='background-color: #87C4F8;'>";
                $html .= "<td class='text-center'>$cont</td>";
                $html .= "<td class='text-center'>$name</td>";
                $html .= "<td class='text-center' style='width: 40%;'>";
                $html .= "<a id='$id' href='#' class='btn btn-info' value='asignar' style='margin-right: 1%;'>Asignar</a>";
                $html .= "<a id='$id' href='#' class='btn btn-danger' data-toggle='modal' data-target='#modalDesasignarCategoria' value='desasignar' style='margin-right: 1%;'>Desasignar</a>";
                $html .= "</td>";
                $html .= "</tr>";
            }
        }

        $html .= "</tbody>
                </table>";

        if ($booleanUser == False) {
            $html = "<h1 class='text-center'>No hay usuarios que mostrar</h1>";
        }

        return Response::json(array('html' => $html,));
    }

    public function asignarUsuario(Request $request)
    {
        $html = "";
        $booleanQualification = False;
        $idCategory = null;
        $id = $_POST['id'];

        if ($request->session()->get("idCategory")) {
            $idCategory = $request->session()->get("idCategory");
        }

        $qualifications = Qualification::where('user_id', $id)
                                        ->where('category_id', $idCategory)
                                        ->get();
        foreach ($qualifications as $qualification) {
            $booleanQualification = True;
        }

        if ($booleanQualification == False) {
            $create_user_category = new Qualification;
            $create_user_category->note = null;
            $create_user_category->user_id = $id;
            $create_user_category->category_id = $idCategory;
            $create_user_category->save();
            $html = "Se ha asignado con éxito";
        } else {
            $html = "No se puede asignar, el usuario ya ha sido asignado a esa categoría";
        }

        return Response::json(array('html' => $html,));     
    }

    public function desasignarUsuario(Request $request)
    {
        $html = "";
        $booleanQualification = False;
        $idCategory = null;
        $id = $_POST['id'];

        if ($request->session()->get("idCategory")) {
            $idCategory = $request->session()->get("idCategory");
        }

        $qualifications = Qualification::where('user_id', $id)
                                            ->where('category_id', $idCategory)
                                            ->get();
        foreach ($qualifications as $qualification) {
            $booleanQualification = True;
            $idQualification = $qualification->id;
        }

        if ($booleanQualification == True) {
            $delete_qualification = Qualification::find($idQualification);
            $delete_qualification->delete();
            $html = "Se ha desasigno con éxito";
        }
        
        return Response::json(array('html' => $html,));  
    }

    public function mostrarTablaUsuariosCalificar(Request $request)
    {
        $html = "";
        $cont = 0;
        $booleanUser = False;
        $booleanQualification = False;
        $idCategory = null;

        if ($request->session()->get("idCategory")) {
            $idCategory = $request->session()->get("idCategory");
        }

        $categories = Category::where('id', $idCategory)
                                ->get();
        foreach ($categories as $category) {
            $nameCategory = $category->name;
        }

        $html .= "<table class='table table-bordered'>
                <thead class='thead-s'>
                <tr>";

        $html .= "<th class='text-center'>Numero</th>";
        $html .= "<th class='text-center'>Usuario</th>";
        $html .= "<th class='text-center'>Calificación</th>";

        $html .= "</tr>
                </thead>
                <tbody>";

        $users = User::join('qualifications', 'qualifications.user_id', 'users.id')
                    ->join('categories', 'qualifications.category_id', 'categories.id')
                    ->select('users.id', 'users.name')
                    ->where('qualifications.category_id', $idCategory)
                    ->orderBy('users.id', 'asc')
                    ->get();
        foreach ($users as $user) {
            $cont++;
            $booleanUser = True;
            $id = $user->id;
            $name = $user->name;

            $qualifications = Qualification::where('user_id', $id)
                                        ->where('category_id', $idCategory)
                                        ->get();
            foreach ($qualifications as $qualification) {
                $booleanQualification = True;
                $idQualification = $qualification->id;
                $noteUser = $qualification->note;
            }

            $html .= "<tr class='border-dotted'>";
            $html .= "<td class='text-center'>$cont</td>";
            $html .= "<td class='text-center'>$name</td>";
            $html .= "<td class='text-center' style='width: 40%;'>";
            $html .= "<select id='$id' class='form-control' onchange='calificar(this);'>";
            $html .= "<option value='$id'>Seleccione la calificación</option>";

            $notes = Note::all();
            foreach ($notes as $note) {
                $nameNote = $note->name;

                if ($noteUser == $nameNote) {
                    $html .= "<option id='$id' value='$nameNote' selected>$nameNote</option>";
                } else {
                    $html .= "<option id='$id' value='$nameNote'>$nameNote</option>";
                }                
            }

            $html .= "</select>";
            $html .= "</td>";
            $html .= "</tr>";
        }

        $html .= "</tbody>
                </table>";

        if ($booleanUser == False) {
            $html = "<h1 class='text-center'>No hay usuarios que mostrar</h1>";
        }

        return Response::json(array('html' => $html, 'titulo' => $nameCategory));
    }

    public function calificar(Request $request)
    {
        $idCategory = null;
        $id = $_POST['id'];
        $value = $_POST['value'];

        if ($request->session()->get("idCategory")) {
            $idCategory = $request->session()->get("idCategory");
        }

        $qualifications = Qualification::where('user_id', $id)
                                            ->where('category_id', $idCategory)
                                            ->get();
        foreach ($qualifications as $qualification) {
            $booleanQualification = True;
            $idQualification = $qualification->id;
        }

        $qualification = Qualification::find($idQualification);
        $qualification->note = $value;
        $qualification->save();

        return Response::json(array('html' => 'ok',));     
    }
}
