<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get();// esta línea pone la imagen destacada en primer lugar
        return view('admin.products.images.index')->with(compact('product','images'));
    }


    public function store(Request $request, $id){

        //guardar imagen en nuestro proyecto
        $file = $request->file('photo');// a través de request llamamos al campo photo
        $path = public_path() . '/images/products';// public_path es la ruta absoluta a la carpeta public para guardar la imagen
        $fileName = uniqid() . $file->getClientOriginalName();// genera un nombre para el archivo, compuesto de un id único y el nombre original
        $move = $file->move($path, $fileName);//variable booleana que nos indica si la imagen se ha guardado correctamente



        //crear un registro en la BD
        if($move){

            $productImage = new ProductImage();
            $productImage->image = $fileName;
            //$productImage->featured = false;
            $productImage->product_id = $id;
            $productImage->save();// Insert

        }

        return back();
    }


    public function destroy(Request $request, $id){

        //eliminar el archivo
        $productImage = ProductImage::find($request->image_id); // si no encuentra un archivo local con esa id, devuelve una url

        if( substr($productImage->image, 0, 4) === 'http'){

            $deleted = true;
            
        }else{

            $fullPath = public_path(). '/images/products/' . $productImage->image; // ruta completa a la imgen
            $deleted = File::delete($fullPath); // devuelve un booleano
        }

        

        //eliminar el registro de la img en la bd

        if($deleted){ //Confirmamos que se haya eliminado el archivo

            $productImage->delete();
        }
        

        return back();
    }



    public function select($id, $image)
    {

        ProductImage::where('product_id', $id)->update([
            'featured' => false
        ]);

        $productImage = ProductImage::find($image);
        $productImage->featured = true;
        $productImage->save();


        return back();
    }
}
