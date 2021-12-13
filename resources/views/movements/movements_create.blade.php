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
                                                    <li class="breadcrumb-item"><a href="{{route('movements.index')}}"
                                                                                   class="active"
                                                                                   target="_self">Перемещение
                                                            позиций</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Создание перемещения</span>
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
                                    <div class="row mb-3">
                                        <fieldset class="form-group col-md-4 col-xxl-3" id="__BVID__539">
                                            <legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0"
                                            >Склад
                                            </legend>
                                            <div>
                                                <div role="group" class="input-group">
                                                    @foreach($storages as $storage)
                                                        <input
                                                            @if(isset($_GET['storage_id']) && $_GET['storage_id'] == $storage->id) value="{{$storage->title}}"
                                                            @else hidden @endif  name="storage_id" type="text"
                                                            disabled="disabled" class="form-control">
                                                    @endforeach
                                                    <div class="input-group-prepend input-group-append">
                                                        <div class="input-group-text">
                                                            <i class="fas fa-angle-right right"></i>
                                                        </div>
                                                    </div>
                                                    @foreach($storages as $storage)
                                                        <input
                                                            @if(isset($_GET['storage2_id']) && $_GET['storage2_id'] == $storage->id) value="{{$storage->title}}"
                                                            @else hidden @endif  name="storage2_id" type="text"
                                                            disabled="disabled" class="form-control">
                                                    @endforeach
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group col-md-2 col-lg-3 col-xxl-2" id="__BVID__542">
                                            <legend tabindex="-1" class="bv-no-focus-ring col-form-label pt-0">
                                                Комментарий
                                            </legend>
                                            <div>
                                                <input type="text" name="comment" class="form-control" id="comment">
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card card-with-table">
                            <div class="card-header">
                                <div class="card-body pb-1">
                                    <form class="row">
                                        <fieldset class="form-group col-sm">
                                            <div>
                                                <div role="group" class="input-group">
                                                    <div class="form-group col-md-4">
                                                        <input type="text" name="product" id="product"
                                                               placeholder="Поиск по названию иди штрихкоду"
                                                               class="form-control">
                                                        <div id="product_list">
                                                            <ul class="list-group d-block position-relative"
                                                                id="productsList" style="z-index: 1">

                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="form-group col-md-1">
                                                        <button type="submit" class="btn btn-primary">
                                                            Завершить
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card card-with-table" style="display: none" id="MyForm">

                            <div class="card-body">
                                <span class="card-header-title"><h5>Список товаров</h5></span>
                                <table aria-busy="false" id="total records" role="table" aria-colcount="4"
                                       class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                    <!---->
                                    <thead role="rowgroup" class=""><!---->
                                    <tr role="row" class="">
                                        <th role="columnheader" scope="col" aria-colindex="1" class="">
                                            <div>№</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="2" class="">
                                            <div>Название</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="5"
                                            aria-label="Ui Actions"
                                            class="">
                                            <div>Штрихкод</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="6"
                                            aria-label="Ui Actions"
                                            class="">
                                            <div>Остаток</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="6"
                                            aria-label="Ui Actions"
                                            class="">
                                            <div>Количество</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="6"
                                            aria-label="Ui Actions"
                                            class="">
                                            <div>Ед.измерения</div>
                                        </th>
                                        <th role="columnheader" scope="col" aria-colindex="7"
                                            aria-label="Ui Actions"
                                            class="">
                                            <div>Действия</div>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody role="rowgroup" id="tbody">


                                    </tbody><!---->
                                </table>
                                {{-- {{$products->withQueryString()->links()}}--}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mr-auto"><!----></div> <!----></div>
                </div> <!----> <!---->
            </main>
        </section>
    </div>
@endsection
@section('script')
    <script>

        $(document).ready(function () {
            const productsList = $('#productsList'),
                showProduct = "{{url('movements')}}",
                myForm = $('#MyForm'),
                searchInput= $('#product');

            let products = []


            searchInput.on('keyup', function () {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {'product': query, products: products},
                    success: function (data) {
                        let html = ''
                        data.forEach(item => {
                            html += renderList(item.id, item.title)
                        })

                        if (data.length === 0) {
                            html = renderList('', 'Ничего не найдено')
                        }

                        productsList.html(html);
                    }
                })
            });

            function renderList(id, title) {
                return (`
                    <li class='list-group-item' style="cursor:pointer" data-id="${id}">${title}</li>
                `)
            }

            $(document).on('click', '.list-group-item', function () {
                $.ajax({
                    url: `${showProduct}/${$(this).data('id')}`,
                    data: ({id: $(this).data('id')}),
                    success: function (data) {
                        myForm.show();
                        searchInput.val('')
                        products.push(data.id)
                        $('#tbody').append(renderRow(data))
                        productsList.html("");

                    }
                })
            });

            $(document).on('click', '.remove', function () {
                products = products.filter(product => product !== $(this).closest('tr').data('id'))
                $(this).closest('tr').remove()

            })

            function renderRow(data) {
                return (`
                     <tr role="row" class="" data-id="${data.id}">
                            <td aria-colindex="1" data-label="№" role="cell" class="">
                                <div>${data.id}</div>
                            </td>

                            <td aria-colindex="2" data-label="Название" role="cell" class="">
                                <div>${data.title}</div>
                            </td>
                            <td aria-colindex="3" data-label="Штрихкод" role="cell" class="">
                                <div>${data.code}</div>
                            </td>
                            <td aria-colindex="4" data-label="Остаток" role="cell" class="">
                                <div></div>
                            </td>
                            <td aria-colindex="4" data-label="Количество" role="cell" class="">
                                <div>

                                </div>
                            </td>
                            <td aria-colindex="5" data-label="Ед.измерения" role="cell" class="">
                                <div>${data.unit.title}</div>
                            </td>
                            <td aria-colindex="7" data-label="Действия" role="cell">
                                <button class="btn btn-danger btn-xs remove" type="submit">Удалить
                                </button>

                            </td>
                    </tr>
`)
            }
        });


    </script>
@endsection
