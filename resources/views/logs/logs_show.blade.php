@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Лог </h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
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
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location"><a href="{{route('roles.index')}}"></a> Логи</span></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Лог </span></li>
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
                            <div class="card-header"><span class="card-header-title">Логи</span></div>
                            <div class="card-body"><!----><!---->
                                <div class="">
                                    <table aria-busy="false" id="employeeTable" role="table" aria-colcount="4"
                                           class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                        <!---->
                                        <thead role="rowgroup" class=""><!---->
                                        <tr role="row" class="">
                                            <th role="columnheader" scope="col" aria-colindex="1" class="">
                                                <div>ID</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="2" class="">
                                                <div>Пользователь</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="3" class="">
                                                <div>Действие</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="4" class="">
                                                <div>Дата</div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody role="rowgroup"><!---->

                                            <tr role="row" class="">
                                                <td aria-colindex="1" data-label="ID" role="cell" class="">
                                                    <div></div>
                                                </td>

                                                <td aria-colindex="2" data-label="Имя" role="cell" class="">
                                                    <div></div>
                                                </td>
                                                <td aria-colindex="3" data-label="Должность" role="cell" class="">
                                                    <div></div>
                                                </td>
                                                <td aria-colindex="4" data-label="Телефон" role="cell" class="">
                                                    <div>

                                                    </div>
                                                </td>
                                            </tr><!----><!---->

                                        </tbody><!---->
                                    </table>
                                    {{--                 {{$workers->links()}}--}}
                                </div>
                            </div><!----><!----></div>
                        <div class="row">
                            <div class="col mr-auto"><!----></div> <!----></div>
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>

@endsection
