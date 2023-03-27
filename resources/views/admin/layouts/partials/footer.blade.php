<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-semibold me-1">{{ Carbon\Carbon::now()->format('Y') }}&copy;</span>
            <a href="{{ route('admin.dashboard.index') }}" target="_blank" class="text-gray-800 text-hover-primary">Rent a Vehicle</a>
        </div>
        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
            <li class="menu-item">
                <a href="#" target="_blank" class="menu-link px-2">About</a>
            </li>
        </ul>
    </div>
</div>
