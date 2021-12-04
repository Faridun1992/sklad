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
                        <div class="card card-with-table"><!---->
                            <div class="card-header"><span class="card-header-title">Добавление товара</span></div>
                            <div class="card-header">
                                <form action="" name="">
                                    <div>
                                        <input name="search_field_code"
                                               @if(isset($_GET['search_field_code']) && !empty($_GET['search_field_code'])) value="{{$_GET['search_field_code']}}"
                                               @endif id="filter_barcode" type="text" placeholder="Штрихкод"
                                               class="form-control">
                                        <button>Поиск</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body"><!----><!---->
                                @if(isset($_GET['search_field_code']) && !empty($_GET['search_field_code']))
                                    <form action="{{route('acceptances.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="product_id"
                                               @if(isset($product) && !empty($product))  value="{{$product->id}}" @endif>
                                        <div class="form-group has-feedback">
                                            <label for="image">Выберите фото</label>
                                            <input type="file" name="image" value="">
                                            @if(isset($product) && !empty($product)) <img
                                                src="/images/{{$product->image ?? "no_image.jpg"}}"
                                                class="img-responsive" width="100px" height="100px" alt="">@endif
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="title">Название продукта</label>
                                            <input type="text" name="title"
                                                   @if(isset($product) && !empty($product)) value="{{$product->title}}"
                                                   @endif class="form-control"
                                                   placeholder="название продукта" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="name">Выберите категорию</label>
                                            <select name="category_id" id="">
                                                <option value=""></option>
                                                @foreach($categories as $category)
                                                    @if(isset($product) && !empty($product) && $category->title == $product->category->title)
                                                        <option value="{{$category->id}}"
                                                                selected>{{$category->title}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="unit">Ед.измерения</label>
                                            <select name="unit_id" id="">
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
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="vendor_code">Артикул</label>
                                            <input type="text" name="vendor_code"
                                                   @if(isset($product) && !empty($product)) value="{{$product->vendor_code}}"
                                                   @endif class="form-control"
                                                   placeholder="Введите артикул">
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="price">Цена закупки</label>
                                            <input type="text" name="price" class="form-control"
                                                   placeholder="Цена закупки" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="margin">Накрутка</label>
                                            <input type="text" name="margin" class="form-control"
                                                   placeholder="Накрутка" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="code">Штрихкод</label>
                                            <input type="text" name="code"
                                                   @if(isset($product) && !empty($product)) value="{{$product->code}}"
                                                   @endif class="form-control"
                                                   placeholder="Введите штрихкод" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <select name="storage_id" id="">
                                                <option value="">Склад</option>
                                                @foreach($storages as $storage)
                                                    @if(isset($product) && !empty($product) && $storage->title == $product->storage->title)
                                                        <option selected
                                                                value="{{$storage->id}}">{{$storage->title}}</option>
                                                    @else
                                                        <option value="{{$storage->id}}">{{$storage->title}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="name">Количество</label>
                                            <input type="text" name="count" class="form-control"
                                                   placeholder="Введите количество добавляемого товара" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">
                                                Сохранить
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    <form action="{{route('products.store')}}" method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group has-feedback">
                                            <label for="image">Выберите фото</label>
                                            <input type="file" name="image" value="">
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="title">Название продукта</label>
                                            <input type="text" name="title"
                                                   class="form-control"
                                                   placeholder="название продукта" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="name">Выберите категорию</label>
                                            <select name="category_id" id="">
                                                <option value=""></option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="unit">Ед.измерения</label>
                                            <select name="unit_id" id="">
                                                @foreach($units as $unit)
                                                    <option
                                                        value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>

                                                @endforeach
                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="vendor_code">Артикул</label>
                                            <input type="text" name="vendor_code"
                                                    class="form-control"
                                                   placeholder="Введите артикул">
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="price">Цена закупки</label>
                                            <input type="text" name="price" class="form-control"
                                                   placeholder="Цена закупки" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="margin">Накрутка</label>
                                            <input type="text" name="margin" class="form-control"
                                                   placeholder="Накрутка" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="code">Штрихкод</label>
                                            <input type="text" name="code"
                                                    class="form-control"
                                                   placeholder="Введите штрихкод" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <select name="storage_id" id="">
                                                <option value="">Склад</option>
                                                @foreach($storages as $storage)
                                                        <option value="{{$storage->id}}">{{$storage->title}}</option>
                                                @endforeach
                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group has-feedback">
                                            <label for="name">Количество</label>
                                            <input type="text" name="count" class="form-control"
                                                   placeholder="Введите количество добавляемого товара" required>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">
                                                Сохранить
                                            </button>
                                        </div>
                                    </form>
                                @endif
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>
@endsection
