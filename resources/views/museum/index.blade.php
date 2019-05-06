@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">Adauga muzeu
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/exposition/add" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_name">Nume <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_name" id="museum_name" value="{{ old('museum_name') }}"
                                       class="form-control" placeholder="Nume">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_location'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_location">Locatia <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="museum_location" id="museum_location" value="{{ old('museum_location') }}"
                                       class="form-control" placeholder="Locatia">
                            </div>
                        </div>


                <div class="form-group @if ($errors->has('monday'))has-error @endif">
                    <label class="col-lg-4 col-sm-4 control-label" for="monday">Program Luni <span class="text-danger">*</span></label>

                    <?php
                    echo nl2br("\n\n");
                    ?>
                    <div class="col-lg-8">
                        <input type="text" name="monday_opening" id="monday_opening" value="{{ old('monday_opening') }}"
                               class="form-control" placeholder="Ora deschidere">
                    </div>
                    <?php
                    echo nl2br("\n\n");
                    ?>
                    <div class="col-lg-8">
                        <input type="text" name="monday_closing" id="monday_closing" value="{{ old('monday_closing') }}"
                               class="form-control" placeholder="Ora inchidere">
                    </div>
                </div>
                        <div class="form-group @if ($errors->has('tuesday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="tuesday">Program Marti <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="tuesday_opening" id="tuesday_opening" value="{{ old('tuesday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="tuesday_closing" id="tuesday_closing" value="{{ old('tuesday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('wednesday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="wednesday">Program Miercuri <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="wednesday_opening" id="wednesday_opening" value="{{ old('wednesday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="wednesday_closing" id="wednesday_closing" value="{{ old('wednesday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('thursday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="thursday">Program Joi <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="thursday_opening" id="thursday_opening" value="{{ old('thursday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="thursday_closing" id="thursday_closing" value="{{ old('thursday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('friday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="friday">Program Vineri <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="friday_opening" id="friday_opening" value="{{ old('friday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="friday_closing" id="friday_closing" value="{{ old('friday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('saturday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="saturday">Program Sambata <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="saturday_opening" id="saturday_opening" value="{{ old('saturday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="saturday_closing" id="saturday_closing" value="{{ old('saturday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('sunday'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="sunday">Program Duminica <span class="text-danger">*</span></label>

                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="sunday_opening" id="sunday_opening" value="{{ old('sunday_opening') }}"
                                       class="form-control" placeholder="Ora deschidere">
                            </div>
                            <?php
                            echo nl2br("\n\n");
                            ?>
                            <div class="col-lg-8">
                                <input type="text" name="sunday_closing" id="sunday_closing" value="{{ old('sunday_closing') }}"
                                       class="form-control" placeholder="Ora inchidere">
                            </div>
                        </div>




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
                                    <th>Locatie</th>
                                    <th>Program luni</th>
                                    <th>Program marti</th>
                                    <th>Program miercuri</th>
                                    <th>Program joi</th>
                                    <th>Program vineri</th>
                                    <th>Program sambata</th>
                                    <th>Program duminica</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($museums as $museum)
                                    <tr>
                                        <td>{!! $museum->getMuseumId() !!}</td>
                                        <td>{!! $museum->getMuseumName() !!}</td>
                                        <td>{{ $museum->getMuseumAddress() }}</td>
                                        <td>{{ $museum->getMondayProgram() }}</td>
                                        <td>{{ $museum->getTuesdayProgram() }}</td>
                                        <td>{{ $museum->getWednesdayProgram() }}</td>
                                        <td>{{ $museum->getThursdayProgram() }}</td>
                                        <td>{{ $museum->getFridayProgram() }}</td>
                                        <td>{{ $museum->getSaturdayProgram() }}</td>
                                        <td>{{ $museum->getSundayProgram() }}</td>

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
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/exposition/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection