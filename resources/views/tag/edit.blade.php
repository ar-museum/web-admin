@extends('layouts.app')

@section('content')
    <div class="col-md-6">
        <section class="panel">
            <header class="panel-heading">Modifică etichetă
                <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                        </span>
            </header>
            <div class="panel-body">
                @include('common.errors')
                <form class="form-horizontal" method="POST"
                      action="{!! route('update-tag', ['id' => $tag_selected->tag_id]) !!}"
                      enctype="multipart/form-data" role="form">

                    {!! csrf_field() !!}

                    <div class="form-group @if ($errors->has('tag_id'))has-error @endif">
                        <label class="col-lg-4 col-sm-4 control-label" for="old-name">Eticheta veche <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <select name="tag_id" class="form-control">
                                <option value="{{ $tag_selected->tag_id }}" selected>{{ $tag_selected->name }}</option>
                                @foreach ($tags as $tag)
                                    <option value="{!! $tag->tag_id !!}" @if (null !== old('tag_id')
                                        && $tag->name == old('tag_id')) selected @endif>{!! $tag->name !!}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-4 col-sm-4 control-label" for="name">Eticheta nouă <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Noul nume al etichetei">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-sm-12 text-right">
                            <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Resetabiliește</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Modifică</button>
                        </div>
                    </div>

                    <div class="text-danger">* Aceste câmpuri sunt obligatorii!</div>

                </form>
            </div>
        </section>
    </div>
@endsection

@section('css')
    <link href="{!! asset('/css/fileupload.css') !!}" rel="stylesheet">
@endsection

@section('js')
    <script src="{!! asset('/js/common/bootstrap-fileupload.js') !!}"></script>
    <script src="{!! asset('/js/tag/index.js') !!}"></script>
@endsection