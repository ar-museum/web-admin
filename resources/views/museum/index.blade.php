@extends('layouts.app')

@section('content')
   <div class="class-md-12">
       <section class="panel">
           <header class="panel-heading" style="font-weight: 400">Adaugă muzeu
               <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
           </header>
           <div class="panel-body">
               <!-- Display Validation Errors -->
               @include('common.errors')
               <form class="form-horizontal" method="POST" action="/museum/add" enctype="multipart/form-data" role="form">
                   {!! csrf_field() !!}
                   <div class="form-group @if ($errors->has('museum_name'))has-error @endif">
                       <label class="col-lg-4 control-label" for="museum_name">Nume <span class="text-danger">*</span></label>
                       <div class="col-lg-8">
                           <input type="text" name="museum_name" id="museum_name" value="{{ old('museum_name') }}"
                                  class="form-control" placeholder="Nume">
                       </div>
                   </div>

                   <div class="form-group @if ($errors->has('museum_address'))has-error @endif">
                       <label class="col-lg-4 control-label" for="museum_address">Adresă <span class="text-danger">*</span></label>
                       <div class="col-lg-8">
                           <input type="text" name="museum_address" id="museum_address" value="{{ old('museum_address') }}"
                                  class="form-control" placeholder="Adresa">
                       </div>
                   </div>

                   <div class="form-group @if ($errors->has('long'))has-error @endif">
                       <label class="col-lg-4 control-label" for="long">Longitudine <span class="text-danger">*</span></label>
                       <div class="col-lg-8">
                           <input type="text" name="long" id="long" value="{{ old('long') }}"
                                  class="form-control" placeholder="47.1791389">
                       </div>
                   </div>

                   <div class="form-group @if ($errors->has('lat'))has-error @endif">
                       <label class="col-lg-4 control-label" for="lat">Latitudine <span class="text-danger">*</span></label>
                       <div class="col-lg-8">
                           <input type="text" name="lat" id="lat" value="{{ old('lat') }}"
                                  class="form-control" placeholder="27.5668158">
                       </div>
                   </div>

                   @for($i = 0; $i < 7; $i++)
                    <div class="form-group @if ($errors->has($week[$i]))has-error @endif">
                        <label class="col-lg-12 control-label" for="{{ $week[$i] }}_op"><b>Program {{ $week_ro[$i] }}:</b></label>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label class="control-label col-lg-4">Ora deschidere</label>
                                <div class="col-lg-3">
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
                                <div class="col-lg-3">
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
                           <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Adaugă</button>
                           <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetează</button>
                       </div>
                   </div>
                   <div class="text-danger">* Aceste câmpuri sunt obligatorii!</div>
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
                                    <th>ID</th>
                                    <th>Nume</th>
                                    <th>Longitudine</th>
                                    <th>Latitudine</th>
                                    <th>Program</th>
                                    <th>Acțiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach ($museums as $museum)
                                    <tr>
                                        <td>{!! $museum->getMuseumId() !!}</td>
                                        <td>{!! $museum->getMuseumName() !!}</td>
                                        <td>{{ $museum->getMuseumLongitude() }}</td>
                                        <td>{{ $museum->getMuseumLatitude() }}</td>
                                        <td style="margin: 0; padding: 0">
                                            <table class="deny-table">
                                                <tr>
                                                    <td><b>{{ $week_ro[0] }}</b></td>
                                                    <td>{{ $museum->getMondayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[1] }}</b></td>
                                                    <td>{{ $museum->getTuesdayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[2] }}</b></td>
                                                    <td>{{ $museum->getWednesdayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[3] }}</b></td>
                                                    <td>{{ $museum->getThursdayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[4] }}</b></td>
                                                    <td>{{ $museum->getFridayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[5] }}</b></td>
                                                    <td>{{ $museum->getSaturdayProgram() }}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>{{ $week_ro[6] }}</b></td>
                                                    <td>{{ $museum->getSundayProgram() }}</td>
                                                </tr>
                                            </table>
                                        </td>

                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizeaza datele"
                                               href="{!! route('museum-edit', ['id' => $museum->getMuseumId()]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_museum" data-action-id="{!! $museum->getMuseumId() !!}"
                                                    title="Sterge">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php $i++ ?>
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
    <script src="{!! asset('/js/bootstrap/bootstrap-timepicker.js') !!}"></script>
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/museum/index.js') !!}"></script>
@endsection

@section('css')
    <link href="{!! asset('/css/timepicker.css') !!}" rel="stylesheet">
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
    <style>
        .deny-table {
            line-height: 0.6;
        }
    </style>
@endsection