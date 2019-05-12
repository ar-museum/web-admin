@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga autor
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action= "/author-store" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('full_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="full_name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}"
                                       class="form-control" placeholder="Nume">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('born_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="born_year">Anul nasterii <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="born_year" id="born_year" value="{{ old('born_year') }}"
                                       class="form-control" placeholder="Anul nasterii">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('died_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="died_year">Anul mortii <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="died_year" id="died_year" value="{{ old('died_year') }}"
                                       class="form-control" placeholder="Anul mortii">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('location'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="location"> Locatie <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="location" id="location" value="{{ old('location') }}"
                                       class="form-control" placeholder="Locatie">
                            </div>
                        </div>


                        <div class="form-group @if ($errors->has('photo_id'))has-error @endif">
                            <!--
                            <label class="col-lg-4 col-sm-4 control-label" for="photo_id"> Photo <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="photo_id" id="photo_id" value="{{ old('photo_id') }}"
                                       class="form-control" placeholder="Photo ID">
                            </div>
                            -->
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
                                <button type="submit" name ="staff_id" value="{{$currentStaff->staff_id}}" class="btn btn-success"><i class="fa fa-plus"></i> Adauga</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza
                                </button>
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
                <header class="panel-heading">Autori
                    <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
                </header>
                <div class="panel-body">
                    @if (count($authors))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-authors">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Poza</th>
                                    <th>Nume</th>
                                    <th>Perioada</th>
                                    <th>Locatie</th>
                                    <th>Data adaugare</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{!! $author->author_id !!}</td>
                                        <td>
                                            <?php
                                                $photo = new App\Models\Photo();
                                                $photo->photo_id = $author->photo_id;
                                                $path_img = $photo->getPathAttribute();
                                                echo '<img src="'.$path_img.'" width="100" height="80" />';
                                            ?>
                                        </td>
                                        <td>{{ $author->full_name }}</td>
                                        <td>{{ $author->born_year }} @if (!is_null($author->died_year))
                                                - {{ $author->died_year }} @endif </td>
                                        <td>{{$author->location}}</td>
                                        <td>{!! date("Y-m-d", strtotime($author->created_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizeaza datele"
                                               href="{!! route('edit-author', ['id' => $author->author_id]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_author" data-action-id="{!! $author->author_id !!}"
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
                            <strong>Atentie!</strong> Nu exista autori.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/author/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection