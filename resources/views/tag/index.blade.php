@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- Add tag -->
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Adaugă etichetă
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/tag/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Nume etichetă">
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

        <!-- Modify tag -->
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Modifică etichetă
                    <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
                </header>
                <div class="panel-body">
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/tag/edit" enctype="multipart/form-data" role="form">
                        <div class="form-group col-lg-12">
                            Alege cel puțin una dintre cele două modalități de selectare a unei etichete.
                        </div>
                        <div class="form-group @if ($errors->has('tag_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="tag_id">ID etichetă <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="tag_od" class="form-control">
                                    <option value="-1">Alege o etichetă după ID</option>
                                    @foreach ($tags as $tag)
                                        <option value="{!! $tag->tag_id !!}" @if (null !== old('tag_id')
                                        && $tag->tag_id == old('tag_id')) selected @endif>{!! $tag->tag_id !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="tag_id">Nume etichetă <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="name" class="form-control">
                                    <option value="-1">Alege o etichetă după Nume</option>
                                    @foreach ($tags as $tag)
                                        <option value="{!! $tag->name !!}" @if (null !== old('name')
                                        && $tag->name == old('name')) selected @endif>{!! $tag->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Noul nume al etichetei">
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
    </div>

    <!-- All tags -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Etichete
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (count($tags))
                        <div class="adv-table">
                            <table id="table-tags" class="display table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nr. crt.</th>
                                        <th>Nume</th>
                                        <th>Dată adăugare</th>
                                        <th>Ultima modificare</th>
                                        <th>Acțiune</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{!! $tag->tag_id !!}</td>
                                        <td>{{ $tag->name }}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($tag->created_at)) !!}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($tag->updated_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizează rând" href="">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs btn-delete" title="Șterge rând"
                                               data-action="deleteTag" data-action-id="{!! $tag->tag_id !!}">
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
                            <strong>Atenție!</strong> Nu există nicio etichetă.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection

@section('js')
    <script src="{!! asset('/js/tag/index.js') !!}"></script>
@endsection