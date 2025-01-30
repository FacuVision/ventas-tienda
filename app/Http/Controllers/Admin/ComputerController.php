<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateComputerRequest;
use App\Http\Requests\Admin\UpdateComputerRequest;
use App\Models\Computer;
use Yajra\DataTables\DataTables;


class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.computers.index");
    }

    public function listar_computers()
    {

        $categories = Computer::select("id", "name", "owner", "detail", "status", "created_at", "updated_at")->get();

        return DataTables::of($categories)

            ->addColumn('action', function ($computer) {
                //Si el status del computer es activo se muestra la opcion de desactivar, de lo contrario se muestra para activar
                if ($computer->status == "activo") {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $computer->id . '" data-toggle ="modal" data-target="#md_edit_computer" id="bt_computer_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="computer_delete" href="javascript:void(0)" class="btn btn-sm btn-danger" data-id="' . $computer->id . '"><i class="fas fa-solid fa-trash"></i></a>';
                }

                else {
                    return '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $computer->id . '" data-toggle ="modal" data-target="#md_edit_computer" id="bt_computer_edit"> <i class="fas fa-solid fa-pen"></i> </a>'
                        . "&nbsp" . '<a id="computer_activate" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $computer->id . '"><i class="fas fa-solid fa-check"></i></a>';
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
    public function store(CreateComputerRequest $request)
    {
        Computer::create([
            "name" => $request->name,
            "detail" => $request->detail,
            "owner" => $request->owner
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Computer::findOrFail($id);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComputerRequest $request, string $id)
    {
        $computer = Computer::findOrFail($id);
        $computer->update([
            "name" => $request->name,
            "detail" => $request->detail,
            "owner" => $request->owner
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
