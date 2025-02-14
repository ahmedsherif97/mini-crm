@extends('dashboard.layouts.master')


@push('breadcrumbs')
    <x-dashboard.breadcrumbs :title="$title ?? ''">
    </x-dashboard.breadcrumbs>
@endpush

@section('content')
    <h4 class="py-3 mb-2">{{ $title ?? '' }}</h4>

    <p>
        {{__('role::dashboard.A role provided access to predefined menus and features so that depending on <br />
        assigned role an administrator can have access to what user needs.')}}
    </p>
    <!-- Role cards -->
    <div class="row g-4">
        @foreach ($result as $row)
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <h6 class="fw-normal">{{__('dashboard.total')}} {{__('dashboard.users')}}
                                : {{ $row->users_count ?? 0 }} </h6>
                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/5.png"
                                         alt="Avatar"/>
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Allen Rieske" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/12.png"
                                         alt="Avatar"/>
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Julee Rossignol" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/6.png"
                                         alt="Avatar"/>
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="Kaith D'souza" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/15.png"
                                         alt="Avatar"/>
                                </li>
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    title="John Doe" class="avatar avatar-sm pull-up">
                                    <img class="rounded-circle" src="{{ asset('assets') }}/img/avatars/1.png"
                                         alt="Avatar"/>
                                </li>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="role-heading">
                                <h4 class="mb-1">{{ $row->name }}</h4>
                                @can('update role')
                                    <a href="{{ route('dashboard.role.edit', $row->id) }}"
                                       class="role-edit-modal"><small>
                                            {{__('dashboard.update').' '.__('role::dashboard.the role')}}
                                        </small></a>
                                @endcan
                            </div>
                            <a href="javascript:void(0);" class="text-muted"><i class="bx bx-copy"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @can('create role')
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="row h-100">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                                <img src="{{ asset('assets') }}/img/illustrations/sitting-girl-with-laptop-light.png"
                                     class="img-fluid" alt="Image" width="120"
                                     data-app-light-img="illustrations/sitting-girl-with-laptop-light.png"
                                     data-app-dark-img="illustrations/sitting-girl-with-laptop-dark.png"/>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <button data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                        class="btn btn-primary mb-3 text-nowrap add-new-role">
                                    {{__('role::dashboard.create')}}
                                </button>
                                <p class="mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    @can('create role')
        <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-simple">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>{{__('dashboard.Create new')}}</h3>
                            <p>{{__('role::dashboard.Permissions will assigned after creation.')}}</p>
                        </div>
                        <form action="{{ route('dashboard.role.store') }}" class="row" method="POST">
                            @csrf
                            <div class="col-12 mb-3">
                                <label class="form-label">{{__('dashboard.a name').' '.__('role::dashboard.the role')}}</label>
                                <input type="text" name="name" class="form-control"
                                       placeholder="{{__('dashboard.a name').' '.__('role::dashboard.the role')}}"
                                       autofocus
                                       required/>
                            </div>
                            <div class="col-12 text-center demo-vertical-spacing">
                                <button type="submit"
                                        class="btn btn-primary me-sm-3 me-1">{{__('role::dashboard.create').' '.__('role::dashboard.role')}}</button>
                                <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    {{__('dashboard.close')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const table = $('.datatables-users')
            let tableColumns = [];
            table.find('thead tr th').each(function () {
                tableColumns.push({
                    data: $(this).data('column')
                });
            });

            table.DataTable({
                "searchDelay": 1000,
                "searchable": false,
                "processing": true,
                "serverSide": true,
                "ajax": "",
                "ajax": {
                    "url": "{{ route('dashboard.role.datatable') }}",
                    "type": "GET",
                },
                "buttons": [...dataTableButtons, [
                    //here rou can add more buttons
                ]],
                columns: tableColumns
            });
        });
    </script>
@endpush
