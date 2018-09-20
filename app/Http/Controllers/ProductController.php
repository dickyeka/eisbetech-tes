<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageTrait;

    protected $product;
    protected  $categories;
    protected  $tags;
    protected  $colors;

    function __construct()
    {
        $this->product = new Product();
        $this->categories = Category::pluck('name','id');
        $this->tags = Tag::pluck('name','id');
        $this->colors = Color::pluck('name','id');
    }

    public function index(Request $request)
    {
        $products = $this->product
                        ->when($request->name, function ($query) use ($request)  {
                            $query->where('name', 'like', '%'.$request->name.'%');
                        })
                        ->paginate(10);

        $paginate = $products->appends($request->except('page'))->links();

        return view('product.index',compact('products','paginate'));
    }


    public function create()
    {
        $categories = $this->categories;
        $tags = $this->tags;
        $colors = $this->colors;

        return view('product.create',compact('categories','tags','colors'));

    }

    public function store(CreateProductRequest $request)
    {
        $image = $this->upload($request);
        $input = $request->except(['tag','color','file']);

        $product = $this->product->create($input+['image'=>$image]);
        $product->tags()->attach($request->tag);
        $product->colors()->attach($request->color);
        $product->save();

        return redirect()->route('product.index');

    }


    public function edit($id)
    {
        $categories = $this->categories;
        $tags = $this->tags;
        $colors = $this->colors;

        $product = $this->product->find($id);

        return view('product.edit',compact('categories','tags','colors','product'));

    }

    public function update($id,UpdateProductRequest $request)
    {

        if( $request->hasFile('file')) {
            $image = $this->upload($request);
            $request->request->add(['image'=>$image]);
        }

        $input = $request->except(['tag','color','file']) ;

        $product = $this->product->find($id);
        $this->product->update($input);
        $product->tags()->sync($request->tag);
        $product->colors()->sync($request->color);

        return redirect()->route('product.index');
    }

    public function destroy($id)
    {
        $this->product->find($id)->delete();
        return response()->json(['status'=>'deleted']);
    }

    public function show($id)
    {
        $product = $this->product->find($id);
        return view('product.show',compact('product'));
    }

}
