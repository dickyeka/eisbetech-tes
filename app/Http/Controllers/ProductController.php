<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductViewModel;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ImageTrait;

    protected $product;

    function __construct()
    {
        $this->product = new Product();
    }

    public function index(Request $request)
    {
        $products = $this->product
                        ->with(['category','tags','colors'])
                        ->when($request->name, function ($query) use ($request)  {
                            $query->where('name', 'like', '%'.$request->name.'%');
                        })
                        ->paginate(10);

        $paginate = $products->appends($request->except('page'))->links();

        return view('product.index',compact('products','paginate'));
    }


    public function create()
    {
        $viewModel = new ProductViewModel();
        return view('product.create',$viewModel);
    }

    public function store(CreateProductRequest $request)
    {
        $this->product->add($request);
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $viewModel = new ProductViewModel($product);

        return view('product.edit',$viewModel);
    }

    public function update($id,UpdateProductRequest $request)
    {
        $product = $this->product->find($id);
        $product->edit($request);

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
