<?php

namespace App\Models;

use Spatie\ViewModels\ViewModel;

class ProductViewModel extends  ViewModel
{
    protected  $product;

    function __construct(Product $product=null)
    {
        $this->product = $product;
    }

    public function product() : Product
    {
        return $this->product ?? new Product();
    }

    public function categories()
    {
        return Category::pluck('name','id');
    }

    public function tags()
    {
        return Tag::pluck('name','id');
    }

    public function colors()
    {
        return Color::pluck('name','id');
    }

    public function tagSelected()
    {
        return  $this->product ? $this->product->tags->pluck('id') : null;
    }

    public function colorSelected()
    {
        return  $this->product ? $this->product->colors->pluck('id') : null;
    }

}