@foreach($notifications_data as $notification_data)
    <a class="d-flex justify-content-between" href="javascript:void(0)">
        <div class="media d-flex align-items-start">
            <div class="media-left"><i class="{{ $notification_data['icon_class'] ?? 'feather icon-plus-square' }} font-medium-5 {{ $notification_data['text_class'] ?? 'primary' }}"></i></div>
            <div class="media-body">
                <h6 class="{{ $notification_data['text_class'] ?? 'primary' }} media-heading">{!! $notification_data['title'] ?? '' !!}</h6><small class="notification-text"> {!! $notification_data['msg'] ?? '' !!}</small>
            </div><small>{{$notification_data['created_at']}}</small>
        </div>
    </a>
@endforeach