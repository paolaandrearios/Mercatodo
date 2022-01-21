
<div class="sidebar">
    <ul class="sidebar__menu">
        <li>
            <i class="fas fa-home"></i>
            <a href="{{ route('admin.dashboard.index') }}">{{ __('general.sidebar.home') }}</a>
        </li>

        @can('user.index')
        <li>
            <i class="fas fa-users"></i>
            <a href="{{ route('admin.user.index') }}">{{ __('general.sidebar.users') }}</a>
        </li>
        @endcan

        @can('user.index')
        <li>
            <i class="fas fa-stream"></i>
            <a href="{{ route('admin.category.index') }}">{{ __('general.sidebar.categories') }}</a>
        </li>
        @endcan
    </ul>

</div>

