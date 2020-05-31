
@php
    $all_notifications = auth()->user()->notifications ?? null;
    if($all_notifications) {
        $unread_notifications = $all_notifications->where('read_at', null);
        $total_unread = count($unread_notifications);
    }
@endphp
<li class="dropdown dropdown-notification nav-item load_notifications d-none"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up notifications_count">{{ $total_unread ?? 0 }}</span></a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right notif_content">
        <li class="dropdown-menu-header">
            <div class="dropdown-header m-0 p-2">
                <h3 class="white">{{ $total_unread ?? 0 }} New</h3><span class="grey darken-2">Notifications</span>
            </div>
        </li>
        <li class="scrollable-container media-list notifications_list">

        </li>
    </ul>
</li>