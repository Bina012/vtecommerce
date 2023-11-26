<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Modules\Configuration\Repositories\CategoryRepository;

class ProductController extends Controller
{
    protected $categories;
    protected $destinationPath;
    protected $products;

    public function __construct(CategoryRepository $categories,ProductRepository $products)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->destinationPath = 'products';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
       $productsData = [];
        
        $products = $this->products->with('category')->get();
        
        foreach ($products as $product) {
            $category = $product->category; 
            $productData = [
                'id' => $product->id,
                "productTitle" => $product->title,
                "category" => $category->title,
                "price" => $product->price,
                "discount" => $product->discount.'%',
                "color"=> json_decode($product->color),
                "size" => json_decode($product->size),
                "stock" => $product->stocks,
                "status" => $product->status,
                "visibility" => $product->visibility
            ];

           $productsData[] = $productData;
        }

        return view('Product::product-list')
            ->withProductsData($productsData);
    }

    public function create(){
        $categoriesList = $this->categories->all();
        return view('Product::create')
            ->withCategoriesList($categoriesList);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $request->all();

        $colorArr = $data['colors'];
        $colorValue = json_encode($colorArr);
        $data['color'] = $colorValue;
       
        $sizeArr = $data['sizes'];
        $sizeValue = json_encode($sizeArr);
        $data['size'] = $sizeValue;


        if ($data['id'] === null) {
            unset($data['id']); // Remove the 'id' field if it's null for insertion
            $product = $this->products->create($data);
            $message = $product ? 'Product added successfully!!' : 'OOPS, Product cannot be added!!';
        } else {
            $product = $this->products->find($data['id']);
            if ($product) {
                $product->update($data);
                $message = 'Product updated successfully!!';
            } else {
                $message = 'OOPS, product cannot be updated!!';
            }
        }
       session()->flash('message.updated', $message);
       return redirect()->route('product.index');
    }

    
    public function destroy($id)
    {

    }
}
