<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use DB;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Inventory\InventoryRepository;
use App\Repositories\Packaging\PackagingRepository;
use App\Repositories\Shop\ShopRepository;
use App\Http\Requests\Validations\CreateProductRequest;
use App\Http\Requests\Validations\CreateInventoryRequest;
use App\Http\Requests\Validations\UpdateProductRequest;
use App\Http\Requests\Validations\CreateInventoryWithVariantRequest;

class ProductController extends Controller
{
    use Authorizable;

    private $model;

    private $product;
    private $inventory;

    private $variations;

    private $packaging;

    /**
     * construct
     */
    public function __construct(ProductRepository $product, InventoryRepository $inventory, PackagingRepository $packaging)
    {
        parent::__construct();
        $this->model = trans('app.model.product');
        $this->product = $product;
        $this->inventory = $inventory;
        $this->packaging = $packaging;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = $this->product->all();

        $trashes = $this->product->trashOnly();

        return view('admin.product.index', compact('trashes'));
    }

    // function will process the ajax request
    public function getProducts(Request $request) {

        $products = $this->product->all();

        return Datatables::of($products)
            ->editColumn('checkbox', function($product){
                return view( 'admin.partials.actions.product.checkbox', compact('product'));
            })
            ->addColumn('option', function ($product) {
                return view( 'admin.partials.actions.product.options', compact('product'));
            })
            ->editColumn('image', function($product){
                return view( 'admin.partials.actions.product.image', compact('product'));
            })
            ->editColumn('name', function($product){
                return view( 'admin.partials.actions.product.name', compact('product'));
            })
            ->editColumn('gtin', function($product){
                return view( 'admin.partials.actions.product.gtin', compact('product'));
            })
            ->editColumn('category',  function ($product) {
                return view( 'admin.partials.actions.product.category', compact('product'));
            })
            ->editColumn('inventories_count', function($product){
                return view( 'admin.partials.actions.product.inventories_count', compact('product'));
            })
            ->editColumn('added_by', function($product){
                return view( 'admin.partials.actions.product.added_by', compact('product'));
            })
            ->rawColumns([ 'image', 'name', 'gtin', 'category', 'inventories_count', 'added_by', 'status', 'checkbox', 'option' ])
            ->make(true);
    }

    public function result(Request $request)
    {
        $product = null;
        $preview = null;
        $this->authorize('create', \App\Product::class); // Check permission
        // $product = \App\Product::with('image')->where('ain', $request->asin)->first();
        $product = \App\Variations::with('image')->where('ain', $request->asin)->first();
        if($product)
        {
            $product = $this->product->find($product->product_id);
            $preview = $product->previewImages();
        }
        return view('admin.product.result', compact('product', 'preview'));
    }

    public function sell(Request $request)
    {
        $inventory = null;
        $variants = array();
        $innerRequest = array();
        $attributes = array();
        $this->authorize('create', \App\Product::class); // Check permission
        $product = \App\Product::with(['categories', 'manufacturer'])->where('id', $request->id)->first();
        $packagings = $this->packaging->all();
        if($product->has_variant)
        {
            $inventory = \App\Inventory::where('product_id', $request->id)->get();
            $attributeIds= array();
            foreach($inventory as $invent)
            {
                $attribute = DB::table('attribute_inventory')
                ->where('inventory_id', $invent->id)
                ->select('*')->get()->toArray();
                
                foreach($attribute as $variant)
                {
                    array_push($attributes, (array) $variant);
                    array_push($attributeIds, $variant->attribute_id);
                }
            }
            foreach ($attributeIds as $key => $attributeId) 
            {
                $data =array();
                foreach ($attributes as $attribute)
                {
                    if($attributeId == $attribute['attribute_id'])
                    {
                        array_push($data, $attribute['attribute_value_id']);
                    }
                }
                $variants[$attributeId] = array_unique($data);
            }
            
            $variants = $this->inventory->confirmAttributes($variants);
            $attributes = $this->inventory->getAttributeList(array_keys($variants));
        }

        
        // $attributes = \App\Attribute::with('attributeValues')->get();
        // echo '<pre>';
        // print_r($attributes);
        // die();
        
        $combinations = generate_combinations($variants);
        
        $product = $this->inventory->findProduct($request->id);
        
        $inventoryTab = 1;
        return view('admin.product.sell', compact('packagings','variants','inventoryTab','product', 'inventory', 'combinations', 'attributes'));
    }

    public function storeInventory(CreateInventoryRequest $request)
    {
        $this->authorize('create', \App\Inventory::class); // Check permission

        $inventory = $this->inventory->store($request);

        return redirect()->route('admin.catalog.product.index');
        // $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        // return response()->json($this->getJsonParams($inventory));
        // echo 'done';
    }

    public function storeWithVariant(CreateInventoryWithVariantRequest $request)
    {
        $this->inventory->storeWithVariant($request);

        return redirect()->route('admin.stock.inventory.index')->with('success', trans('messages.created', ['model' => $this->model]));
    }


    public function searchCatalog()
    {
        
        return view('admin.product.search_catalog');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->searchCatalog();
        // $attributes = $this->inventory->getAllAttributes();
        
        // return view('admin.product.create', compact('attributes'));
        $new = 0;
        if(isset($_GET['new']))
        {
            $new = 1;
        }
        $productTab = 1;
        $attributes = $this->inventory->getAllAttributes();
        return view('admin.product.create', compact('new', 'productTab','attributes'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo '<pre>';
        // print_r($request->all());
        
        $this->authorize('create', \App\Product::class); // Check permission

        $parent = 0;
        if(is_array($_POST['sku']))
        {
            foreach($_POST['sku'] as $key => $sku)
            {
                $product = $request->all();
                if($key > 0)
                {
                    $request['name'] .= ' '.$sku;
                    $request['title'] .= $_POST['name'].' '.$sku;
                    $request['parent_id'] = $parent->id;
                    $request['slug'] = $_POST['name'].'-'.$sku;
                    $this->product->store($request);
                }
                else
                {
                    $request['parent_id'] = 0;
                    $parent = $this->product->store($request);
                }
                
            }
            $request['product'] = $parent;
            $this->inventory->storeWithVariant($request);
        }
        else
        {
            $parent = $this->product->store($request);
            $request['product_id'] = $parent->id;
            $request['title'] = $parent->name;
            // $request['shop_id'] = 
            $inventory = $this->inventory->store($request);
        }
        // die();
        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($parent));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $this->authorize('view', $product); // Check permission

        return view('admin.product._show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        $this->authorize('update', $product); // Check permission

        $preview = $product->previewImages();

        return view('admin.product.edit', compact('product', 'preview'));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->product->update($request, $id);

        $this->authorize('update', $product); // Check permission

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->product->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->product->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->product->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->product->massTrash($request->ids);

        if($request->ajax())
            return response()->json(['success' => trans('messages.trashed', ['model' => $this->model])]);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massRestore(Request $request)
    {
        $this->product->massRestore($request->ids);

        if($request->ajax())
            return response()->json(['success' => trans('messages.restored', ['model' => $this->model])]);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->product->massDestroy($request->ids);

        if($request->ajax())
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }


    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->product->emptyTrash($request);

        if($request->ajax())
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model])]);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($product){
        return [
            'id' => '$product->id',
            'model' => 'product',
            'redirect' => route('admin.catalog.product.index')
        ];
    }
}