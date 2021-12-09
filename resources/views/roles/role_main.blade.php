@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Список сотрудников</h1>
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
                                                    <li class="breadcrumb-item"><a href="{{route('roles.index')}}"
                                                                                   class="active"
                                                                                   target="_self">Должности</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Текущие</span></li>
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
                        <a href="{{route('roles.create')}}">
                            <button id="employee_action_create" type="button" class="btn btn-primary">
                                Добавить должность
                            </button>
                        </a>
                    </div>
                    <ul class="nav nav-underlined flex-lg-wrap flex-nowrap mb-6">
                        <li id="employee_tab_current_index" class="nav-item"><a href="{{route('users.index')}}"
                                                                                class="nav-link exact-active active"
                                                                                target="_self" aria-current="page">
                                Текущие
                            </a></li>
                        <li id="employee_tab_old_index" class="nav-item"><a
                                href="{{route('users.index', ['status' => false])}}" class="nav-link"
                                target="_self">
                                Бывшие
                            </a></li>
                        <li id="employee_tab_role" class="nav-item"><a href="{{route('roles.index')}}" class="nav-link"
                                                                       target="_self">
                                Должности
                            </a></li>
                    </ul>
                    <div>
                        <div class="card card-with-table"><!---->
                            <div class="card-header"><span class="card-header-title">Должности</span></div>
                            <div class="card-body"><!----><!---->
                                <div class="">
                                    <table aria-busy="false" id="employeeTable" role="table" aria-colcount="4"
                                           class="table b-table table-striped table-hover b-table-stacked-lg"><!---->
                                        <!---->
                                        <thead role="rowgroup" class=""><!---->
                                        <tr role="row" class="">
                                            <th role="columnheader" scope="col" aria-colindex="1" class="">
                                                <div>Название должности</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="2" class="">
                                                <div>Количество сотрудников</div>
                                            </th>
                                            <th role="columnheader" scope="col" aria-colindex="4"
                                                aria-label="Ui Actions"
                                                class="">
                                                <div>Действия</div>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody role="rowgroup"><!---->
                                        @foreach($roles as $role)

                                            <tr role="row" class="">

                                                <td aria-colindex="1" data-label="Имя" role="cell" class="">
                                                    <div>{{$role->title}}</div>
                                                </td>
                                                <td aria-colindex="2" data-label="Должность" role="cell" class="">
                                                    <div>{{$role->workers_count}}</div>
                                                </td>

                                                <td aria-colindex="4" data-label="Телефон" role="cell" class="">
                                                    <form action="{{route('roles.destroy', $role)}}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger btn-xs" type="submit">Удалить
                                                        </button>
                                                    </form>
                                                    <a href="{{route('roles.edit', $role)}}">
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
                    </div> <!----> <!----></div>
            </main>
        </section>
    </div>
@endsection
