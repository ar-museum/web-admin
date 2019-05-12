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

                        <div class="form-group @if ($errors->has('monday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="monday"><b>Program Luni:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="monday_op" id="monday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="monday_cl" id="monday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group @if ($errors->has('tuesday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label"  for="tuesday"><b>Program Marti:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="tuesday_op" id="tuesday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="tuesday_cl" id="tuesday_cl">
                        </div>

                        <?php
                        echo nl2br("\n\n");
                        ?>


                        <div class="form-group @if ($errors->has('wednesday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="wednesday"><b>Program Miercuri:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="wednesday_op" id="wednesday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="wednesday_cl" id="wednesday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group @if ($errors->has('thursday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="thursday"><b>Program Joi:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="thursday_op" id="thursday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="thursday_cl" id="thursday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group @if ($errors->has('friday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="friday"><b>Program Vineri:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="friday_op" id="friday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="friday_cl" id="friday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group @if ($errors->has('saturday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="saturday"><b>Program Sambata:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="saturday_op" id="saturday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="saturday_cl" id="saturday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group @if ($errors->has('sunday'))has-error @endif">
                        </div>
                        <label class="col-lg-4 col-md-5 col-sm-6 control-label" for="sunday"><b>Program Duminica:</b></label>

                        <?php
                        echo nl2br("\n\n");
                        ?>
                        <div>
                            <label class="control-label col-md-3">Ora deschidere</label>
                            <input type="time" name="sunday_op" id="sunday_op">
                        </div>
                        <div>
                            <label class="control-label col-md-3">Ora inchidere</label>
                            <input type="time" name="sunday_cl" id="sunday_cl">
                        </div>
                        <?php
                        echo nl2br("\n\n");
                        ?>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Actualizeaza</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
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
    <script src="{!! asset('/js/exposition/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection