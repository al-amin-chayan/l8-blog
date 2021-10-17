@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Notifications') }}
                </div>

                <div class="card-body">
                    @include('components.alerts.success')
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Notification</th>
                            <th scope="col">Created</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                        $start = ($notifications->currentPage() - 1) * $notifications->perPage();
                        @endphp
                        @forelse ($notifications as $notification)
                            <tr class="{{ is_null($notification->read_at) ? 'unread' : 'read' }}">
                                <th scope="row">{{ ++$start }}</th>
                                <td>{!! $notification->data['title'] !!}</td>
                                <td>{{ $notification->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Action Items">
                                        @include('components.buttons.delete', ['item' => 'notification', 'title' => $notification->data['title']])
                                    </div>
                                </td>
                            </tr>
                            @php
                                if (is_null($notification->read_at)) {
                                    $notification->markAsRead();
                                }
                            @endphp
                        @empty
                            <tr>
                                <th scope="row" colspan="7">No Record Found</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                        <nav aria-label="Page navigation">
                            {{ $notifications->links() }}
                        </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
