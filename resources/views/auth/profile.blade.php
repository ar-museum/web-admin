@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="{!! route('dashboard') !!}"><i class="fa fa-bar-chart-o"></i> Acasa</a></li>
                <li class="active">Profil</li>
            </ul>
            <!--breadcrumbs end -->
        </div>
    </div>
    <div class="row">
        <aside class="profile-nav col-md-6">
            <section class="panel">
                <div class="user-heading alt red-bg">
                    <a href="javascript:void(0);">
                        @if (null !== $user->photo)
                            <img src="{!! asset('/uploads/photo/original/' . $user->photo->filename) !!}" alt="Poza ta">
                        @else
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                        @endif
                    </a>
                    <h1>{{ $staff->full_name }}</h1>
                    <p>{{ $staff->email }}</p>
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-cog"></i> Optiune 1</a>
                    </li>
                </ul>
            </section>
        </aside>
        <aside class="profile-nav alt green-border col-md-6">
            <section class="panel">
                <div class="user-heading alt green-bg">
                    <a href="javascript:;">
                        @if (null !== $staff->photo)
                            <img src="{!! asset('/uploads/photo/original/' . $staff->photo->filename) !!}" alt="Poza ta">
                        @else
                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=fara+poza" alt="">
                        @endif
                    </a>
                    <h1>{{ $staff->full_name }}</h1>
                    <p>{{ $staff->email }}</p>
                </div>
                <ul class="nav nav-pills nav-stacked">
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-clock-o"></i> Activ de la <span class="label label-success pull-right r-activity">{!! date('Y-m-d', strtotime($staff->created_at)) !!}</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-camera-retro"></i> Expozitii create <span class="label label-primary pull-right r-activity">11</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-picture-o"></i> Exponate create <span class="label label-danger pull-right r-activity">11</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-male"></i> Autori creati <span class="label label-warning pull-right r-activity">11</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-tasks"></i> Categorii create <span class="label label-default pull-right r-activity">11</span></a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            <i class="fa fa-tags"></i> Etichete create <span class="label label-inverse pull-right r-activity">11</span></a>
                    </li>
                </ul>
            </section>
        </aside>
    </div>
@endsection