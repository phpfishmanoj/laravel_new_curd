<?php

namespace App\Http\Controllers;

use App\Models\ProductManager;
use Illuminate\Http\Request;

class ProductManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    //
	  return view('addProduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
	$req = $request->validate([
		'productName' => 'required',
		'productPrice' => 'numeric|required',
		'productUPC' => 'required',
		'productImage' => 'required|image|mimes:jpeg,png,jpg,gif'
	]);

	$image      =       time().'.'.$request->productImage->extension();

	$pm = new ProductManager;
	$pm->name = $request->productName;
	$pm->price = $request->productPrice;
	$pm->upc = $request->productUPC;
	$pm->image = $image;
	$status = $pm->save();
	if($status){
	        $request->productImage->move(public_path('uploads'), $image);
	}

	return redirect()->route('home')->with('success','Product added successfully.');
	
    }	

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductManager  $productManager
     * @return \Illuminate\Http\Response
     */
    public function show(ProductManager $productManager)
    {
        //
	$pm = ProductManager::all();
	return View::make('home')->with('prodData', $pm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductManager  $productManager
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    //
	    $pm = ProductManager::findOrFail($id);
	    return view('editProduct', compact('pm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductManager  $productManager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
	    //
	    //print "$id"; exit;
	$req = $request->validate([
                'productName' => 'required',
                'productPrice' => 'numeric|required',
                'productUPC' => 'required',
        ]);


        $pm = ProductManager::find($id);
        $pm->name = $request->productName;
        $pm->price = $request->productPrice;
        $pm->upc = $request->productUPC;
        if( $request->productImage ){
        	$image      =       time().'.'.$request->productImage->extension();
        	$pm->image = $image;
                $request->productImage->move(public_path('uploads'), $image);
        }
        $status = $pm->save();
	if($status){
	        return redirect()->route('home')->with('success','Product updated successfully.');
	}
	return redirect()->route('home')->with('error','Product unable update.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductManager  $productManager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
	try{
		$pid = ProductManager::findOrFail($id);
		
		// delete image once record deleted
		if(file_exists(public_path('uploads')."/".$pid->image)){
			unlink(public_path('uploads')."/".$pid->image);	
		{
        	$pid->delete();
                return redirect()->route('home')->with('success','Company has been deleted successfully');
	}catch(Throwable $e){
		report($e);
	        return false;	
	}
    }
    public function delMultiProduct($did=null){
	print $did; exit;
	 try{
                $pid = ProductManager::findOrFail($pid);

                // delete image once record deleted
                if(file_exists(public_path('uploads')."/".$did->image)){
                        unlink(public_path('uploads')."/".$pid->image);
                {
                $pid->delete();
                return redirect()->route('home')->with('success','Company has been deleted successfully');
        }catch(Throwable $e){
                report($e);
                return false;
        }	
    }
}
