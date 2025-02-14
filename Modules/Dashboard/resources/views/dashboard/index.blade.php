@extends('dashboard.layouts.master')


@section('content')
    @if(!auth()->user()->email_verified_at && class_basename(auth()->user()->model_type) == 'Patron')
        <div class="alert alert-danger col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
            <p style="font-weight: bold">
                لم يتم تأكيد البريد الإلكتروني، لإعادة إرسال الرسالة برجاء
                <a style="text-underline: none"
                   href="{{route('dashboard.user.resend.email') . '?resend=1'}}">الضغط
                    هنا</a>
            </p>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{__('dashboard.Welcome to').' '.auth()->user()->name}}
                                🎉</h5>
                            <p class="mb-4">
                                {{__('dashboard.wait for statistics')}}
                            </p>

                            <a href="{{route('dashboard.setting.index')}}"
                               class="btn btn-sm btn-label-primary">{{__('dashboard.List')}}
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

    @if(in_array(class_basename(auth()->user()->model_type), ['Patron', 'Organization']))
        <div class="card">
            <div class="card-header">
                <h5 class="text-primary">
                    {{__('project::dashboard.active projects')}}
                </h5>
            </div>
            <div class="row">
                @foreach($projects as $project)
                    <div class="col-sm-6 col-lg-4 py-3">
                        <div class="card p-2 h-100 shadow-none border">
                            <div class="rounded-2 text-center mb-3">
                                <a href="#"
                                ><img
                                            class="img-fluid" style="height: 200px !important;"
                                            src="{{asset($project->image? : 'assets/img/pages/app-academy-tutor-2.png')}}"
                                            alt="{{__('project::dashboard.an image').' '.$project->name}}"
                                    /></a>
                            </div>
                            <div class="card-body p-3 pt-2">
                                <div class="d-flex justify-content-between align-items-center mb-3 pe-xl-3 pe-xxl-0">
                                    <span class="badge bg-label-danger">{{$project->domain->name}}</span>
                                </div>
                                <a class="h5" href="#">{{$project->name}}</a>
                                <p class="mt-2 description">
                                    @if (strlen($project->description) > 60)
                                        {{ Str::limit($project->description, 60, '...') }}
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{ $project->id }}"
                                           style="text-decoration: none">عرض المزيد</a>
                                    @else
                                        {{ $project->description }}
                                    @endif
                                </p>
                                <div class="modal fade" id="modal-{{ $project->id }}" tabindex="-1"
                                     aria-labelledby="modalLabel-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="modalLabel-{{ $project->id }}">{{ $project->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $project->description }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="d-flex align-items-center">{{number_format($project->goal)}}</p>
                                <div class="progress mb-4" style="height: 8px">
                                    <div
                                            class="progress-bar w-25"
                                            role="progressbar"
                                            aria-valuenow="25"
                                            aria-valuemin="0"
                                            aria-valuemax="100">

                                    </div>
                                </div>
                                <div class="d-flex flex-column flex-md-row gap-2 text-nowrap">
                                    <a
                                            class="app-academy-md-50 btn btn-label-primary d-flex align-items-center"
                                            href="{{route('dashboard.project.show', $project->id)}}">
                                        <span class="me-2">{{__('beneficiary::dashboard.the details')}}</span><i
                                                class="bx bx-chevron-right lh-1 scaleX-n1-rtl"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endif
@endsection
@push('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if(session('resend'))
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                swal({
                    icon: 'success',
                    title: 'Success',
                    text: 'تمت إعادة إرسال رسالة التأكيد، برجاء تفقد بريدك الإلكتروني',
                    buttons: {
                        confirm: {
                            text: 'OK',
                            value: true,
                            visible: true,
                            className: 'btn btn-primary',
                            closeModal: true
                        }
                    }
                });
            });
        </script>
    @endif
    <?php
    session()->put('resend', null);
    ?>
@endpush
