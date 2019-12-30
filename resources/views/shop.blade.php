@extends('layout')

@section('title', 'Продукты')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Главная</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span><a href="/shop">Продукты</a></span>
    @endcomponent

    <div class="container">
        @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <div class="products-section container">
        <div class="sidebar">
            <h3 class="categ">Категории</h3>
            <div class="filter" style="position: relative;">
                    <ul class="filter-list" >
                        @foreach($categories as $_category)
                            <li class="{{ setActiveCategory($_category->slug) }}" >
                                <a href="{{ route('shop.index', ['category' => $_category->slug]) }}" class="f-parent">{{ $_category->name }}</a>
                                    <ul class="filter-list-item-list fil-child" style="display: none"  >         
                                        @foreach($category as $categor)
                                            @if ($categor->parent_id == $_category->id)
                                                    <li class="{{ setActiveCategory($categor->slug) }}" >
                                                        <a href="{{ route('shop.index', ['category' => $categor->slug]) }}">{{ $categor->name }}</a>
                                                                
                                                    </li>                                                   
                                            @endif
                                        @endforeach
                                    </ul>                               
                            </li>
                        @endforeach
                    </ul>
            </div>            
        </div> <!-- end sidebar -->
        <div>
            <div class="products-header">
                <h1 class="stylish-heading"><a href="/shop">Популярные товары</h1>
                <div>
                    <strong>Сортировка: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">По возрастанию</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">По убыванию</a>

                </div>
            </div>

            <div class="products text-center">
                @forelse ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" width="200" height="200" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                @empty 
                    <div style="text-align: left">Товары отсутсвуют</div>
                @endforelse
            </div> <!-- end products -->

            <div class="spacer"></div>
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>

@endsection

@section('extra-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $(".f-parent").click(function(e){
      e.preventDefault();
      //console.log($(this).parent().find('ul.fil-child'));
      $(this).parent().find('ul.fil-child').toggle(300);
        //console.log($(this).find('.fil-child'));
    //$(this).find('.fil-child').toggle(300);
  });
});
</script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection

