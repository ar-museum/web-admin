@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12">
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
            <section class="panel">
                <header class="panel-heading">
                    Adaugare autor
                </header>
                <div class="panel-body">
                    <form role="form" class="form-horizontal tasi-form" action = "/author-store" method = "post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Full name</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name="full_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label"> Born year</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="born_year" class="form-control">
                            </div>
                        </div>
                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Died year</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="died_year" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Location</label>
                            <div class="col-lg-10">
                                <input type="text" placeholder="" name = "location" class="form-control">
                            </div>
                        </div>

                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Staff ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name = "staff_id" class="form-control">
                            </div>
                        </div>


                        <div class="form-group has-success">
                            <label class="col-lg-2 control-label">Photo ID</label>
                            <div class="col-lg-10">
                                <input type="number" placeholder="" name="photo_id" class="form-control">
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
            @if (!$authors->isEmpty())
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
                                <th rowspan="1" colspan="1">Poza</th>
                                <th rowspan="1" colspan="1">Nume</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Perioada</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Locatie</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Data adaugare</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Nr. crt</th>
                                <th rowspan="1" colspan="1">Poza</th>
                                <th rowspan="1" colspan="1">Nume</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Perioada</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Locatie</th>
                                <th class="hidden-phone" rowspan="1" colspan="1">Data adaugare</th>
                            </tr>
                            </tfoot>

                            <tbody>

                            @foreach ($authors as $author)
                                <tr>
                                    <td>{!! $author->author_id !!}</td>
                                    <td>{{ $author->photos->path }} </td>
                                    <td>
                                        <a href="#">{{ $author->full_name }}</a>
                                    </td>
                                    <td>{{ $author->born_year }} @if (!is_null($author->died_year))
                                            - {{ $author->died_year }} @endif</td>
                                    <td>{{ $author->location }}</td>
                                    <td>{!! $author->created_at !!}</td>

                                </tr>
                            @endforeach

                            </tbody>

                        </table>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10 of {{ $authors_no }} entries</div>
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
                                <strong>Atentie!</strong> Nu exista autori.
                            </div>
                        @endif
                    </div>
                </div>
        </div>
    </section>

@endsection
