{{ Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
<div class="modal-body">

    <div class="form-group">
        {{ Form::label('name', __('Category Name'), ['class' => 'col-form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter new Category Name')]) }}
        <div class="form-group">
            {{ Form::label('urdu', __('Category in Urdu'), ['class' => 'col-form-label']) }}
            {{ Form::text('urdu', null, ['class' => 'form-control', 'placeholder' => __('Enter Category in urdu')]) }}
        </div>
        <div class="mb-4 col-md-6">
            <div class="choose-files mt-3">
                <label for="image">
                    <div class=" bg-primary edit-product-image"><i
                            class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                    </div>
                    <input type="file" class="form-control file d-none" name="image" id="image"
                           data-filename="edit-product-image" accept="image/*">
                </label>
            </div>
        </div>

        <div class="col-md-6 my-auto">
            {{ Form::hidden('imgstatus', 0) }}
            <div class="form-group" id="product-image">
                <a href="{{ asset(Storage::url($category->image)) }}" target="_blank">
                    <img src="{{ asset(Storage::url($category->image)) }}" class="profile-image rounded-circle-product"
                         onerror="this.onerror=null;this.src='{{ asset(Storage::url('logo/placeholder.png')) }}';">
                </a>

                <button type="button" class="action-btn btn-danger btn-xs ms-3 mt-2 product-img-btn">
                    <i class="ti ti-trash text-white btn-xs mb-1"></i>
                </button>
            </div>
        </div>
    </div>

</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Edit') }}">
</div>
{{ Form::close() }}
