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
                                    <div class="card-body pb-1">
                                    @if($product->image)

                                        <div class="form-group has-feedback">

                                            <form action="{{route('deleteimage', $product->id)}}"
                                                  method="post">
                                                <p>Изоброжение:</p>
                                                @csrf
                                                @method('put')
                                                <img src="/images/{{$product->image}}" class="img-responsive" width="100px" height="100px"><button class="btn text-danger">x</button>
                                            </form>
                                        </div>
                                    @endif
                                    </div>
                                </div><!----><!---->
                                <form action="{{route('products.update', $product)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                            <div class="card-body pb-1">
                                                <input type="hidden" name="product_id"
                                                        value="{{$product->id}}">
                                                <div class="form-group">
                                                    <div class="form-group has-feedback">
                                                        <div class="form-group">
                                                            <label for="image">Выберите фото</label>
                                                            <input type="file" name="image" class="form-control-file">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="title">Наименование</label>
                                                        <input type="text" name="title"  value="{{$product->title}}"  class="form-control"
                                                               placeholder="Наименование продукта">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Категория</label>
                                                        <select class="form-control" name="category_id">
                                                            <option>Выбрать категорию</option>
                                                            @foreach($categories as $category)
                                                                @if($category->title == $product->category->title)
                                                                    <option value="{{$category->id}}"
                                                                            selected>{{$category->title}}</option>
                                                                @else
                                                                    <option
                                                                        value="{{$category->id}}">{{$category->title}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Ед.измерения</label>
                                                        <select name="unit_id" class="form-control">
                                                            <option>Выбрать ед.измерения</option>
                                                            @foreach($units as $unit)
                                                                @if($unit->id == $product->unit->id)
                                                                    <option selected
                                                                            value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                                @else
                                                                    <option
                                                                        value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <label for="inputAddress">Артикул</label>
                                                        <input type="text" name="vendor_code" value="{{$product->vendor_code}}" class="form-control"
                                                               placeholder="введите артикул">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4">Штрихкод</label>
                                                        <input type="text" value="{{$product->code}}" class="form-control" name="code">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="inputState">Ед.измерения</label>
                                                        <select name="unit_id" class="form-control">
                                                            <option>Выбрать ед.измерения</option>
                                                            @foreach($units as $unit)
                                                                @if($unit->id == $product->unit->id)
                                                                    <option selected
                                                                            value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                                @else
                                                                    <option
                                                                        value="{{$unit->id}}">{{$unit->title."($unit->full_title)"}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                </div>
                                            </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
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
