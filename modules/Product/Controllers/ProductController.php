<?php

namespace Modules\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Repositories\ProductRepository;
use Modules\Product\Repositories\ProductGalleryRepository;
use Illuminate\Support\Facades\Storage;
use Modules\Configuration\Repositories\CategoryRepository;
use Modules\Product\Models\ProductGallery;

class ProductController extends Controller
{
    protected $categories;
    protected $destinationPath;
    protected $products;
    protected $productGalleries;

    public function __construct(CategoryRepository $categories,
                                ProductRepository $products,
                                ProductGalleryRepository $productGalleries)
    {
        $this->products = $products;
        $this->categories = $categories;
        $this->productGalleries = $productGalleries;
        $this->destinationPath = 'products';
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
       $productsData = [];
        
        $products = $this->products->with(['category','images'])->get();
        
        foreach ($products as $product) {
            $category = $product->category; 
            $productData = [
                'id' => $product->id,
                "productTitle" => $product->title,
                "category" => $category->title,
                "price" => $product->price,
                "discount" =>$product->discount,
                "color"=> json_decode($product->color),
                "size" => json_decode($product->size),
                "stock" => $product->stocks,
                "status" => $product->status,
                "visibility" => $product->visibility,
                "description" => $product->description,
                "short_description" => $product->short_description,
                "manufacture_name" => $product->manufacture_name,
                "manufacture_brand" => $product->manufacture_brand,
                "status" => $product->status,
                "visibility" => $product->visibility,
                "images" => $product->images,
                "imagePath" => $product->images[0]->image_path
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
            if($product){
                $imagePathArr = $data['images_path'];

                foreach($imagePathArr as $imagePath){
                    $imageGalleryObj = new ProductGallery();
                    $imageGalleryObj->product_id = $product->id;
                    $imageGalleryObj->image_path = $imagePath;
                    $imageGalleryObj->save();
                }
                return response()->json(['success' => true,'status'=>200,'message'=>'Product added successfully!!']);
            }else{
                return response()->json(['success' => false,'status'=>500,'message'=>'Failed to add product!!']);
            }
            
        } else {
            $product = $this->products->find($data['id']);
            if ($product) {
                $product->update($data);
                return response()->json(['success' => true,'status'=>200,'message'=>'Product updated successfully!!']);
            } else {
                return response()->json(['success' => false,'status'=>500,'message'=>'Failed to update product!!']);
            }
        }
        return response()->json(['success' => false,'status'=>500,'message'=>'Add or update product operation failed!!']);;
    }

    public function fileupload(Request $request){
        if ($request->file) {
            $data['image_path'] = $request->file
                ->storeAs($this->destinationPath, time() . '.' . $request->file->getClientOriginalExtension());

            return response()->json(['success' => true,'status'=>200,'imagePath'=>$data['image_path']]);
        }
        return response()->json(['success' => false,'status'=>500,'imagePath' => null]);
    }

    
    public function destroy($id)
    {

    }
}
