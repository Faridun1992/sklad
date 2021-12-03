@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактирование товара</h1>
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
                                                            aria-current="location">Редактирование товара</span>
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
                            <div class="card-header"><span class="card-header-title">Редактирование товара</span></div>
                            <div class="card-body">
                                <div class="row">
                                    @if($product->image)
                                        <p>Изоброжение:</p>
                                        <div class="form-group has-feedback">
                                            <form action="{{route('deleteimage', $product->id)}}"
                                                  method="post">
                                                <button class="btn text-danger">x</button>
                                                @csrf
                                                @method('put')
                                            </form><br>
                                            <img src="/images/{{$product->image}}"
                                                 class="img-responsive" width="100px" height="100px" alt="">
                                        </div>
                                    @endif
                                </div><!----><!---->
                                <form action="{{route('products.update', $product)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group has-feedback">
                                        <label for="image">Выберите фото</label>
                                        <input type="file" name="image">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="title">Название продукта</label>
                                        <input type="text" name="title" value="{{$product->title}}" class="form-control"
                                               placeholder="название продукта" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="name">Выберите категорию</label>
                                        <select name="category_id" id="">
                                            <option value=""></option>
                                            @foreach($categories as $category)
                                                @if($category->title == $product->category->title)
                                                    <option selected value="{{ $category->id }}">{{ $category->title }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="vendor_code">Артикул</label>
                                        <input type="text" name="vendor_code" value="{{$product->vendor_code}}" class="form-control"
                                               placeholder="Введите артикул">
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="code">Штрихкод</label>
                                        <input type="text" name="code" value="{{$product->code}}" class="form-control"
                                               placeholder="Введите штрихкод" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <select name="storage_id" id="">
                                            <option  value="">Склад</option>
                                            @foreach($storages as $storage)
                                                @if($storage->title == $product->storage->title)
                                                    <option selected value="{{$storage->id}}">{{$storage->title}}</option>
                                                @else
                                                <option value="{{$storage->id}}">{{$storage->title}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success" type="submit">
                                            Сохранить
                                        </button>
                                    </div>
                                </form>
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>
@endsection
