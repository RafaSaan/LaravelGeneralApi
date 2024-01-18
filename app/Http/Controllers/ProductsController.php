<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        try {
            $rowsPerPage = $request->rowsPerPage ? (int) $request->rowsPerPage : 5;
            $page = $request->page ? (int) $request->page - 1 : 0;
            $products = Product::offset($page * $rowsPerPage)
            ->limit($rowsPerPage)
            ->get();
            return response()->json( [
                'success' => true,
                'products' => $products
            ], 200 );
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $products = new Product();
            $data = $request->all();
            $products->fill($data);
            $products->save();
            DB::commit();
            return response()->json( [
                'success' => true
            ], 200 );
        }
        catch ( \Exception $e ) {
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
}
