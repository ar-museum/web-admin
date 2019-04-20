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
                    @if (!$expositions->isEmpty())
                    <div class="adv-table">
                        <table class="display table table-hover table-bordered table-striped" id="all-students">
                            <thead>
                            <tr>
                                <th>Nr. crt.</th>
                                <th>Titlu</th>
                                <th>Descriere</th>
                                <th>Muzeu</th>
                                <th class="hidden-phone">Data adaugarii</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($expositions as $exposition)
                                <tr>
                                    <td>{!! $exposition->exposition_id !!}</td>
                                    <td>
                                        <a href="#">{{ $exposition->title }}</a>
                                    </td>
                                    <td>{{ $exposition->description }}</td>
                                    <td class="hidden-phone">{{ $exposition->museum->name }}</td>
                                    <td>{!! $exposition->created_at !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="add-task-row">
                        <a class="btn btn-primary btn-sm" href="{!! route('exposition') !!}">Vezi toate expozitiile</a>
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
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimile exponate
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (!$exhibits->isEmpty())
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-students">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Titlu</th>
                                    <th>Scurta descriere</th>
                                    <th>Autor</th>
                                    <th>Perioada</th>
                                    <th>Dimensiune</th>
                                    <th class="hidden-phone">Locatie</th>
                                    <th class="hidden-phone">Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($exhibits as $exhibit)
                                    <tr>
                                        <td>{!! $exhibit->exhibit_id !!}</td>
                                        <td>
                                            <a href="#">{{ $exhibit->title }}</a>
                                        </td>
                                        <td>{{ $exhibit->short_description }}</td>
                                        <td>{{ $exhibit->author_id }}</td>
                                        <td>{{ $exhibit->start_year }} @if (!is_null($exhibit->end_year)) - {{ $exhibit->end_year }} @endif</td>
                                        <td>{{ $exhibit->size }}</td>
                                        <td class="hidden-phone">{{ $exhibit->location }}</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="#">Vezi toate exponatele</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista exponate.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimii autori
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (!$authors->isEmpty())
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-students">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Poza</th>
                                    <th>Nume</th>
                                    <th>Perioada</th>
                                    <th class="hidden-phone">Locatie</th>
                                    <th class="hidden-phone">Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{!! $author->author_id !!}</td>
                                        <td>{!! $author->photo_id !!}</td>
                                        <td>
                                            <a href="#">{{ $author->full_name }}</a>
                                        </td>
                                        <td>{{ $author->born_year }} @if (!is_null($author->died_year)) - {{ $author->died_year }} @endif</td>
                                        <td class="hidden-phone">{{ $author->location }}</td>
                                        <td>-</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="#">Vezi toti autorii</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista autori.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimile categorii
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (!$categories->isEmpty())
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-students">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Nume</th>
                                    <th>Nr. exponate</th>
                                    <th>Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{!! $category->category_id !!}</td>
                                        <td>
                                            <a href="#">{{ $category->name }}</a>
                                        </td>
                                        <td>0</td>
                                        <td>{{ $category->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="#">Vezi toate categoriile</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista categorii.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimile etichete
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (!$expositions->isEmpty())
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-students">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Keyword</th>
                                    <th>Nr. exponate</th>
                                    <th>Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{!! $tag->tag_id !!}</td>
                                        <td>
                                            <a href="#">{{ $tag->name }}</a>
                                        </td>
                                        <td>0</td>
                                        <td>{{ $tag->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="#">Vezi toate etichetele</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista etichete.
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading"><i class="fa fa-list-ul"></i> Ultimile media
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a class="fa fa-times" href="javascript:;"></a>
                    </span>
                </header>
                <div class="panel-body">
                    @if (!$media->isEmpty())
                        <div class="adv-table">
                            <table class="display table table-hover table-bordered table-striped" id="all-students">
                                <thead>
                                <tr>
                                    <th>Nr. crt.</th>
                                    <th>Path</th>
                                    <th>Detalii</th>
                                    <th>Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($media as $item)
                                    <tr>
                                        <td>{!! $item->media_id !!}</td>
                                        <td>
                                            <a href="#">{{ $item->path }}</a>
                                        </td>
                                        <td>-</td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="#">Vezi toate media</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atentie!</strong> Nu exista media.
                        </div>
                    @endif
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