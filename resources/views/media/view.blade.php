@extends('layouts.app')
@section('content')
    <!-- MEDIA TABLE -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Media games
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
                                    <th>ID</th>
                                    <th>Previzualizare</th>
                                    <th>Cale</th>
                                    <th>Titlu</th>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medias as $media)
                                    @if (strpos($media->path, 'uploads\photo\games') !== false)
                                        <tr>
                                        <td>{!! $media->media_id !!}</td>
                                        <td>
                                            @if (strpos($media->path, '\photo'. DIRECTORY_SEPARATOR) !== false)
                                                <?php
                                                    echo '<img src="'.$media->path.'" width="100" height="80" />';
                                                ?>
                                            @endif
                                        </td>
                                        <td>{{ $media->path }}</td>
                                        <?php
                                            $photoGame = new App\Models\photoGames();
                                            $photoGame->photo_id = $media->media_id;
                                            $titlePhoto = $photoGame->getTitleAttribute();
                                            $width = $photoGame->getWidthAttribute();
                                            $height = $photoGame->getHeightAttribute();
                                        ?>
                                        <td>
                                            {{ $titlePhoto }}
                                        </td>
                                        <td>
                                            {{ $width }}
                                        </td>
                                        <td>
                                            {{ $height }}
                                        </td>
                                        <td>{!! date("Y-m-d H:i:s", strtotime($media->created_at)) !!}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_media" data-action-id="{!! $media->media_id !!}"
                                                    title="Sterge">
                                                <i class="fa fa-trash-o"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @endif
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
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><b>Adauga poze pentru jocuri</b>
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

                            <label class="col-lg-4 col-sm-4 control-label" for="title"> Titlu <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                       class="form-control" placeholder="Titlu">
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

    <!--

    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><b>Adauga audio</b>
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


    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><b>Adauga video</b>
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" action="/store_video" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group col-lg-10">
                            <label class="col-lg-4 col-sm-4 control-label" for="yt_link"> Youtube Link <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="yt_link" id="yt_link" value="{{ old('yt_link') }}"
                                       class="form-control" placeholder="Youtube Link">
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
    -->
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/media/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection