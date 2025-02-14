@extends('dashboard.layouts.master')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">{{ $title ?? '' }}</h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table border-top table-hover"
                data-href="{{ route('dashboard.activity.datatable') }}">
                <thead>
                    <tr>
                        <th data-column="id" data-searchable="false"></th>
                        <th data-column="user">{{__('dashboard.user')}}</th>
                        <th data-column="message">{{__('dashboard.message')}}</th>
                        <th data-column="actions" data-searchable="false" data-orderable="false">{{__('dashboard.actions')}}</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
