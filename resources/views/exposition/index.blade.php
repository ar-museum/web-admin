@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">Adauga expozitie
                    <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span>
                </header>
                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form class="form-horizontal" method="POST" action="#" enctype="multipart/form-data" role="form">
                        {!! csrf_field() !!}
                        <div class="form-group @if ($errors->has('title'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="title">Titlu <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                       class="form-control" placeholder="Titlu">
                            </div>
                        </div>

                        <div class="form-group @if ($errors->has('description'))has-error @endif">
                            <label class="col-lg-4 col-sm-4 control-label" for="description">Descriere <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input type="text" name="description" id="description" value="{{ old('description') }}"
                                       class="form-control" placeholder="Descriere">
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
                <header class="panel-heading">Expozitii
                    <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
             </span>
                </header>
                <div class="panel-body">
                    @if (count($expositions))
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-expositions">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Imagine</th>
                                    <th>Titlu</th>
                                    <th>Descriere</th>
                                    <th>Muzeu</th>
                                    <th>Staff</th>
                                    <th>Data adaugarii</th>
                                    <th>Actiuni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($expositions as $exposition)
                                    <tr>
                                        <td>{!! $exposition->exposition_id !!}</td>
                                        <td>Imagine</td>
                                        <td>{{ $exposition->title }}</td>
                                        <td>{{ $exposition->description }}</td>
                                        <td>{{ $exposition->museum_id }}</td>
                                        <td>{{ $exposition->staff_id }}</td>
                                        <td>{!! date("Y-m-d", strtotime($exposition->created_at)) !!}</td>
                                        <td>
                                            <a class="btn btn-success btn-xs" title="Actualizeaza datele"
                                               href="{!! route('change_pass', ['code' => $exposition->exposition_id]) !!}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-xs btn-delete"
                                                    data-action="delete_exposition" data-action-id="{!! $exposition->exposition_id !!}"
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
                            <strong>Atentie!</strong> Nu exista expozitii.
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