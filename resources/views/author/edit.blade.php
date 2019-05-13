@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Editeaza autor
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST"
                          action="{!! route('update-author', ['id' => $author->author_id]) !!}"
                          enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('full_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="title">Nume <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="full_name" id="full_name"
                                       class="form-control" value="{{$author->full_name}}">
                            </div>
                        </div>


                        <div class="form-group @if ($errors->has('born_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="start_year"> Anul nasterii <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="born_year" id="born_year"
                                       class="form-control" value="{{$author->born_year}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('died_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="end_year"> Anul mortii<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="died_year" id="died_year"
                                       class="form-control" value="{{$author->died_year}}">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('location'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="location"> Location <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="location" id="location"
                                       class="form-control" value="{{$author->location}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="description">Descriere <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea type="text" name="description" id="description"
                                          class="form-control" value="{{$author->description}}"></textarea>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('photo_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="photo_id"> Photo ID <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="photo_id" class="form-control" id="class_photo_id">
                                    <option value="0">Photo ID</option>
                                    @foreach ($photos as $photo)
                                        <option value="{!! $photo->photo_id !!}" @if (null !== old('photo_id')
                                        && $photo->photo_id == old('photo_id')) selected @endif>{!! $photo->photo_id !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizeaza
                                </button>
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
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/author/index.js') !!}"></script>
    <script src="{!!asset('/js/author/bootstrap-datepicker.js')!!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection