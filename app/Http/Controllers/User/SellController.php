<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sell;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;




class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function listar_sells($id)
    {
        $sells = Sell::select("sells.id", "c.name","sells.description", "sells.mount", "sells.payment_type_sell", "sells.status","sells.created_at")
            ->join('categories as c', 'c.id', '=', 'sells.category_id')
            ->where('sells.job_id', '=', $id)
            ->get();


        return DataTables::of($sells)
            ->editColumn('created_at', function ($sell) {
                return $sell->created_at ? Carbon::parse($sell->created_at)->format('d/m/Y h:m:s') : '';
            })
            ->addColumn('action', function ($sell) {
                if ($sell->status == "activo" && $sell->end_datetime == "") {
                    return '<a id="sell_show" href="javascript:void(0)" class="btn btn-sm btn-info" data-id="' . $sell->id . '"><i class="fas fa-eye"></i></a>&nbsp' .
                        '<a href="javascript:void(0)" class="btn btn-sm btn-warning" data-id="' . $sell->id . '" data-toggle="modal" data-target="#md_edit_sell" id="bt_sell_edit"><i class="fas fa-pen"></i></a>&nbsp'.
                        '<a id="sell_open" href="javascript:void(0)" class="btn btn-sm btn-success" data-id="' . $sell->id . '"><i class="fas fa-arrow-circle-right"></i></a>'
                        ;
                } else {
                    return '<a id="sell_show" href="javascript:void(0)" class="btn btn-sm btn-info" data-id="' . $sell->id . '"><i class="fas fa-eye"></i></a>';
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        return view("user.sells.index", compact("id"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
