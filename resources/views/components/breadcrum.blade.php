@props([
    'name',
    'parent' => '0',
    'parentName' => '',
    'pageName',
    'buttonUrl' =>  url()->previous(),
    'buttonText' => 'Back',
    'permission' => '1'

])

<div class="toolbar d-flex flex-stack mb-3 mb-lg-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">
        <div class="page-title d-flex flex-column me-5 py-2">
            <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">{{ $name }}</h1>
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
                <li class="breadcrumb-item text-muted">
                    <a href="{{ route('admin.dashboard.index') }}" class="text-muted text-hover-primary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-200 w-5px h-2px"></span>
                </li>
                @if($parent)
                    <li class="breadcrumb-item text-muted">{{ $parentName }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-200 w-5px h-2px"></span>
                    </li>
                @endif
                <li class="breadcrumb-item text-dark">{{ $pageName }}</li>
            </ul>
        </div>
        @if($permission)
            <div class="d-flex align-items-center py-2">
                <a href="{{ $buttonUrl }}" class="btn btn-sm btn-primary">{{ $buttonText }}</a>
            </div>
        @endif
    </div>
</div>
