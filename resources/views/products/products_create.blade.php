@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавить новый товар</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <main id="page-content" class="page-content">
                <div>
                    <div class="subheader">
                        <div class="row">
                            <div class="col-auto mr-auto">
                                <div class="row no-gutters flex-nowrap">
                                    <div class="col-auto"><!----></div>
                                    <div class="col-auto">
                                        <div class="row no-gutters align-items-center"><h1
                                                class="col-auto subheader__title">
                                            </h1>
                                            <div class="col-auto subheader__breadcrumbs">
                                                <ol id="breadcrumbs" class="breadcrumb page-breadcrumb">
                                                    <li class="breadcrumb-item"><a href="{{route('home')}}"
                                                                                   target="_self">Главная страница</a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="{{route('products.index')}}"
                                                                                   class="active"
                                                                                   target="_self">Товары</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Добавить новый товар</span>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                    <div>
                        <div class="card card-with-table">
                            <div class="card-header">
                                <div class="card-body pb-1">
                                <p>Поиск по штрихкоду</p>
                                <form class="row">
                                    <fieldset class="form-group col-sm">
                                        <div>
                                            <div role="group" class="input-group">
                                                <input name="search_field_code"
                                                       @if(isset($_GET['search_field_code']) && !empty($_GET['search_field_code'])) value="{{$_GET['search_field_code']}}"
                                                       @endif id="filter_barcode" type="text" placeholder="Штрихкод"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group col-auto">
                                        <div>
                                            <button type="submit" class="btn btn-success">
                                                Найти товар в базе
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-header"><span class="card-header-title"><h5>Добавление товара</h5></span></div>
                        <div class="card card-with-table">
                            <div class="card-body"><!----><!---->
                                @if(isset($_GET['search_field_code']) && !empty($_GET['search_field_code']))
                                    <form action="{{route('acceptances.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body pb-1">
                                            <input type="hidden" name="product_id"
                                                   @if(isset($product) && !empty($product))  value="{{$product->id}}" @endif>
                                            <div class="form-group">
                                                <div class="form-group has-feedback">
                                                    <div class="form-group">
                                                        <label for="image">Выберите фото</label>
                                                        <input type="file" name="image" class="form-control-file">
                                                        @if(isset($product) && !empty($product->image)) <img
                                                            src="/images/{{$product->image}}"
                                                            class="img-responsive" width="100px" height="100px" alt="">@endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="title">Наименование</label>
                                                    <input type="text" name="title" @if(isset($product) && !empty($product)) value="{{$product->title}}" @endif class="form-control"
                                                           placeholder="Наименование продукта">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Категория</label>
                                                    <select class="form-control" name="category_id">
                                                        <option>Выбрать категорию</option>
                                                        @foreach($categories as $category)
                                                            @if(isset($product) && !empty($product) && $category->title == $product->category->title)
                                                                <option value="{{$category->id}}"
                                                                        selected>{{$category->title}}</option>
                                                            @else
                                                                <option
                                                                    value="{{$category->id}}">{{$category->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Ед.измерения</label>
                                                    <select name="unit_id" class="form-control">
                                                        <option>Выбрать ед.измерения</option>
                                                        @foreach($units as $unit)
                                                            @if(isset($product) && !empty($product) && $unit->id == $product->unit->id)
                                                                <option selected
                                                                        value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                            @else
                                                                <option
                                                                    value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress">Артикул</label>
                                                    <input type="text" name="vendor_code" @if(isset($product) && !empty($product)) value="{{$product->vendor_code}}" @endif class="form-control"
                                                           placeholder="введите артикул">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="price">Закупочная цена</label>
                                                    <input type="text" class="form-control" name="price">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPassword4">Накрутка %</label>
                                                    <input type="text" class="form-control" name="margin">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPassword4">Штрихкод</label>
                                                    <input type="text" @if(isset($product) && !empty($product)) value="{{$product->code}}" @endif class="form-control" name="code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pb-2">
                                            <h5>Выберите данные для приёмки</h5>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Склад</label>
                                                    <select name="storage_id" class="form-control">
                                                        <option>Выбрать склад</option>
                                                        @foreach($storages as $storage)
                                                            @if(isset($product) && !empty($product) && $storage->title == $product->storage->title)
                                                                <option selected
                                                                        value="{{$storage->id}}">{{$storage->title}}</option>
                                                            @else
                                                                <option
                                                                    value="{{$storage->id}}">{{$storage->title}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress">Количество</label>
                                                    <input type="text" name="count" class="form-control"
                                                           placeholder="количество">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">
                                                    Добавить товар
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                            </div>
                                @else
                                <div class="card card-with-table">
                                    <form action="{{route('products.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body pb-1">
                                            <div class="form-group">
                                                <div class="form-group has-feedback">
                                                    <div class="form-group">
                                                        <label for="image">Выберите фото</label>
                                                        <input type="file" name="image" class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress">Наименование</label>
                                                    <input type="text" name="title" class="form-control"
                                                           placeholder="Наименование продукта">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Категория</label>
                                                    <select class="form-control" name="category_id">
                                                        <option>Выбрать категорию</option>
                                                        @foreach($categories as $category)
                                                        <option value="{{$category->title}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Ед.измерения</label>
                                                    <select name="unit_id" class="form-control">
                                                        <option>Выбрать ед.измерения</option>
                                                        @foreach($units as $unit)
                                                            <option value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress">Артикул</label>
                                                    <input type="text" name="vendor_code" class="form-control"
                                                           placeholder="введите артикул">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="price">Закупочная цена</label>
                                                    <input type="text" class="form-control" name="price">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPassword4">Накрутка %</label>
                                                    <input type="text" class="form-control" name="margin">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputPassword4">Штрихкод</label>
                                                    <input type="text" class="form-control" name="code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pb-2">
                                            <h5>Выберите данные для приёмки</h5>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="inputState">Склад</label>
                                                    <select name="storage_id" class="form-control">
                                                        <option>Выбрать склад</option>
                                                        @foreach($storages as $storage)
                                                            <option value="{{$storage->id}}">{{$storage->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="inputAddress">Количество</label>
                                                    <input type="text" name="count" class="form-control"
                                                           placeholder="количество">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">
                                                    Добавить товар
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                </div>
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>
@endsection
