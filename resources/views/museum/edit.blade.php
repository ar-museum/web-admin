@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading" style="font-weight: 400">Editează muzeu
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="{!! route('update_museum', ['id' => $museum->museum_id]) !!}" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_name">Nume </label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_name" id="museum_name"
                                       class="form-control" value="{{$museum->name}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_address'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_address">Adresa </label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_address" id="museum_address" value="{{ old('museum_address') }}"
                                       class="form-control" placeholder="Adresa">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('long'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="long">Longitudine </label>
                            <div class="col-lg-8">
                                <input type="text" name="long" id="long"
                                       class="form-control" value="{{$museum->longitude}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('lat'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="lat">Latitudine</label>
                            <div class="col-lg-8">
                                <input type="text" name="lat" id="lat"
                                       class="form-control" value="{{$museum->latitude}}">
                            </div>
                        </div>

                        @for($i = 0; $i < 7; $i++)
                        <div class="form-group @if ($errors->has($week[$i]))has-error @endif">
                            <label class="col-lg-12 control-label" for="{{ $week[$i] }}_op"><b>Program {{ $week_ro[$i] }}:</b></label>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="control-label col-lg-4">Ora deschidere</label>
                                    <div class="col-lg-5">
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker-24" name="{{ $week[$i] }}_op" id="{{ $week[$i]}}_op">
                                            <span class="input-group-btn">
                                            <button class="btn btn-success" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <label class="control-label col-lg-4">Ora închidere</label>
                                    <div class="col-lg-5">
                                        <div class="input-group bootstrap-timepicker">
                                            <input type="text" class="form-control timepicker-24" name="{{ $week[$i] }}_cl" id="{{ $week[$i] }}_cl">
                                            <span class="input-group-btn">
                                            <button class="btn btn-danger" type="button"><i class="fa fa-clock-o"></i></button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizează</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetează</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/bootstrap/bootstrap-timepicker.js') !!}"></script>
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/museum/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/timepicker.css') !!}" rel="stylesheet">
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection