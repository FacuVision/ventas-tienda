<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.categories.index");
    }

    public function listar_categories()
    {

        $categories = Category::select("id", "name", "status", "created_at", "updated_at")->get();

        return DataTables::of($categories)

            ->addColumn('action', function ($category) {
                //Si el status del category es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($category->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $category->id . '" data-toggle ="modal" data-target="#md_edit_category" id="bt_category_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="category_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $category->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                }

                else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $category->id . '" data-toggle ="modal" data-target="#md_edit_category" id="bt_category_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="category_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $category->id . '"><i class="fas fa-solid fa-check"></i></a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $request)
    {

        Category::create([
            "name" => strtoupper($request->name),
        ]);

        $request = null;

        //return response()->json(['message' => 'Datos recibidos con éxito']);

    }

    /**
     * ####################REACTIVAR AREA###################
     */
    public function show($id)
    {
        //Se está reutilizando para reactivar un area

        $category = Category::findOrFail($id);

        if ($category) {
            $category->update([
                "status" => "activo"
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($category_id)
    {
        $category_edit = Category::select()->where("id", $category_id)->get();
        return $category_edit;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, $id)
    {

        $category = Category::FindOrFail($id);

        $category->update([
            "name" => strtoupper($request->name),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);

        if ($category) {
            $category->update([
                "status" => "inactivo"
            ]);
        }

        // Este bloque de código es una estructura condicional en PHP.
        // Lo que hace es verificar si la variable $area no tiene un valor o si
        // es igual a null. Esto se hace utilizando el operador de negación !,
        // que invierte el valor booleano de la expresión. Entonces,
        // !$area evaluará a true si $area es null o si no tiene un valor asignado.

        //$area->delete();
    }
}
