@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Editează detalii Vuforia
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    @include('common.errors')

                    <form class="form-horizontal" method="POST"
                          action="{!! route('update-vuforia', ['id' => $vuforia->vuforia_id]) !!}"
                          enctype="multipart/form-data" role="form">

                        {!! csrf_field() !!}

                        <div class="form-group @if ($errors->has('museum_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="class_museum_id">Muzeu <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="museum-id" class="form-control" id="class_museum_id">
                                    <option value="{{ $vuforia->museum_id }}" selected>{{ $vuforia->museum->name }}</option>
                                    @foreach ($museums as $museum)
                                        @if ($museum->museum_id != $vuforia->museum_id)
                                        <option value="{!! $museum->museum_id !!}" @if (null !== old('museum_id')
                                        && $museum->museum_id == old('museum_id')) selected @endif>{!! $museum->name !!}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('version'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="name">Versiune <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="version" id="version" value="{{ $vuforia->version }}" class="form-control" placeholder="1.0">
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
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizează</button>
                            </div>
                        </div>

                        <div class="text-danger">* Aceste câmpuri sunt obligatorii!</div>
                    </form>
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