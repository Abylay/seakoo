@extends('layout')

@section('title', 'Products')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
<style>
   .filter {
  padding: 15px;
  background: white;
  width: 200px;
  box-shadow: 2px 2px 8px rgba(0,0,0,.1);
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.filter h3 {
  font-size: 16px;
  color: rgba(0,0,0,.6);
  margin: 0 0 10px;
  padding: 0 5px;
  position: relative;
}
.filter h3:after {
  content: "";
  width: 6px;
  height: 6px;
  background: #80C8A0;
  position: absolute;
  right: 5px;
  bottom: 2px;
  box-shadow: -8px -8px #80C8A0, 0 -8px #80C8A0, -8px 0 #80C8A0;
}
.filter ul {
  list-style: none;
  margin: 0;
  padding: 0; 
  border-top: 1px solid rgba(0,0,0,.3);
}
.filter li {margin: 12px 0 0 0px;}
.filter a {
  text-decoration: none;
  display: block;  
  font-size: 13px;
  color: rgba(0,0,0,.6);
  padding: 5px;
  position: relative;
  transition: .3s linear;
}
.filter a:after {
  content:"\f18e";
  font-family: FontAwesome;
  position: absolute;
  right: 5px;
  color: white;
  transition: .2s linear;
}
.filter a:hover {
  background: #80C8A0;
  color: white;
}
</style>

@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shop</span>
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
            <h3>Категории</h3>
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
                <h1 class="stylish-heading">Популярные товары</h1>
                <div>
                    <strong>Цена: </strong>
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'low_high']) }}">Сначала дешевые</a> |
                    <a href="{{ route('shop.index', ['category'=> request()->category, 'sort' => 'high_low']) }}">Сначала дорогие</a>

                </div>
            </div>

            <div class="products text-center">
                @forelse ($products as $product)
                    <div class="product">
                        <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" alt="product"></a>
                        <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                        <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                @empty
                    <div style="text-align: left">В базе не найдены товары</div>
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

