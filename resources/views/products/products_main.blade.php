@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Список товаров</h1>
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
                                    <div class="col-auto">
                                        <div class="row no-gutters align-items-center"><h1
                                                class="col-auto subheader__title">
                                            </h1>
                                            <div class="col-auto subheader__breadcrumbs">
                                                <ol id="breadcrumbs" class="breadcrumb page-breadcrumb">
                                                    <li class="breadcrumb-item"><a href="{{route('products.index')}}"
                                                                                   target="_self">Товар</a>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#"
                                                                                   class="active"
                                                                                   target="_self">Услуга</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location"><a href="#"
                                                                                       class="active"
                                                                                       target="_self">Составной товар</a></span>
                                                    </li>
                                                    <li class="breadcrumb-item"><a href="#"
                                                                                   class="active"
                                                                                   target="_self">Универсальный
                                                            товар</a></li>
                                                    <li class="breadcrumb-item"><a href="#"
                                                                                   class="active"
                                                                                   target="_self">Архив</a></li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                    <div class="buttons mb-3">
                        <a href="{{route('products.create')}}">
                            <button id="employee_action_create" type="button" class="btn btn-primary">
                                Добавить товар
                            </button>
                        </a>
                        <a href="#">
                            <button id="employee_action_create" type="button" class="btn btn-primary">
                                Загрузить товар
                            </button>
                        </a>
                    </div>

                    <div class="card card-with-table"><!---->
                        <div class="card-header"><span class="card-header-title">Товары</span></div>
                        <div class="card-header">
                            <form action="{{route('products.index')}}" method="get">
                                <div class="row">
                                    <div class="form-label">Склад</div>
                                    <select name="storage_id">
                                        <option value="">Склад</option>
                                        @foreach($storages as $storage)
                                        <option value="{{$storage->id}}" @if(isset($_GET['storage_id'])) @if($_GET['storage_id'] == $storage->id) selected @endif @endif>{{$storage->title}}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <div>
                                            <div class="form-group" aria-placeholder="Категория">
                                                <select name="category_id">

                                                    <option value="">Выбирите Категорию</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(isset($_GET['category_id'])) @if($_GET['category_id'] == $category->id) selected @endif @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div tabindex="-1" class="multiselect__content-wrapper"
                                                 style="max-height: 400px; display: none;">
                                            </div>
                                        </div>
                                    </div>


                                    <div><input name="search_field_title" @if(isset($_GET['search_field_title'])) value="{{$_GET['search_field_title']}}" @endif id="filter_product_or_service_name" type="text"
                                                placeholder="Наименование товара" class="form-control"><!---->
                                    </div>


                                    <div><input name="search_field_vendor" @if(isset($_GET['search_field_vendor'])) value="{{$_GET['search_field_vendor']}}" @endif id="filter_vendor_code" type="text" placeholder="Артикул"
                                                class="form-control"><!----><!----><!----></div>


                                    <div>
                                        <input name="search_field_code" @if(isset($_GET['search_field_code'])) value="{{$_GET['search_field_code']}}" @endif id="filter_barcode" type="text" placeholder="Штрихкод"
                                               class="form-control">
                                    </div>


                                    <div>
                                        <div class="custom-control custom-checkbox"><input
                                                id="filter_product_in_stock" type="checkbox"
                                                class="custom-control-input" value="true"><label
                                                for="filter_product_in_stock" class="custom-control-label">
                                                В наличии
                                            </label></div><!----><!----><!----></div>


                                    <div>
                                        <button id="itemTableFilter_form_btn_submit" type="submit"
                                                class="btn btn-outline-primary">
                                            Найти
                                        </button>
                                    </div>


                                    <div>
                                        <button id="itemTableFilter_form_btn_reset" type="reset"
                                                class="btn btn-outline-secondary">
                                            Сбросить
                                        </button><!----><!----><!----></div>

                                </div>
                            </form>
                        </div>
                        <div class="card-body"><!----><!---->

                            <table aria-busy="false" id="employeeTable" role="table" aria-colcount="4"
                                   class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                <!---->
                                <thead role="rowgroup" class=""><!---->
                                <tr role="row" class="">
                                    <th role="columnheader" scope="col" aria-colindex="1" class="">
                                        <div>Фото</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="2" class="">
                                        <div>Название</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="3" class="">
                                        <div>Артикул</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="4" class="">
                                        <div>Категория</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="5"
                                        aria-label="Ui Actions"
                                        class="">
                                        <div>Штрихкод</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="6"
                                        aria-label="Ui Actions"
                                        class="">
                                        <div>Количество</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="6"
                                        aria-label="Ui Actions"
                                        class="">
                                        <div>Цена продажи</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="7"
                                        aria-label="Ui Actions"
                                        class="">
                                        <div>Действия</div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody role="rowgroup"><!---->
                                @foreach($products as $item)
                                        @foreach($item->acceptances as $product)
                                    <tr role="row" class="">
                                        <td aria-colindex="1" data-label="Фото" role="cell" class="">
                                            <img src="images/{{$product->product->image ?? "no_image.jpg"}}" width="30" height="30" alt="">
                                        </td>

                                        <td aria-colindex="2" data-label="Название" role="cell" class="">
                                            <div>{{$product->product->title ?? ''}}</div>
                                        </td>
                                        <td aria-colindex="3" data-label="Артикуль" role="cell" class="">
                                            <div>{{$product->product->vendor_code ?? ''}}</div>
                                        </td>
                                        <td aria-colindex="4" data-label="Категория" role="cell" class="">
                                            <div>
                                                {{$product->product->category->title ?? ''}}
                                            </div>
                                        </td>
                                        <td aria-colindex="4" data-label="Штрих код" role="cell" class="">
                                            <div>
                                                {{$product->product->code ?? ''}}
                                            </div>
                                        </td>
                                        <td aria-colindex="5" data-label="Количество" role="cell" class="">
                                            <div>
                                                {{$product->count ?? ''}}
                                            </div>
                                        </td>
                                        <td aria-colindex="6" data-label="Цена продажи" role="cell" class="">
                                            <div>
                                                {{($product->price + (($product->price * $product->margin)/100)) ?? ''}} ₸
                                            </div>
                                        </td>
                                        <td aria-colindex="7" data-label="Действия" role="cell" class="">
                                            <form action="{{route('products.destroy', $product->product->id)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-xs" type="submit">Удалить
                                                </button>
                                            </form>
                                            <a href="{{route('products.edit', $product->product->id)}}">
                                                <button class="btn btn-secondary btn-xs" type="submit">
                                                    Редактировать
                                                </button>
                                            </a>
                                        </td>
                                        @endforeach
                                        @endforeach
                                    </tr><!----><!---->

                                </tbody><!---->
                            </table>
                            {{$products->withQueryString()->links()}}
                        </div>
                    </div><!----><!---->
                    <div class="row">
                        <div class="col mr-auto"><!----></div> <!----></div>
                </div>
            </main>
        </section>
    </div>
@endsection
