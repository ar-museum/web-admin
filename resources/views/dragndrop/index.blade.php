@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><b>Adauga poze pentru jocuri</b>
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/dragndrop/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group col-lg-10">
                            <label class="col-lg-4 col-sm-4 control-label" for="photo">
                                Poza
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-lg-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><i class="fa fa-picture-o"></i> Alege poza</span>
                                            <span class="fileinput-exists"><i class="fa fa-undo"></i> Schimba</span>
                                            <input type="file" name="photo" id="photo" value="">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Sterge
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('museum_id'))has-error @endif">
                                <label class="col-lg-4 col-sm-4 control-label" for="class_museum_id">Muzeu <span class="text-danger">*</span></label>
                                <div class="col-lg-8">
                                    <select name="museum-id" class="form-control" id="class_museum_id">
                                        <option value="0">Alege un muzeu</option>
                                        @foreach ($museums as $museum)
                                            <option value="{!! $museum->museum_id !!}" @if (null !== old('museum_id')
                                        && $museum->museum_id == old('museum_id')) selected @endif>{!! $museum->name !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adauga poza</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                        <div class="text-danger">* Aceste campuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Dragndrop table -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Detalii Dragndrop
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (count($dragndrops))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-dragndrops">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>ID Muzeu</th>
                                    <th>Versiune</th>
                                    <th>ID fișier</th>
                                    <th>Ultima modificare</th>
                                    <th>Acțiune</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dragndrops as $dragndrop)
                                    <tr>
                                        <td>{!! $dragndrop->dragndrop_id !!}</td>
                                        <td>{!! $dragndrop->museum_id !!}</td>
                                        <td>{!! $dragndrop->path !!}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($dragndrop->created_at)) !!}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($dragndrop->updated_at)) !!}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_dragndrop" data-action-id="{!! $dragndrop->dragndrop_id !!}"
                                                    title="Sterge">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atenție!</strong> Nu există date referitoare la Draganddrop.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection

@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection

@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.js') !!}"></script>
    <script src="{!! asset('/js/dragndrop/index.js') !!}"></script>
@endsection