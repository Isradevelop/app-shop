<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(){

        $products = Product::paginate(10);
        return view('admin.products.index')->with(compact('products'));// listado
    }

    public function create(){

        return view('admin.products.create');// formulario de registro de productos
    }

    public function store(Request $request){
        
        //validar
        $rules = [
            'name' => 'required | min:3',
            'price' => 'required | numeric | min:0',
            'description' => 'required | max:200'
        ];    

        $messages = [
            'name.required' => 'Es necesario introducir el nombre del producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario introducir la descripcion del producto',
            'description.max' => 'La desscripción del producto debe tener al menos 200 caracteres como máximo',
            'price.required' => 'Es necesario introducir el precio del producto',
            'price.numeric' => 'El precio solo puede contener números',
            'price.min' => 'El precio no puede contener números negativos'

        ];

        $this->validate($request, $rules, $messages);

        // registrar el nuevo producto
        //dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();// Insert sobre la table de productos

        return redirect('/admin/products');
    }



    public function edit($id){

        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product'));// formulario de edicion de productos
    }

    public function update(Request $request, $id){

        //validar
        $rules = [
            'name' => 'required | min:3',
            'price' => 'required | numeric | min:0',
            'description' => 'required | max:200'
        ];    

        $messages = [
            'name.required' => 'Es necesario introducir el nombre del producto',
            'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'description.required' => 'Es necesario introducir la descripcion del producto',
            'description.max' => 'La desscripción del producto debe tener al menos 200 caracteres como máximo',
            'price.required' => 'Es necesario introducir el precio del producto',
            'price.numeric' => 'El precio solo puede contener números',
            'price.min' => 'El precio no puede contener números negativos'

        ];

        $this->validate($request, $rules, $messages);

        // registrar el nuevo producto
        //dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save();// update sobre la tabla de productos

        return redirect('/admin/products');
    }


    public function destroy($id){

        //eliminar ProductImage por que estaba relacionada
        ProductImage::where('product_id', $id)->delete();

        
        $product = Product::find($id);
        $product->delete();

        return back();// redirigimos a la página anterior
    }

}
