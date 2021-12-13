@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Список складов</h1>
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
                                                    <li class="breadcrumb-item">Склады</li>
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
                        <a href="{{route('storages.create')}}">
                            <button id="employee_action_create" type="button" class="btn btn-primary">
                                Добавить склад
                            </button>
                        </a>
                    </div>
                    <div>
                        <div class="card card-with-table"><!---->
                            <div class="card-header"><span class="card-header-title">Склады</span></div>
                            <div class="card-body"><!----><!---->
                                <div class="">
                                    <table aria-busy="false" id="employeeTable" role="table" aria-colcount="4"
                                           class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                        <!---->
                                        <thead role="rowgroup" class=""><!---->
                                        <tr role="row" class="">
                                            <th role="columnheader" scope="col" aria-colindex="1" class="">
                                                <div>Название</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="2" class="">
                                                <div>Адресс</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="3" class="">
                                                <div>Товары на сумму</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="4" class="">
                                                <div>Статус</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="5"
                                                aria-label="Ui Actions"
                                                class="">
                                                <div>Действия</div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody role="rowgroup"><!---->
                                        @foreach($storages as $storage)

                                            <tr role="row" class="">

                                                <td aria-colindex="1" data-label="Название" role="cell" class="">
                                                    <a href="{{route('products.index', ['storage_id' => $storage->id])}}"><div>{{$storage->title}}</div></a>
                                                </td>
                                                <td aria-colindex="2" data-label="Адресс" role="cell" class="">
                                                    <div>{{$storage->address}}</div>
                                                </td>
                                                <td aria-colindex="3" data-label="Товары на сумму" role="cell" class="">
                                                    <div>{{$storage->acceptances_sum_total_buying_price}} ₸</div>
                                                </td>
                                                <td aria-colindex="4" data-label="Адресс" role="cell" class="">
                                                    <div>{{$storage->status == false ? 'не работает' : 'работает'}}</div>
                                                </td>

                                                <td aria-colindex="5" data-label="Телефон" role="cell"
                                                    class="">
                                                    <div class="btn-group" role="group">
                                                        <div class="col-md-4 custom ">
                                                            <form action="{{route('storages.destroy', $storage)}}"
                                                                  method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger btn-xs" type="submit">
                                                                    Удалить
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-4 custom">
                                                            <a href="{{route('storages.edit', $storage)}}">
                                                                <button class="btn btn-secondary btn-xs" type="submit">
                                                                    Редактировать
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>

                                                @endforeach
                                            </tr><!----><!---->

                                        </tbody><!---->
                                    </table>
                                </div>
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>
@endsection
