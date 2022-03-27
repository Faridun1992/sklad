@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Перемещение позиций</h1>
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
                            <div class="col-auto"></div>
                        </div>
                    </div>
                    <div class="buttons mb-3">
                        <button id="create" type="button" class="btn btn-primary">
                            Создать перемещение
                        </button>
                    </div>
                    <div class="card card-with-table" id="movement" style="display: none">
                        <div class="card-header">
                            <div class="card-body pb-1">
                                <form class="row">
                                    <fieldset class="form-group col-sm">
                                        <div>
                                            <div role="group" class="input-group">
                                                <div class="form-group col-md-2">
                                                    <select class="form-control" name="storage_id"
                                                            id="select1" onchange="getSelectValue(this.value);">
                                                        <option value="">Из склада</option>
                                                        @foreach($storages as $storage)
                                                            <option
                                                                value="{{$storage->id}}">{{$storage->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-2">
                                                    <select class="form-control" name="storage2_id"
                                                            id="select2">
                                                        <option value="">В склад</option>
                                                        @foreach($storages as $storage)
                                                            <option
                                                                value="{{$storage->id}}">{{$storage->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group col-auto">
                                        <div>
                                            <button type="submit" class="btn btn-success"
                                                    formaction="{{route('movements.create', ['storage1_id' => $storage->id, 'storage2_id' => $storage->id])}}">
                                                Выбрать
                                            </button>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card card-with-table"><!---->
                        <div class="card-header"><span class="card-header-title">Список перемещений</span></div>
                        <div class="card-header">
                            <form action="{{route('movements.index')}}" method="get">
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <input name="search_field_title"
                                               @if(isset($_GET['search_field_title'])) value="{{$_GET['search_field_title']}}"
                                               @endif id="filter_product_or_service_name" type="text"
                                               placeholder="Наименование товара" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select id="inputState" class="form-control" name="storage_id">
                                            <option value="">Выберите период</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select class="form-control" name="storage_id" id="select3" onchange="getSelectVal(this.value);">
                                            <option value="">Из склада</option>
                                            @foreach($storages as $storage)
                                                <option value="{{$storage->id}}"
                                                        @if(isset($_GET['storage_id']) && $_GET['storage_id'] == $storage->id) selected @endif >{{$storage->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select  class="form-control" name="storage2_id" id="select4">
                                            <option value="">В склад</option>
                                            @foreach($storages as $storage)
                                                <option value="{{$storage->id}}"
                                                        @if(isset($_GET['storage2_id']) && $_GET['storage2_id'] == $storage->id) selected @endif >{{$storage->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <input name="search_field_vendor"
                                               @if(isset($_GET['search_field_vendor'])) value="{{$_GET['search_field_vendor']}}"
                                               @endif id="filter_vendor_code" type="text" placeholder="Сотрудник"
                                               class="form-control">
                                    </div>
                                    <div class="form-group col-md-1.5">
                                        <button type="submit" class="btn btn-primary">Найти</button>
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
                                        <div>Номер документа</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="2" class="">
                                        <div>Из склада</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="3" class="">
                                        <div>В склад</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="4" class="">
                                        <div>Коментарий</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="5" class="">
                                        <div>Дата</div>
                                    </th>
                                    <th role="columnheader" scope="col" aria-colindex="7"
                                        aria-label="Ui Actions"
                                        class="">
                                        <div>Действия</div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody role="rowgroup">
                                @foreach($movements as $movement)
                                    <tr role="row" class="">
                                        <td aria-colindex="1" data-label="Номер документа" role="cell" class="">
                                            <div>{{$movement->id}}</div>
                                        </td>
                                        <td aria-colindex="2" data-label="Из склада" role="cell" class="">
                                            <div>{{$movement->storage1->title}}</div>
                                        </td>
                                        <td aria-colindex="3" data-label="В Склад" role="cell" class="">
                                            <div>{{$movement->storage2->title}}</div>
                                        </td>
                                        <td aria-colindex="4" data-label="Комментарий" role="cell" class="">
                                            <div>
                                                {{$movement->comment}}
                                            </div>
                                        </td>
                                        <td aria-colindex="4" data-label="Дата" role="cell" class="">
                                            <div>
                                                {{$movement->created_at->format('d.m.Y, h:m')}}
                                            </div>
                                        </td>
                                        <td aria-colindex="5" data-label="Действия" role="cell" class="">
                                            <a href="{{route('movement.show', $movement)}}">
                                                <button class="btn btn-secondary btn-xs" type="submit">
                                                    Просмотр
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody><!---->
                            </table>
                            {{$movements->withQueryString()->links()}}
                        </div>
                    </div><!----><!---->
                    <div class="row">
                        <div class="col mr-auto"><!----></div> <!----></div>
                </div>
            </main>
        </section>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#create').click(function () {
                $('#movement').toggle(500);
            });
        });

        function getSelectValue(select1) {
            if (select1 != '') {
                $("#select2 option[value='" + select1 + "']").hide();
                $("#select2 option[value!='" + select1 + "']").show();
            }
        }
        function getSelectVal(select3) {
            if (select3 != '') {
                $("#select4 option[value='" + select3 + "']").hide();
                $("#select4 option[value!='" + select3 + "']").show();
            }
        }
    </script>


@endsection
