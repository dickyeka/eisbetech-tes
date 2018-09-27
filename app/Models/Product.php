<?php

namespace App\Models;

use App\Traits\ImageTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use ImageTrait;


    protected $guarded = ['id'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color');
    }

    public function add(Request $request)
    {
        $image = $this->upload($request);
        $request->request->add(['image'=>$image]);

        $input = $request->except(['tag','color','file']);

        $product = $this->create($input);
        $product->tags()->attach($request->tag);
        $product->colors()->attach($request->color);
        $product->save();

        return $product;
    }

    public function edit(Request $request)
    {
        if( $request->hasFile('file')) {
            $image = $this->upload($request);
            $request->request->add(['image'=>$image]);
        }

        $input = $request->except(['tag','color','file']) ;

        $this->update($input);
        $this->tags()->sync($request->tag);
        $this->colors()->sync($request->color);

        return $this;
    }


}
