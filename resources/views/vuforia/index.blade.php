@extends('layouts.app')

@section('content')
    <!-- Add Vuforia details -->
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Adaugă detalii Vuforia
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/vuforia/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('museum_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="class_museum_id">Muzeu <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="museum-id" class="form-control" id="class_museum_id">
                                    <option value="" disabled selected>Alege muzeul</option>
                                    @foreach ($museums as $museum)
                                        <option value="{!! $museum->museum_id !!}" @if (null !== old('museum_id')
                                        && $museum->museum_id == old('museum_id')) selected @endif>{!! $museum->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('version'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="name">Versiune <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="version" id="version" value="{{ old('version') }}" class="form-control" placeholder="1.0">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('file_id'))has-error @endif">
                            <label class="control-label col-lg-4 col-md-4">Fișier <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileinput-new"><i class="fa fa-file-o"></i> Alege fișier</span>
                                            <span class="fileinput-exists"><i class="fa fa-undo"></i> Schimbă</span>
                                            <input type="file" name="file" id="file" value="">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Șterge
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12 col-sm-12 text-right">
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetează</button>
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adaugă</button>
                            </div>
                        </div>

                        <div class="text-danger">* Aceste câmpuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- Vuforia table -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Detalii Vuforia
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (count($vuforias))
                        <div class="adv-table">
                            <table id="table-vuforia" class="display table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nr. crt.</th>
                                        <th>Muzeu</th>
                                        <th>Versiune</th>
                                        <th>Cale fișier</th>
                                        <th>Tip fișier</th>
                                        <th>Dată adăugare</th>
                                        <th>Ultima modificare</th>
                                        <th>Acțiune</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($vuforias as $vuforia)
                                    <tr>
                                        <td>{!! $vuforia->vuforia_id !!}</td>
                                        <td>{!! $vuforia->museum->name !!}</td>
                                        <td>{!! $vuforia->version !!}</td>
                                        <td>{!! $vuforia->file->path !!}</td>
                                        <td>{!! strtoupper(substr($vuforia->file->path, -3)) !!}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($vuforia->created_at)) !!}</td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($vuforia->updated_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizează rând"
                                               href="{!! route('edit-vuforia', ['id' => $vuforia->vuforia_id]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs btn-delete" title="Șterge rând"
                                               data-action="deleteVuforia" data-action-id="{!! $vuforia->vuforia_id !!}">
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
                            <strong>Atenție!</strong> Nu există date referitoare la Vuforia.
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
    <script src="{!! asset('/js/vuforia/index.js') !!}"></script>
@endsection