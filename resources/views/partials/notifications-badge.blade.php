                                        <li id="userNotifications">
                                            <a href="{{ route('account.entity', ['entity' => 'notifications']) }}" title="@lang('miscellaneous.menu.notifications')">
    @if (count($unread_notifications) > 0)
                                                <i class="bi bi-bell-fill" style="color: #6e9e1a; margin-right: 0.5rem!important;"></i>
                                                <span class="badge badge-notify">{{ count($unread_notifications) }}</span>
                                                <span class="hide-for-xs">@lang('miscellaneous.menu.notifications')</span>
    @else
                                                <i class="bi bi-bell" style="margin-right: 0.5rem!important;"></i>
                                                <span class="hide-for-xs">@lang('miscellaneous.menu.notifications')</span>
    @endif
                                            </a>
                                        </li>
