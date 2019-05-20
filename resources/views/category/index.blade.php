@extends('layouts.app')

<!--
<div class="modal fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: block; padding-right: 0px;">
    <div class="modal-backdrop fade in" style="height: 100vh"></div>
    <div class="modal-dialog ">
        <div class="modal-content-wrap">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Ștergere</h4>
                </div>
                <div class="modal-body">
                    Sunteți sigur că doriți să ștergeți categoria "<span id="delete-category"></span>"?
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Anulează</button>
                    <button class="btn btn-danger" type="button">Confirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
-->

@section('content')
    <div class="row">
        <!-- Add category -->
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Adaugă categorie
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/category/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Nume categorie">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12 text-right">
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetează</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adaugă</button>
                            </div>
                        </div>
                        <div class="text-danger">* Acest câmp este obligatoriu!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- All categories -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Categorii
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (count($categories))
                        <div class="adv-table">
                            <table id="table-categories" class="display table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nr. crt.</th>
                                        <th>Nume</th>
                                        <th>Ultima modificare</th>
                                        <th>Acțiune</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{!! $category->category_id !!}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($category->updated_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizează rând"
                                               href="{!! route('edit-category', ['id' => $category->category_id]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs btn-delete" title="Șterge rând"
                                               data-action="deleteCategory" data-action-id="{!! $category->category_id !!}">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atenție!</strong> Nu există nicio categorie.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script src="{!! asset('/js/category/index.js') !!}"></script>
@endsection