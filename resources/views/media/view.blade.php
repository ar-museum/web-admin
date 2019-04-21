@extends('layouts.app')
@section('content')
    <!-- MEDIA TABLE -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Media
                    <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
                </header>
                <div class="panel-body">
                    @if (count($medias))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-media">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Path</th>
                                    <th>Detalii</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medias as $media)
                                    <tr>
                                        <td>{!! $media->media_id !!}</td>
                                        <td>{{ $media->path }}</td>
                                        <td>
                                            @if (strpos($media->path, '/photo/') !== false)
                                                Photo
                                            @else
                                                @if (strpos($media->path, '/audio/') !== false)
                                                    Audio
                                                @else
                                                    @if (strpos($media->path, '/video/') !== false)
                                                        Video
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($media->created_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizeaza datele"
                                               href="{!! route('change_pass', ['code' => $media->media_id]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger btn-xs btn-delete" title="Sterge"
                                               href="{!! route('delete-media', ['var' => $media->media_id]) !!}">
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
                            <strong>Atentie!</strong> Nu exista media.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <!-- Display Validation Errors -->
        @include('common.errors')
        @if(\Session::has('success'))
            <div class="alert alert-success">
                <p>
                    {{\Session::get('success')}}
                </p>
            </div>
        @endif
    </div>
    <!-- ADD PHOTO -->
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga photo
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/store_photo" enctype="multipart/form-data" role="form">
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
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adauga photo</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                        <div class="text-danger">* Aceste campuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- ADD AUDIO -->
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga audio
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/store_audio" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group col-lg-10">
                            <label class="col-lg-4 col-sm-4 control-label" for="audio">
                                Audio
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-lg-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 150px;">
                                            </div>
                                            <span class="fileinput-new"><i class="fa fa-music"></i> Alege audio</span>
                                            <input type="file" name="audio" id="audio">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Sterge
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adauga audio</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                        <div class="text-danger">* Aceste campuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <!-- ADD VIDEO -->
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga video
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/store_video" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group col-lg-10">
                            <label class="col-lg-4 col-sm-4 control-label" for="video">
                                Video
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-lg-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 150px;">
                                            </div>
                                            <span class="fileinput-new"><i class="fa fa-video-camera"></i> Alege video</span>
                                            <input type="file" name="video" id="video">
                                        </span>
                                        <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                            <i class="fa fa-trash-o"></i> Sterge
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adauga video</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                        <div class="text-danger">* Aceste campuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/media/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection