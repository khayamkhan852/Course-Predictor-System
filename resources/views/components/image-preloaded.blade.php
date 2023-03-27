@props([
    'name',
    'url' => asset('theme/assets/media/avatars/300-1.jpg')
])

<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $url }})"></div>
    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
           data-kt-image-input-action="change"
           data-bs-toggle="tooltip"
           data-bs-dismiss="click"
           title="Change Logo">
        <i class="bi bi-pencil-fill fs-7"></i>
        <input type="file" name="{{ $name }}" accept=".png, .jpg, .jpeg" />
    </label>
    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
          data-kt-image-input-action="cancel"
          data-bs-toggle="tooltip"
          data-bs-dismiss="click"
          title="Cancel Logo">
        <i class="bi bi-x fs-2"></i>
    </span>

    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
          data-kt-image-input-action="remove"
          data-bs-toggle="tooltip"
          data-bs-dismiss="click"
          title="Remove Logo">
        <i class="bi bi-x fs-2"></i>
    </span>
</div>

