@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">Modifică categorie
                <span class="tools pull-right">
                    <a href="javascript:;" class="fa fa-chevron-down"></a>
                </span>
            </header>
            <div class="panel-body">
                @include('common.errors')
                <form class="form-horizontal" method="POST"
                      action="{!! route('update-category', ['id' => $category_selected->category_id]) !!}"
                      enctype="multipart/form-data" role="form">

                    {!! csrf_field() !!}

                    <div class="form-group @if ($errors->has('category_id'))has-error @endif">
                        <label class="col-lg-4 col-sm-4 control-label" for="old-name">Categorie veche <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select name="category_id" class="form-control">
                                <option value="{{ $category_selected->category_id }}" selected>{{ $category_selected->name }}</option>
                                @foreach ($categories as $category)
                                    <option value="{!! $category->category_id !!}" @if (null !== old('category_id')
                                        && $category->name == old('category_id')) selected @endif>{!! $category->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 col-sm-4 control-label" for="name">Categorie nouă <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Noul nume al categoriei">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-sm-12 text-right">
                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetabiliește</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Modifică</button>
                        </div>
                    </div>

                    <div class="text-danger">* Aceste câmpuri sunt obligatorii!</div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection

@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.js') !!}"></script>
    <script src="{!! asset('/js/category/index.js') !!}"></script>
@endsection