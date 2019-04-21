@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{!! route('dashboard') !!}"><i class="fa fa-bar-chart-o"></i> Acasa</a></li>
                <li class="active">Setari</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Setari muzeu
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="museum/store" enctype="multipart/form-data" role="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_name">Nume </label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_name" id="museum_name" placeholder="Nume" class="form-control" >
                            </div>
                        </div>

                            <div class="form-group @if ($errors->has('museum_address'))has-error @endif">
                                <label class="col-lg-4 col-sm-4 control-label" for="museum_address">Adresa </label>
                                <div class="col-lg-8">
                                    <input type="text" name="museum_address" id="museum_address" placeholder="Adresa" class="form-control" >
                                </div>
                            </div>
                        <div class="form-group @if ($errors->has('day'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="day">Ziua pentru care doriti sa modificati programul</label>
                            <div class="col-lg-8">
                                <input type="text" name="day" id="day" placeholder="Ziua dorita" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('new_opening'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="new_opening">Noua ora de deschidere(hh:mm:ss)</label>
                            <div class="col-lg-8">
                                <input type="text" name="new_opening" id="new_opening"  placeholder="Ora de deschidere" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('new_closing'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="new_closing">Noua ora de inchidere(hh:mm:ss)</label>
                            <div class="col-lg-8">
                                <input type="text" name="new_closing" id="new_closing" placeholder="Ora de inchidere" class="form-control" >
                            </div>
                        </div>

                         <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Actualizeaza</button>
                            </div>
                        </div>
                    </form>


                </div>
            </section>
        </div>
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">Setari staff
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @if (!$errors->has('old_password') && !$errors->has('password'))
                        @include('common.errors')
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('settings') }}" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('first_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="first_name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="first_name" id="first_name"
                                       value="@if(null !== old('first_name')){{old('first_name')}}@else{{$user->first_name}}@endif"
                                       class="form-control" placeholder="Nume">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('last_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="last_name">Prenume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="last_name" id="last_name"
                                       value="@if(null !== old('last_name')){{old('last_name')}}@else{{$user->last_name}}@endif"
                                       class="form-control" placeholder="Prenume">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('email'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="email" id="email"
                                       value="@if(null !== old('email')){{old('email')}}@else{{$user->email}}@endif"
                                       class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-4 col-sm-4 control-label" @if (null === $user->photo)for="user_photo"@endif>Poza</label>
                            <div class="col-md-8">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                <span class="btn btn-white btn-file">
                                    <span class="fileinput-new"><i class="fa fa-picture-o"></i> Alege poza</span>
                                    <span class="fileinput-exists"><i class="fa fa-undo"></i> Schimba</span>
                                    <input type="file" name="photo" id="user_photo">
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
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Actualizeaza</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">Schimba parola
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @if ($errors->has('old_password') || $errors->has('password'))
                        @include('common.errors')
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('settings_password') }}" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('old_password'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="old_password">Parola veche <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="password" name="old_password" id="old_password" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('password'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="password">Parola noua <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="password" name="password" id="password" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group @if ($errors->has('password_confirmation'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="password_confirmation">Confirma parola <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="password" name="password_confirmation" id="password_confirmation" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Actualizeaza</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection