{{ Form::model($site, ['route' => ['sites.update', $site->id], 'method' => 'PUT']) }}
<div class="modal-body">
    <div class="row">
        <div class="form-group col-md-4">
            {{ Form::label('name', __('Name'), ['class' => 'col-form-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter site name'), 'required'=>'required']) }}
        </div>

        <div class="form-group col-md-4">
            {{ Form::label('address', __('Address'), ['class' => 'col-form-label']) }}
            {{ Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('Enter Address')]) }}
        </div>
        <div class="form-group col-md-4">
            {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
            {{ Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('Enter City')]) }}
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('details', __('Site Details'), ['class' => 'col-form-label']) }}
            {{ Form::textarea('details', null, ['class' => 'form-control', 'placeholder' => __('Enter site details'), 'rows' => 3, 'style' => 'resize: none']) }}

        </div>

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-primary" type="submit" value="{{ __('Edit') }}">
</div>

{{ Form::close() }}
