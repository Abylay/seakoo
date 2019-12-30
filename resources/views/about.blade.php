@extends('news')

@section('title', 'О нас')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
        <a href="/">Главная</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>О нас</span>
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
    <br>
    <div class="container">
        <h1 class="text-center">Seakoo</h1>

        <p class="section-description">Компания SEAKOO, основанная в 2006г. как дочернее предприятие группы компаний SHIMGE PUMP INDUSTRY GROUP, –
        это глобальная компания, ориентированная на внешнеэкономическую торговлю. Торговая марка SEAKOO зарегистрирована в более, чем 180 странах и регионах.
        Взяв за основу клиентоориентирование и продажу качества и услуг первого класса, наша компания достигла быстрого развития и привлекла внимание как у себя дома, так и за рубежом.
        К  основным видом нашей продукции следует отнести: водяной насос, насос с бензиновым двигателем, 
        насос высокого давления для мойки, воздушный компрессор, сварочный аппарат, генератор, стабилизатор напряжения и аксессуары.
        Являясь торговой маркой среднего класса группы SHIMGE, размах торговли брендом SEAKOO всё больше увеличивается.
        Насосы под торговой маркой SEAKOO завоевали доверие и поддержку со стороны клиентов во многих странах.</p>
    </div>


@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection