<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use File;

class CategoryController extends Controller
{
    
    public function index(){

        $categories = Category::orderBy('name')->paginate(10);
        return view('admin.categories.index')->with(compact('categories'));// listado
    }

    public function create(){

        return view('admin.categories.create');// formulario de registro de productos
    }

    public function store(Request $request){
        
        $this->validate($request, Category::$rules, Category::$messages);
        
        $category = Category::create($request->only('name','description'));

        if($request->hasFile('image')){
            $file = $request->file('image');// a través de request llamamos al campo photo
            $path = public_path() . '/images/categories';// public_path es la ruta absoluta a la carpeta public para guardar la imagen
            $fileName = uniqid() . $file->getClientOriginalName();// genera un nombre para el archivo, compuesto de un id único y el nombre original
            $moved = $file->move($path, $fileName);//variable booleana que nos indica si la imagen se ha guardado correctamente



            //update category
            if($moved){

                $category->image = $fileName;
                $category->save();// Insert
            }

        }

        return redirect('/admin/categories');
    }



    public function edit(Category $category){

        
        return view('admin.categories.edit')->with(compact('category'));// formulario de edicion de categoría
    }

    public function update(Request $request, Category $category){

        //validar
        

        $this->validate($request, Category::$rules, Category::$messages);

        // registrar el nuevo producto
        //dd($request->all());
        $category->update($request->only('name','description'));

        if($request->hasFile('image')){
            $file = $request->file('image');// a través de request llamamos al campo photo
            $path = public_path() . '/images/categories';// public_path es la ruta absoluta a la carpeta public para guardar la imagen
            $fileName = uniqid() . $file->getClientOriginalName();// genera un nombre para el archivo, compuesto de un id único y el nombre original
            $moved = $file->move($path, $fileName);//variable booleana que nos indica si la imagen se ha guardado correctamente



            //update category
            if($moved){
                $previusPath = $path . '/' .$category->image;

                $category->image = $fileName;
                $saved = $category->save();// update

                if($saved)
                    File::delete($previusPath);
            }

        }

        return redirect('/admin/categories');
    }


    public function destroy(Category $category){
        
        $category->delete();

        return back();// redirigimos a la página anterior
    }


    
}


