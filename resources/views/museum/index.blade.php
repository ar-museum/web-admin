@extends('layouts.app')
@section('content')
   <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Adauga muzeu
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/museum/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_name" id="museum_name" value="{{ old('museum_name') }}"
                                       class="form-control" placeholder="Nume">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_address'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_address">Adresa <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_address" id="museum_address" value="{{ old('museum_address') }}"
                                       class="form-control" placeholder="Adresa">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('long'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="long">Longitudinea <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="long" id="long" value="{{ old('long') }}"
                                       class="form-control" placeholder="Longitudinea">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('lat'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="lat">Latitudinea <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="lat" id="lat" value="{{ old('lat') }}"
                                       class="form-control" placeholder="Latitudinea">
                            </div>
                        </div>


                        <div class="form-group @if ($errors->has('monday'))has-error @endif">
                        </div>
                        <label class="col-lg-2 col-md-3 col-sm-4 control-label" for="monday"><b>Program Luni:</b></label>

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
                        <label class="col-lg-2 col-md-3 col-sm-4 control-label" for="tuesday"><b>Program Marti:</b></label>

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
                        <label class="col-lg-2 col-md-3 col-sm-4 control-label" for="thursday"><b>Program Joi:</b></label>

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
                                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adauga</button>
                                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reseteaza</button>
                            </div>
                        </div>
                        <div class="text-danger">* Aceste campuri sunt obligatorii!</div>
                    </form>
                </div>
            </section>
        </div>


    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Muzee
                    <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
                </header>
                <div class="panel-body">
                    @if (count($museums))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-expositions">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nume</th>
                                    <th>Longitudine</th>
                                    <th>Latitudine</th>
                                    <th>Program luni</th>
                                    <th>Program marti</th>
                                    <th>Program miercuri</th>
                                    <th>Program joi</th>
                                    <th>Program vineri</th>
                                    <th>Program sambata</th>
                                    <th>Program duminica</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($museums as $museum)
                                    <tr>
                                        <td>{!! $museum->getMuseumId() !!}</td>
                                        <td>{!! $museum->getMuseumName() !!}</td>
                                        <td>{{ $museum->getMuseumLongitude() }}</td>
                                        <td>{{ $museum->getMuseumLatitude() }}</td>
                                        <td>{{ $museum->getMondayProgram() }}</td>
                                        <td>{{ $museum->getTuesdayProgram() }}</td>
                                        <td>{{ $museum->getWednesdayProgram() }}</td>
                                        <td>{{ $museum->getThursdayProgram() }}</td>
                                        <td>{{ $museum->getFridayProgram() }}</td>
                                        <td>{{ $museum->getSaturdayProgram() }}</td>
                                        <td>{{ $museum->getSundayProgram() }}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizeaza datele"
                                               href="{!! route('museum-edit', ['id' => $museum->getMuseumId()]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista muzee.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="{!! asset('/js/bootstrap/bootstrap-datetimepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/bootstrap-timepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/bootstrap-datepicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/bootstrap-colorpicker.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/jquery.multi-select.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/jquery.quicksearch.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/wysihtml5-0.3.0.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/spinner.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/bootstrap-wysihtml5.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('/js/bootstrap/daterangepicker.js') !!}"></script>


    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/museum/index.js') !!}"></script>


@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection