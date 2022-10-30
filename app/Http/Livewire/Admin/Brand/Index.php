<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Null_;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $name, $slug, $status , $brand_id, $category_id,$image, $imgBack, $svg;

    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable',
            'image' => 'nullable',
            'svg' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;
        $this->image = NULL;
        $this->imgBack = NULL;
        $this->svg = NULL;
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();    
        if($this->image){           
            $url = $this->image->store('brands','public'); 
        }
        
        Brand::create([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
            'image' => $url,
            'svg' => $this->svg
        ]);
        session()->flash('message', 'Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {   
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
        $this->category_id = $brand->category_id;
        $this->image = $brand->image;     
        $this->imgBack = $this->image; 
        $this->svg = $brand->svg;    
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        if($this->imgBack !== $this->image){
           $url = $this->image->store('brands','public'); 
           if(Storage::exists('public/'.$this->imgBack)){
            Storage::delete('public/'.$this->imgBack);
            }
        }        
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1' : '0',
            'category_id' => $this->category_id,
            'image' => isset($url) ? $url : $this->image,
            'svg' => $this->svg
        ]);
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id =  $brand_id;
    }

    public function destroyBrand()
    {   
        $brandToDelete = Brand::findOrFail($this->brand_id);
        if(Storage::exists('public/'.$brandToDelete->image)){
            Storage::delete('public/'.$brandToDelete->image);           
        }
        $brandToDelete->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();

    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();        
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])
                    ->extends('layouts.admin')
                    ->section('content');
    }
}
