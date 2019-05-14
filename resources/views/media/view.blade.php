@extends('layouts.app')
@section('content')
    <!-- ALL PHOTO -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">All photo
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                     </span>
                </header>
                <div class="panel-body">
                    @if (count($medias))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-photo">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Previzualizare</th>
                                    <th>Cale</th>
                                    <th>Width</th>
                                    <th>Height</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medias as $media)
                                    @if (strpos($media->path, 'uploads' . DIRECTORY_SEPARATOR . 'photo') !== false)
                                        <tr>
                                            <td>{!! $media->media_id !!}</td>
                                            <td>
                                                @if (strpos($media->path, DIRECTORY_SEPARATOR . 'photo'. DIRECTORY_SEPARATOR) !== false)
                                                    <?php
                                                    echo '<img src="'. $media->path .'" width="100" height="80" />';
                                                    ?>
                                                @endif
                                            </td>
                                            <td>
                                                <?php
                                                $site = DIRECTORY_SEPARATOR . $media->path;
                                                echo '<a href="' . $site .'">' . $media->path .'</a>';
                                                ?>
                                            </td>
                                            <?php
                                                $photo = new App\Models\Photo();
                                                $photo->photo_id = $media->media_id;
                                                $width = $photo->getWidthAttribute();
                                                $height = $photo->getHeightAttribute();
                                            ?>
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
                            <strong>Atentie!</strong> Nu exista poze.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <!-- ALL AUDIO -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">All audio
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                     </span>
                </header>
                <div class="panel-body">
                    @if (count($medias))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-audio">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cale</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medias as $media)
                                    @if (strpos($media->path, 'uploads' . DIRECTORY_SEPARATOR . 'audio') !== false)
                                        <tr>
                                            <td>{!! $media->media_id !!}</td>
                                            <td>
                                                <?php
                                                $site = DIRECTORY_SEPARATOR . $media->path;
                                                echo '<a href="' . $site .'">' . $media->path .'</a>';
                                                ?>
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
                            <strong>Atentie!</strong> Nu exista sunete.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>

    <!-- ALL VIDEO -->
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">All video
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                     </span>
                </header>
                <div class="panel-body">
                    @if (count($medias))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-video">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Youtube link</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($medias as $media)
                                    @if (strpos($media->path, 'http') !== false)
                                        <tr>
                                            <td>{!! $media->media_id !!}</td>
                                            <td>
                                                <?php
                                                echo '<a target="_blank" href="' . $media->path .'">' . $media->path .'</a>';
                                                ?>
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
                            <strong>Atentie!</strong> Nu exista videoclipuri.
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
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/media/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection