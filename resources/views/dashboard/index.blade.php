@extends('layouts.app')
@section('content')
    <div class="row state-overview">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol terques">
                    <i class="fa fa-camera-retro"></i>
                </div>
                <div class="value">
                    <h1 class="expositions_no">{!! $expositions_no !!}</h1>
                    <p>Expozitii</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol red">
                    <i class="fa fa-picture-o"></i>
                </div>
                <div class="value">
                    <h1 class="exhibits_no">{!! $exhibits_no !!}</h1>
                    <p>Exponate</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol orange">
                    <i class="fa fa-male"></i>
                </div>
                <div class="value">
                    <h1 class="authors_no">{!! $authors_no !!}</h1>
                    <p>Autori</p>
                </div>
            </section>
        </div>
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
                <div class="symbol gray">
                    <i class="fa fa-film"></i>
                </div>
                <div class="value">
                    <h1 class="media_no">NaN</h1>
                    <p>Media</p>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-building-o"></i> Informatii muzeu</header>
                <div class="list-group">
                    <a class="list-group-item" href="#">
                        Nume: Mihai Eminescu
                    </a>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimile expozitii
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display table table-hover table-bordered table-striped" id="all-students">
                            <thead>
                            <tr>
                                <th>Nr. crt.</th>
                                <th>Tilu</th>
                                <th>Descriere</th>
                                <th class="hidden-phone">Muzeu</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <a href="#">Literatura contemporana</a>
                                </td>
                                <td>Lorem ipsum</td>
                                <td class="hidden-phone">Muzeul Mihai Eminescu</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="add-task-row">
                        <a class="btn btn-primary btn-sm" href="#">Vezi toate expozitiile</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('/js/dashboard/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/logs.css') !!}" rel="stylesheet">
@endsection