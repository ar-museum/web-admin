@extends('layouts.app')
@section('content')

<section class="wrapper">
    <!-- page start-->
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Media Table
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                     </span>
                </header>
                <div class="panel-body">
                    @if (!$medias->isEmpty())
                        <div class="panel-body">
                            <div class="adv-table">
                                <div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div id="dynamic-table_length" class="dataTables_length"><label>
                                                    <select class="form-control" size="1"
                                                            name="dynamic-table_length"
                                                            aria-controls="dynamic-table">
                                                        <option value="10" selected="selected">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select> records per page</label></div>
                                        </div>
                                        <div class="span6">
                                            <div class="dataTables_filter" id="dynamic-table_filter"><label>Search:
                                                    <input type="text" class="form-control"
                                                           aria-controls="dynamic-table"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="margin: 5px;">
                                        <table class="display table table-hover table-bordered table-striped"
                                           id="all-students">
                                        <thead>
                                        <tr>
                                            <th>Media ID</th>
                                            <th>Path</th>
                                            <th>Detalii</th>
                                            <th class="hidden-phone">Data adaugarii</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($medias as $media)
                                            <tr>
                                                <td>{!! $media->media_id !!}</td>
                                                <td>
                                                    <a href="#">{{ $media->path }}</a>
                                                </td>
                                                <td>-</td>
                                                <td>{!! $media->created_at !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="dataTables_info" id="dynamic-table_info">Showing 1 to 10
                                                of {!! $medias_no !!}
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
                            <strong>Atentie!</strong> Nu exista media.
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
                    Add Photo
                </header>
                <div class="panel-body">
                    <form role="form" class="form-horizontal tasi-form" action="/store-media" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group has-success">

                            <div class="form-group col-lg-10">
                                <label class="col-lg-2 control-label"
                                       @if (null === $media->path)for="media_photo"@endif>
                                    Poza
                                </label>

                                <div class="col-lg-8">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="fileinput-new"><i class="fa fa-picture-o"></i> Alege poza</span>
                                                <span class="fileinput-exists"><i class="fa fa-undo"></i> Schimba</span>
                                                <input type="file" name="photo" id="photo">
                                            </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">
                                                <i class="fa fa-trash-o"></i> Sterge
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-lg-10">
                                <label class="col-lg-2 control-label">Width</label>
                                <div class="col-lg-2">
                                    <input type="text" placeholder="" id="photo_width" name="photo_width"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group col-lg-10">
                                <label class="col-lg-2 control-label">Height</label>
                                <div class="col-lg-2">
                                    <input type="text" placeholder="" id="photo_height" name="photo_height"
                                           class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-danger" type="submit">Add media-photo</button>
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

@endsection
@section('js')
    <script src="{!! asset('/js/dashboard/index.js') !!}"></script>
    <script src="{!! asset('/js/common/bootstrap-fileupload.min.js') !!}"></script>
@endsection
@section('css')
    <link href="{!! asset('/css/logs.css') !!}" rel="stylesheet">
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection