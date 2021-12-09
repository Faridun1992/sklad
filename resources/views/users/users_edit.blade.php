@extends('main.index')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактирование сотрудника {{$worker->name}}</h1>
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
                                                    <li class="breadcrumb-item"><a href="{{route('users.index')}}"
                                                                                   class="active"
                                                                                   target="_self">Сотрудники</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Редактирование сотрудника {{$worker->name}}</span>
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
                            <div class="card-header"><span class="card-header-title">Сотрудники</span></div>
                            <div class="card-body"><!----><!---->
                                <form action="{{route('users.update', $worker)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group has-feedback">
                                        <label for="name">Имя сотрудника</label>
                                        <input type="text" name="name" value="{{$worker->name}}" class="form-control"
                                               placeholder="Введите имя сотрудника" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="email">Электронная почта</label>
                                        <input type="email" name="email" value="{{$worker->email}}" class="form-control"
                                               placeholder="Почта сотрудника" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label for="phone">Телефон сотрудника</label>
                                        <input type="text" name="phone" value="{{$worker->phone}}" class="form-control"
                                               placeholder="Введите в формате +7 777 000 00 00" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_id">Выбирите категорию</label>
                                        <select class="form-control select2" name="role_id">
                                            @foreach($roles as $role)
                                                @if($role->title == $worker->role->title)
                                                    <option selected value="{{ $role->id }}">{{ $role->title }}</option>
                                                @else
                                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>
                                            <input type="hidden" name="status" value="0">
                                            <input type="checkbox" name="status"
                                                   value="1" {{($worker->status) ? 'checked' : '0'}}>

                                            Текущий работник
                                        </label>
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
