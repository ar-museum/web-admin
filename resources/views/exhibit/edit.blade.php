@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Editeaza exponat
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST"
                          action="{!! route('update-exhibit', ['id' => $exhibit->exhibit_id]) !!}"
                          enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('title'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="title">Titlu <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="title" id="title"
                                       class="form-control" placeholder="{{$exhibit->title}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('short_description'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="short_description">Scurta descriere
                                <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea type="text" name="short_description" id="short_description"
                                          class="form-control" placeholder="{{$exhibit->short_description}}"></textarea>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="description">Descriere <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea type="text" name="description" id="description"
                                          class="form-control" placeholder="{{$exhibit->description}}"></textarea>
                            </div>
                        </div>
                        <!--
                        <div class="form-group @if ($errors->has('start_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="start_year">Data inscrierii</label>
                            <div class="col-lg-5">
                                <div class="input-group date datepicker">
                                    <input type="text" id="start_year" name="start_year" readonly=""
                                           value="@if (old('start_year')){{ old('start_year') }}@else{!! date('Y') !!}@endif"
                                           size="16" class="form-control datepicker">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
                                    </div>
                                </div>
                                <span class="help-block">Alege data</span>
                            </div>
                        </div>
                        -->

                        <div class="form-group @if ($errors->has('start_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="start_year"> Data realizarii <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="start_year" id="start_year" value="{{ old('start_year') }}"
                                       class="form-control" placeholder="Start year">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('end_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="end_year"> Data finalizarii<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="end_year" id="end_year" value="{{ old('end_year') }}"
                                       class="form-control" placeholder="End year">
                            </div>
                        </div>
                       <!--
                        <div class="form-group @if ($errors->has('end_year'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="end_year">Data finalizarii</label>
                            <div class="col-lg-5">
                                <div class="input-group date datepicker">
                                    <input type="text" id="end_year" name="end_year" readonly=""
                                           value="@if (old('end_year')){{ old('end_year')}}@else{!! date('Y') !!}@endif"
                                           size="16" class="form-control datepicker">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary date-set"><i
                                                    class="fa fa-calendar"></i></button>
                                    </div>
                                </div>
                                <span class="help-block">Alege data</span>
                            </div>
                        </div>
                        -->
                        <div class="form-group @if ($errors->has('size'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="size"> Size <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="size" id="size" value="{{ old('size') }}"
                                       class="form-control" placeholder="{{$exhibit->size}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('location'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="location"> Locatie <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="location" id="location" value="{{ old('location') }}"
                                       class="form-control" placeholder="{{$exhibit->location}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('author_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="author_id"> Author ID <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="author_id" class="form-control" id="class_author_id">
                                    <option value="0">-</option>
                                    @foreach($authors as $author){
                                    <option value="{!! $author->author_id !!}" @if (null!==old('author_id')
                                  && $author->author_id==old('author_id'))  selected @endif>{!! $author->full_name !!}</option>
                                    }@endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('exposition_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="exposition_id"> Exposition ID <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="exposition_id" class="form-control" id="class_exposition_id">
                                    <option value="0"> - </option>
                                    @foreach($expositions as $exposition){
                                    <option value="{!! $exposition->exposition_id !!}" @if (null!==old('exposition_id')
                                && $exposition->exposition_id==old('exposition_id')) selected @endif>{!! $exposition->title !!}</option>
                                    } @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('audio_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="audio_id"> Audio ID <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="audio_id" class="form-control" id="class_audio_id">
                                    <option value="0">Audio ID</option>
                                    @foreach ($audios as $audio)
                                        <option value="{!! $audio->audio_id !!}" @if (null !== old('audio_id')
                                        && $audio->audio_id == old('audio_id')) selected @endif>{!! $audio->audio_id !!}</option>
                                    @endforeach
                                </select>
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

                        <div class="form-group @if ($errors->has('video_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="video_id"> Youtube link <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="video_id" id="video_id" value="{{ old('video_id') }}"
                                       class="form-control" placeholder="write your link..">
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
    <script src="{!! asset('/js/exhibit/index.js') !!}"></script>
    <script src="{!!asset('/js/exhibit/bootstrap-datepicker.js')!!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection