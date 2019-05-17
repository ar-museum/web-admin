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
                    <h1 class="media_no">{!! $media_no !!}</h1>
                    <p>Media</p>
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
                                        {{ $exposition->title }}
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
                                            {{ $exhibit->title }}
                                        </td>
                                        <td>{{ $exhibit->short_description }}</td>
                                        <td>{{ $exhibit->authors->full_name }}</td>
                                        <td>{{ $exhibit->start_year }} @if (!is_null($exhibit->end_year)) - {{ $exhibit->end_year }} @endif</td>
                                        <td>{{ $exhibit->size }}</td>
                                        <td class="hidden-phone">{{ $exhibit->location }}</td>
                                        <td>{!! $exhibit->created_at !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href= {!! route('exhibit') !!} >Vezi toate exponatele</a>
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
                                        <td>
                                            <?php
                                            echo '<img src="'.$author->photo[0]->path.'" width="90" height="100" />';
                                            ?>
                                        </td>
                                        <td>
                                            {{ $author->full_name }}
                                        </td>
                                        <td>{{ $author->born_year }} @if (!is_null($author->died_year)) - {{ $author->died_year }} @endif</td>
                                        <td class="hidden-phone">{{ $author->location }}</td>
                                        <td>{!! $author->created_at !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href={!! route('author') !!}>Vezi toti autorii</a>
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
                                            {{ $category->name }}
                                        </td>
                                        <td>{!! rand(0, 1) !!}</td>
                                        <td>{{ $category->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="{!! route('category') !!}">Vezi toate categoriile</a>
                        </div>
                    @else
                        <div class="alert alert-info fade in">
                            <strong>Atenție!</strong> Nu există categorii.
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
                                    <th>Nume</th>
                                    <th>Nr. exponate</th>
                                    <th>Data adaugarii</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($tags as $tag)
                                    <tr>
                                        <td>{!! $tag->tag_id !!}</td>
                                        <td>
                                            {{ $tag->name }}
                                        </td>
                                        <td>{!! rand(0, 1) !!}</td>
                                        <td>{{ $tag->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="{!! route('tag') !!}">Vezi toate etichetele</a>
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
                                    @if($item->path != '')
                                    <tr>
                                        <td>{!! $item->media_id !!}</td>
                                        <td>
                                            {{ $item->path }}
                                        </td>
                                        <td>
                                            @if (strpos($item->path, 'photo' . DIRECTORY_SEPARATOR) !== false)
                                                Photo
                                            @else
                                                @if (strpos($item->path, 'audio'. DIRECTORY_SEPARATOR) !== false)
                                                    Audio
                                                @else
                                                    @if (strpos($item->path, 'youtube') !== false || strpos($item->path, 'youtu.be') !== false)
                                                        Video
                                                    @endif
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="add-task-row">
                            <a class="btn btn-primary btn-sm" href="{!! route('media') !!}">Vezi toate media</a>
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