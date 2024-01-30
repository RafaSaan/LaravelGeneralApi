<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatus;
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
            ->join('product_statuses as status','products.statusId', '=', 'status.id')
            ->select('products.*', 'status.name as status', 'status.code as statusCode')
            ->limit($rowsPerPage)
            ->orderBy('id', 'desc')
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

    private function setStatusId($product) {
        $statusId = ProductStatus::where('code', 'out_of_stock')->first()->id;
        if ($product['quantity'] > 0 && $product['quantity'] <= 10) {
            return $statusId = ProductStatus::where('code', 'low_stock')->first()->id;
        }
        if ($product['quantity'] > 10) {
            return $statusId = ProductStatus::where('code', 'in_stock')->first()->id;
        }
        return $statusId;
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = new Product();
            $data = $request->all();
            $statusId = $this->setStatusId($data);
            $data['statusId'] = $statusId;
            $product->fill($data);
            $product->save();
            DB::commit();
            return response()->json( [
                'success' => true
            ], 200 );
        }
        catch ( \Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::where('id', $request->id)->first();
            $data = $request->all();
            $statusId = ProductStatus::where('code', $data['statusCode'])->first()->id;
            $data['statusId'] = $statusId;
            $product->fill($data);
            $product->save();
            DB::commit();
            return response()->json( [
                'success' => true
            ], 200 );
        }
        catch ( \Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
    public function enableOrDisableWholesaleProduct($id,Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::where('id', $id)->first();
            $product->hasWholesale = $request->hasWholesale;
            $product->save();
            DB::commit();
            return response()->json( [
                'success' => true
            ], 200 );
        }
        catch ( \Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $id)->delete();
            DB::commit();
            return response()->json( [
                'success' => true
            ], 200 );
        }
        catch ( \Exception $e ) {
            DB::rollBack();
            return response()->json( [
                'success' => false,
                'message' => $e->getMessage()
            ], 500 );
        }
    }
}
