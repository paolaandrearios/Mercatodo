
<div class="sidebar">
    <ul class="sidebar__menu">
        <li>
            <i class="fas fa-home"></i>
            <a href="{{ url('/home') }}">{{ __('general.sidebar.home') }}</a>
        </li>

        @can('user.index')
        <li>
            <i class="fas fa-users"></i>
            <a href="{{ url('/users') }}">{{ __('general.sidebar.users') }}</a>
        </li>
        @endcan
    </ul>

</div>

