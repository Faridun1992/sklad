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
                    </div>

                    <div class="card card-with-table"><!---->
                        <div class="card-header"><span class="card-header-title">Товары</span></div>
                        <div class="card-header">
                            <form action="{{route('products.index')}}" method="get">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <select id="inputState" class="form-control" name="storage_id">
                                            <option value="">Выберите склад</option>
                                            @foreach($storages as $storage)
                                                <option value="{{$storage->id}}"
                                                        @if(isset($_GET['storage_id'])) @if($_GET['storage_id'] == $storage->id) selected @endif @endif>{{$storage->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select id="inputState" class="form-control" name="category_id">
                                            <option value="">Выберите категорию</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}"
                                                        @if(isset($_GET['category_id'])) @if($_GET['category_id'] == $category->id) selected @endif @endif>{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <input name="search_field_title"
                                               @if(isset($_GET['search_field_title'])) value="{{$_GET['search_field_title']}}"
                                               @endif id="filter_product_or_service_name" type="text"
                                               placeholder="Наименование товара" class="form-control">
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <input name="search_field_vendor"
                                               @if(isset($_GET['search_field_vendor'])) value="{{$_GET['search_field_vendor']}}"
                                               @endif id="filter_vendor_code" type="text" placeholder="Артикул"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <input name="search_field_code"
                                               @if(isset($_GET['search_field_code'])) value="{{$_GET['search_field_code']}}"
                                               @endif id="filter_barcode" type="text" placeholder="Штрихкод"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-0.5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"> Наличие
                                        </div>
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <button type="submit" class="btn btn-primary">Поиск</button>
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <button type="reset" class="btn btn-primary">Сбросить</button>
                                    </div>

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

                                <tbody role="rowgroup">

                                @forelse($products as $product)
                                    <tr role="row" class="">
                                        <td aria-colindex="1" data-label="Фото" role="cell" class="">
                                            <img src="images/{{$product->image ?? "no_image.jpg"}}"
                                                 width="30" height="30" alt="">
                                        </td>

                                        <td aria-colindex="2" data-label="Название" role="cell" class="">
                                            <div>{{$product->title}}</div>
                                        </td>
                                        <td aria-colindex="3" data-label="Артикуль" role="cell" class="">
                                            <div>{{$product->vendor_code ?? ''}}</div>
                                        </td>
                                        <td aria-colindex="4" data-label="Категория" role="cell" class="">
                                            <div>
                                                {{$product->category->title}}
                                            </div>
                                        </td>
                                        <td aria-colindex="4" data-label="Штрих код" role="cell" class="">
                                            <div>
                                                {{$product->code}}
                                            </div>
                                        </td>
                                        <td aria-colindex="5" data-label="Количество" role="cell" class="">
                                            <div>
                                                {{$product->acceptances_sum_count ?? 0}}
                                            </div>
                                        </td>
                                        <td aria-colindex="6" data-label="Общая сумма" role="cell" class="">
                                            <div>
                                                {{$product->lastAcceptance->selling_price ?? 0}} ₸
                                            </div>
                                        </td>
                                        <td aria-colindex="7" data-label="Действия" role="cell" class="">
                                            <form action="{{route('products.destroy', $product)}}"
                                                  method="POST">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-xs" type="submit">Удалить
                                                </button>
                                            </form>
                                            <a href="{{route('products.edit', $product)}}">
                                                <button class="btn btn-secondary btn-xs" type="submit">
                                                    Редактировать
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row">
                                        <td colspan="8">Такого товара в базе данных нет</td>
                                    </tr>
                                @endforelse

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
