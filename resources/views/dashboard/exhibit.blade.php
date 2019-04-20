@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Adaugare exponat
                </header>
                <div class="panel-body">
                    @if(count($errors) > 0)
                        <div class = "alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li> {{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if( \Session::has('success'))
                        <div class = "alert alert-danger">
                            <p> {{ \Session::get('success') }}</p>
                        </div>
                    @endif

                    <form role="form" class="form-horizontal tasi-form" action = "/exhibit-store" method = "post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Title</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="title" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Short description </label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="s_description" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Description</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="description" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Start year</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name = "start_year" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">End year</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="end_year" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Size </label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="size" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Locatie</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="location" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Author ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name = "author_id" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Exposition ID </label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name = "exposition_id" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Staff ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="staff_id" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Audio ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="audio_id" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Photo ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="photo_id" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Video ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="video_id"  class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-danger" type="submit">  Add </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>

    <section class="panel">
        <header class="panel-heading">
            Exponate
            <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
        </header>
        <div class="panel-body">
            @if (!$exhibits->isEmpty())
                <div class="adv-table">
                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                        <div class="row-fluid">
                            <div class="span6">
                                <div id="dynamic-table_length" class="dataTables_length">
                                    <label>
                                        <select>
                                                class="form-control"
                                                size="1"
                                                name="dynamic-table_length"
                                                aria-controls="dynamic-table">
                                            <option value="5" selected="selected"> 5 </option>
                                            <option value="10" > 10 </option>
                                            <option value="15" > 15 </option>
                                            <option value="20" > 20 </option>
                                        </select> records per page </label>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="dataTables_filter" id="dynamic-table_filter"><label>Search: <input
                                                type="text"
                                                class="form-control"
                                                aria-controls="dynamic-table"></label>
                                </div>
                            </div>
                        </div>
                        <table class="display table table-bordered table-striped dataTable" id="dynamic-table"
                               aria-describedby="dynamic-table_info">
                            <thead>
                            <tr>
                                <th rowspan="1" colspan="1">Nr. crt</th>
                                <th rowspan="1" colspan="1">Titlu</th>
                                <th rowspan="1" colspan="1">Scurta descriere</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Autor</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Perioada</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Dimensiune</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Locatie</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Data adaugare</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Nr. crt</th>
                                <th rowspan="1" colspan="1">Titlu</th>
                                <th rowspan="1" colspan="1">Scurta descriere</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Autor</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Perioada</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Dimensiune</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Locatie</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Data adaugare</th>
                            </tr>
                            </tfoot>

                            <tbody>

                            @foreach ($exhibits as $exhibit)
                                <tr>
                                    <td>{!! $exhibit->exhibit_id !!}</td>
                                    <td>
                                        <a href="#">{{ $exhibit->title }}</a>
                                    </td>
                                    <td>{{ $exhibit->short_description }}</td>
                                    <td>{{ $exhibit->authors->full_name }} </td>
                                    <td>{{ $exhibit->start_year }} @if (!is_null($exhibit->end_year))
                                            - {{ $exhibit->end_year }} @endif</td>
                                    <td>{{ $exhibit->size }}</td>
                                    <td class="hidden-phone">{{ $exhibit->location }}</td>
                                    <td>{!! $exhibit->created_at !!}</td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of {{ $exhibits_no }} entries</div>
                            </div>
                            <div class="span6">
                                <div class="dataTables_paginate paging_bootstrap pagination">
                                    <ul>
                                        <li class="prev disabled"><a href="#">← Previous</a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#">5</a></li>
                                        <li class="next"><a href="#">Next → </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="alert alert-info fade in">
                                <strong>Atentie!</strong> Nu exista exponate.
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </section>

@endsection
