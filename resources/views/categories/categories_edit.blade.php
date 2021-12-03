@extends('main.index')

@section('content')
    @extends('main.index')

@section('content')
    <<div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Редактирование {{$category->title}}</h1>
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
                                                    <li class="breadcrumb-item"><a href="{{route('categories.index')}}"
                                                                                   class="active"
                                                                                   target="_self">Категории</a></li>
                                                    <li class="breadcrumb-item active"><span
                                                            aria-current="location">Редактрование категории {{$category->title}}</span>
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
                            <div class="card-header"><span class="card-header-title">Добавить новую категорию</span></div>
                            <div class="card-body"><!----><!---->
                                <form action="{{route('categories.update', $category)}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group has-feedback">
                                        <label for="name">Название категории</label>
                                        <input type="text" value="{{$category->title}}" name="title" class="form-control"
                                               placeholder="Введите название категории товара" required>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
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

@endsection
