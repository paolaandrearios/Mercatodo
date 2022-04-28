
<div class="sidebar">
    <ul class="sidebar__menu">
        @can('admin.dashboard.index')
        <li>
            <i class="fas fa-home"></i>
            <a href="{{ route('admin.dashboard.index') }}">{{ __('general.sidebar.home') }}</a>
        </li>
        @endcan

        @can('admin.user.index')
        <li>
            <i class="fas fa-users"></i>
            <a href="{{ route('admin.user.index') }}">{{ __('general.sidebar.users') }}</a>
        </li>
        @endcan
        @can('admin.category.index')
            <li>
                <i class="fas fa-stream"></i>
                <a href="{{ route('admin.category.index') }}">{{ __('general.sidebar.categories') }}</a>
            </li>
        @endcan
        @can('admin.product.index')
            <li>
                <i class="fas fa-tshirt"></i>
                <a href="{{ route('admin.product.index') }}">{{ __('general.sidebar.products') }}</a>
            </li>
        @endcan
        @can('admin.orders.index')
        <li>
            <i class="fas fa-box-open"></i>
            <a href="{{ route('admin.orders.index') }}">{{ __('general.sidebar.customer_orders') }}</a>
        </li>
        @endcan
        @can('admin.products.import')
            <li>
                <i class="fas fa-file-import"></i>
                <a href="{{ route('admin.products.import') }}">{{ __('general.web.data_management.import_products') }}</a>
            </li>
        @endcan
        <li>
            <i class="fas fa-shopping-cart"></i>
            <a href="{{ route('client.product.index') }}">{{ __('general.sidebar.e-commerce') }}</a>
        </li>
    </ul>

</div>

