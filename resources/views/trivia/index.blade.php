@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga informatii Trivia
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="/trivia-store" enctype="multipart/form-data"
                          role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('json_name'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="json_name">Nume JSON<span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="json_name" id="json_name" value="{{ old('json_name') }}"
                                       class="form-control" placeholder="Nume">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('museum_id'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="museum_id"> Museum ID <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <select name="museum_id" class="form-control" id="class_museum_id">
                                    <option value="0">-</option>
                                    @foreach($museums as $museum){
                                    <option value="{!! $museum->museum_id !!}" @if (null!==old('museum_id')
                                  && $museum->museum_id==old(museum_id))  selected @endif>{!! $museum->name !!}</option>
                                    }@endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-4 col-md-8">
                                <button type="submit"  class="btn btn-success"><i class="fa fa-plus"></i> Adauga</button>
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
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Informatii
                    <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
                </header>
                <div class="panel-body">
                    @if (count($trivia))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-trivia">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Nume JSON</th>
                                    <th>Nume muzeu</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($trivia as $triv)
                                    <tr>
                                        <td>{!! $triv->trivia_id !!}</td>
                                        <td>{{ $triv->json_name }}</td>
                                        <td> {{$triv->museum->name}}</td>
                                        <td>{!! date("Y-m-d", strtotime($triv->created_at)) !!}</td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_trivia" data-action-id="{!! $triv->trivia_id !!}"
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
                            <strong>Atentie!</strong> Nu exista informatii.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
    <script src="{!! asset('/js/trivia/index.js') !!}"></script>
    <script src="{!!asset('/js/trivia/bootstrap-datepicker.js')!!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection