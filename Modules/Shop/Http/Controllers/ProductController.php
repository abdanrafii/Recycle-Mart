<?php

namespace Modules\Shop\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Modules\Shop\Repositories\Front\Interfaces\ProductRepositoryInterface;
use Modules\Shop\Repositories\Front\Interfaces\CategoryRepositoryInterface;
use Modules\Shop\Repositories\Front\Interfaces\TagRepositoryInterface;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $tagRepository;
    protected $defaultPriceRange;
    protected $sortingQuery;

    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, TagRepositoryInterface $tagRepository)
    {
        parent::__construct();

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->tagRepository = $tagRepository;
        $this->defaultPriceRange = [
            'min' => 10000,
            'max' => 75000,
        ];

        $this->data['categories'] = $this->categoryRepository->findAll();
        $this->data['filter']['price'] = $this->defaultPriceRange;

        $this->sortingQuery = null;
        $this->data['sortingQuery'] = $this->sortingQuery;
        $this->data['sortingOptions'] = [
            '' => '-- Sort Products --',
            '?sort=price&order=asc' => 'Price: Low to High',
            '?sort=price&order=desc' => 'Price: High to Low',
            '?sort=publish_date&order=desc' => 'Newest Item',
        ];
    }

    public function index(Request $request)
    {
        $priceFilter = $this->getPriceRangeFilter($request);
        $keywordFilter = $this->keyword($request);

        $options = [
            'per_page' => $this->perPage,
            'filter' => [
                'price' => $priceFilter,
                'keyword' => $keywordFilter
            ],
        ];

        if ($request->get('price')) {
            $this->data['filter']['price'] = $priceFilter;
        }

        if ($request->get('sort')) {
            $sort = $this->sortingRequest($request);
            $options['sort'] = $sort;
            $this->sortingQuery = '?sort=' . $sort['sort'] . '&order=' . $sort['order'];
            $this->data['sortingQuery'] = $this->sortingQuery;
        }

        if ($request->get('keyword')) {
            $this->data['filter']['keyword'] = $keywordFilter;
        }
        
        $this->data['products'] = $this->productRepository->findAll($options);
        
        return $this->loadTheme('products.index', $this->data);
    }

    public function category($categorySlug)
    {
        $category = $this->categoryRepository->findBySlug($categorySlug);

        $options = [
            'per_page' => $this->perPage,
            'filter' => [
                'category' => $categorySlug,
            ]
        ];

        $this->data['products'] = $this->productRepository->findAll($options);
        $this->data['category'] = $category;

        return $this->loadTheme('products.category', $this->data);
    }

    public function tag($tagSlug)
    {
        $tag = $this->tagRepository->findBySlug($tagSlug);
        
        $options = [
            'per_page' => $this->perPage,
            'filter' => [
                'tag' => $tagSlug,
            ]
        ];

        $this->data['products'] = $this->productRepository->findAll($options);
        $this->data['tag'] = $tag;

        return $this->loadTheme('products.tag', $this->data);
    }

    public function show($categorySlug, $productSlug)
    {
        $sku = Arr::last(explode('-', $productSlug));
        $product = $this->productRepository->findBySKU($sku);

        $this->data['product'] = $product;

        return $this->loadTheme('products.show', $this->data);
    }

    function getPriceRangeFilter($request)
    {
        if (!$request->get('price')) {
            return [];
        }

        $prices = explode(' - ', $request->get('price'));
        if (count($prices) < 0) {
            return $this->defaultPriceRange;
        }

        return [
            'min' => (int) $prices[0],
            'max' => (int) $prices[1],
        ];
    }

    function sortingRequest(Request $request)
    {
        $sort = [];

        if ($request->get('sort') && $request->get('order')) {
            $sort = [
                'sort' => $request->get('sort'),
                'order' => $request->get('order'),
            ];
        } else if ($request->get('sort')) {
            $sort = [
                'sort' => $request->get('sort'),
                'order' => 'desc',
            ];
        }

        return $sort;
    }

    public function keyword($request)
    {
        if (!$request->get('keyword')) {
            return '';
        }
        
        return $request->get('keyword');
    }

    public function create()
    {
        return $this->loadTheme('products.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sku' => ['required', 'unique:products', 'max:100'],
            'name' => ['required', 'max:100'],
            'price' => ['required', 'numeric', 'min:1'],
            'stock' => ['required', 'numeric', 'min:0'],
        ]);

        if ($validator->fails()) {
            return redirect('products/create')
                        ->withErrors($validator)
                        ->withInput();
        }
 
        // Retrieve the validated input...
        $validated = $validator->validated();

        return $validated;
    }
}
