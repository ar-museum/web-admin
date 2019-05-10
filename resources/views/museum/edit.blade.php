@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Editeaza muzeele
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="{!! route('update_museum', ['id' => $museum->museum_id]) !!}" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_name" id="museum_name"
                                       class="form-control" value="{{$museum->name}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_long'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_long">Longitudine <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_long" id="museum_long"
                                       class="form-control" value="{{$museum->longitude}}">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_lat'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_lat">Latitudine <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_lat" id="museum_lat"
                                       class="form-control" value="{{$museum->latitude}}">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizeaza</button>
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
    <script src="{!! asset('/js/exposition/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection