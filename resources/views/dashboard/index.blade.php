@extends('dashboard.layouts.master')


@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{__('dashboard.Welcome to').' '.auth()->user()->name}} 🎉</h5>
                            <p class="mb-4">
                                {{__('dashboard.wait for statistics')}}
                            </p>

                            <a href="{{route('dashboard.setting.index')}}" class="btn btn-sm btn-label-primary">{{__('dashboard.List')}}
                                {{__('setting::dashboard.settings')}}</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                 alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                 data-app-light-img="illustrations/man-with-laptop-light.png"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
