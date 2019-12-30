@extends('layout')


@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Главная</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span><a href="{{ route('shop.index') }}">Продукты</a></span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{ $product->name }}</span>
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

    <div class="product-section container">
        <div>
            <div class="product-section-image">
                <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage">
            </div>
            <div class="product-section-images">
                <div class="product-section-thumbnail selected">
                    <img src="{{ productImage($product->image) }}" alt="product">
                </div>

                @if ($product->images)
                    @foreach (json_decode($product->images, true) as $image)
                    <div class="product-section-thumbnail">
                        <img src="{{ productImage($image) }}" alt="product">
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="product-section-information">
            <h1 class="product-section-title">{{ $product->name }}</h1>
            <div class="product-section-subtitle">{{ $product->details }}</div>
            <div>{!! $stockLevel !!}</div>
            <div class="product-section-price">{{ $product->presentPrice() }}</div>

            <p>
                {!! $product->description !!}
            </p>

            <p>&nbsp;</p>

            @if ($product->quantity > 0)
                <form action="{{ route('cart.store', $product) }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit" class="button button-plain">Добавить в корзину</button>
                </form>
            @endif
        </div>
    </div> <!-- end product-section -->
    
    {{-- Reviews and Characteristics --}}
    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'London')">Отзывы</button>
        <button class="tablinks" onclick="openCity(event, 'Paris')">Характеристики</button>
      </div>
      
      <!-- Tab content -->
      <div id="London" class="tabcontent">

        @comments([
        'model' => $product,
        'approved' => true
            ])
      </div>
      
      <div id="Paris" class="tabcontent">
        <div class="characteristics">
        
            <h1>Характеристики</h1>
                <ul>
                @foreach($specs as $spec)
                    @foreach($spec as $_spec)
                        <li>{{ $_spec->name }}:&nbsp;
                        @foreach($product_specs as $product_spec)
                        @if($product_spec->spec_id === $_spec->id)
                            {{ $product_spec->value }}
                        @endif
                        @endforeach
                        </li>
                    @endforeach
                @endforeach
                </ul>
        </div>
      </div>

    @include('partials.might-like')

@endsection

@section('extra-js')
    <script>
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.product-section-thumbnail');

            images.forEach((element) => element.addEventListener('click', thumbnailClick));

            function thumbnailClick(e) {
                currentImage.classList.remove('active');

                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                })

                images.forEach((element) => element.classList.remove('selected'));
                this.classList.add('selected');
            }

        })();
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    <script src="{{ asset('js/jquery.tabslet.js') }}"></script>
    <script src="{{ asset('js/jquery.tabslet.min.js') }}"></script>
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            }
    </script>
    

@endsection
