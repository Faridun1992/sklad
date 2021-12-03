@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Категории</h1>
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto"></div>
                        </div>
                    </div>
                    <div class="buttons mb-3">
                        <a href="{{route('categories.create')}}">
                            <button id="employee_action_create" type="button" class="btn btn-primary">
                                Добавить категорию товара
                            </button>
                        </a>
                    </div>
                    <div>
                        <div class="card card-with-table"><!---->
                            <div class="card-header"><span class="card-header-title">Категории</span></div>
                                <div class="">
                                    <table aria-busy="false" id="employeeTable" role="table" aria-colcount="4"
                                           class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                        <!---->
                                        <thead role="rowgroup" class=""><!---->
                                        <tr role="row" class="">
                                            <th role="columnheader" scope="col" aria-colindex="1" class="">
                                                <div>Название категории</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="2" class="">
                                                <div>Количество товаров</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="4"
                                                aria-label="Ui Actions"
                                                class="">
                                                <div>Действия</div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody role="rowgroup"><!---->
                                        @foreach($categories as $category)

                                            <tr role="row" class="">

                                                <td aria-colindex="1" data-label="Название" role="cell" class="">
                                                    <div>{{$category->title}}</div>
                                                </td>
                                                <td aria-colindex="2" data-label="Количество товаров" role="cell" class="">
                                                    <div>{{$category->products_count ?? 0}}</div>
                                                </td>

                                                <td aria-colindex="4" data-label="действие" role="cell" class="">
                                                    <form action="{{route('categories.destroy', $category)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-xs" type="submit">Удалить
                                                        </button>
                                                    </form>
                                                    <a href="{{route('categories.edit', $category)}}">
                                                        <button class="btn btn-secondary btn-xs" type="submit">
                                                            Редактировать
                                                        </button>
                                                    </a>
                                                </td>

                                                @endforeach
                                            </tr><!----><!---->

                                        </tbody><!---->
                                    </table>
                                </div>
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div>
            </main>
        </section>
    </div>
@endsection
