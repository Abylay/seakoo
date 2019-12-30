<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Seakoo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    </head>
    <body>
        <div id="app">
            <header>
                <div class="top-nav container">
                    <div class="top-nav-left">
                    <div class="logo"><a href="/"><img src="http://seakoo.net/bocweb/web/img/img1.png?v=v3" height="55" width="157"></a></div>
                        {{ menu('main', 'partials.menus.main') }}
                    </div>
                    <div class="top-nav-right">
                        @include('partials.menus.main-right')
                    </div>
                </div> <!-- end top-nav -->
            </header>
            <!--<div class="hero container">
                    <div class="hero-copy">
                        <h1>Laravel Ecommerce Demo</h1>
                        <p>Includes multiple products, categories, a shopping cart and a checkout system with Stripe integration.</p>
                        <div class="hero-buttons">
                            <a href="https://www.youtube.com/playlist?list=PLEhEHUEU3x5oPTli631ZX9cxl6cU_sDaR" class="button button-white">Screencasts</a>
                            <a href="https://github.com/drehimself/laravel-ecommerce-example" class="button button-white">GitHub</a>
                        </div>
                    </div>

                    <div class="hero-image">
                        <img src="img/macbook-pro-laravel.png" alt="hero image">
                    </div>
                </div> -->
            <div class="featured-section">

                <div class="container">
                    <h1 class="text-center">Seakoo</h1>

                    <p class="section-description">Компания SEAKOO, основанная в 2006г. как дочернее предприятие группы компаний SHIMGE PUMP INDUSTRY GROUP, –
                    это глобальная компания, ориентированная на внешнеэкономическую торговлю. Торговая марка SEAKOO зарегистрирована в более, чем 180 странах и регионах.
                    Взяв за основу клиентоориентирование и продажу качества и услуг первого класса, наша компания достигла быстрого развития и привлекла внимание как у себя дома, так и за рубежом.
                    К  основным видом нашей продукции следует отнести: водяной насос, насос с бензиновым двигателем, 
                    насос высокого давления для мойки, воздушный компрессор, сварочный аппарат, генератор, стабилизатор напряжения и аксессуары.
                    Являясь торговой маркой среднего класса группы SHIMGE, размах торговли брендом SEAKOO всё больше увеличивается.
                    Насосы под торговой маркой SEAKOO завоевали доверие и поддержку со стороны клиентов во многих странах.</p>
                    <div class="text-center button-container">
                        <a href="/shop" class="button">Популярные</a>
                    </div>

                    {{-- <div class="tabs">
                        <div class="tab">
                            Популярные
                        </div>
                        <div class="tab">
                            Распродажа
                        </div>
                    </div> --}}

                    <div class="products text-center">
                        @foreach ($products as $product)
                            <div class="product">
                                <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ productImage($product->image) }}" width="200" height="200" alt="product"></a>
                                <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                                <div class="product-price">{{ $product->presentPrice() }}</div>
                            </div>
                        @endforeach

                    </div> <!-- end products -->

                    <div class="text-center button-container">
                        <a href="{{ route('shop.index') }}" class="button">Больше продуктов</a>
                    </div>

                </div> <!-- end container -->

            </div> <!-- end featured-section -->

            <!--<blog-posts></blog-posts>-->

            @include('partials.footer')

        </div> <!-- end #app -->
        <script src="js/app.js"></script>
    </body>
</html>
