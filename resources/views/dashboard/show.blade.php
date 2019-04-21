@extends('layouts.app')
@section('content')
    <section class="wrapper">
        <!-- page start-->
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Exposition Table
                        <span class="tools pull-right">
                <a href="javascript:;" class="fa fa-chevron-down"></a>
                <a href="javascript:;" class="fa fa-times"></a>
             </span>
                    </header>
                    <div class="panel-body">
                        @if (!$expositions->isEmpty())
                            <div class="panel-body">
                                <div class="adv-table">
                                    <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div id="dynamic-table_length" class="dataTables_length"><label><select
                                                                class="form-control" size="1"
                                                                name="dynamic-table_length"
                                                                aria-controls="dynamic-table">
                                                            <option value="10" selected="selected">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                        </select> records per page</label></div>
                                            </div>
                                            <div class="span6">
                                                <div class="dataTables_filter" id="dynamic-table_filter"><label>Search:</label>
                                                    <input type="text" class="form-controller" id="search" name="search"></input></div>
                                            </div>
                                        </div>
                                        <table class="display table table-hover table-bordered table-striped"
                                               id="all-students">
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
                                        <div class="row-fluid">
                                            <div class="span6">
                                                <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10
                                                    of {!! $expositions_no !!}
                                                    entries
                                                </div>
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
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-info fade in">
                                <strong>Atentie!</strong> Nu exista exponate.
                            </div>
                    @endif
                </section>
                @if (count($errors)>0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>
                                    {{$error}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(\Session::has('success'))
                    <div class="alert alert-success">
                        <p>
                            {{\Session::get('success')}}
                        </p>
                    </div>
                @endif
                <section class="panel">
                    <header class="panel-heading">
                        Adaugare Expozitie
                    </header>
                    <div class="panel-body">
                        <form role="form" class="form-horizontal tasi-form" action="/expositionadd" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group has-success">
                                <label class="col-lg-2 control-label">Titlu</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="f-name" name="title-expo"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="col-lg-2 control-label">Descriere</label>
                                <div class="col-lg-10">
                                    <input type="text" placeholder="" id="l-name" name="description-expo"
                                           class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Muzeu</label>
                                <select class="form-group" name="museum-expo">

                                    @foreach ($museums as $museum)
                                        <option>{!! $museum->museum_id !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">photo</label>
                                <select class="form-group" name="photo-expo">

                                    @foreach ($photos as $photo)
                                        <option>{!! $photo->photo_id !!}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">staff</label>
                                <select class="form-group" name="staff-expo">

                                    @foreach ($staffs as $staff)
                                        <option>{!! $staff->staff_id !!}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-danger" type="submit">Adaugare</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>

    </section>
    </div>
    </div>
    <!-- page end-->

    </section>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script type="text/javascript">
        $('#search').on('keyup',function(){
            $value=$(this).val();
            $.ajax({
                type : 'get',
                url : '{{URL::to('exposition/search')}}',
                data:{'search':$value},
                success:function(data){
                    $('tbody').html(data);
                }
            });
        })
    </script>
    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection
@section('js')
    <script src="{!! asset('/js/dashboard/index.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/logs.css') !!}" rel="stylesheet">
@endsection