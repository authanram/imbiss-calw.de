<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">Name: </label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', $role->name ?? '') }}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
    <label for="label" class="col-md-4 control-label">Label: </label>
    <div class="col-md-6">
        <input class="form-control" name="label" type="text" id="label" value="{{ old('label', $role->label ?? '') }}">
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('label') ? ' has-error' : ''}}">
    <label for="permissions" class="col-md-4 control-label">Permissions: </label>
    <div class="col-md-6">
        @php($selectedPermissions = old('permissions', isset($role) ? $role->permissions->pluck('name')->all() : []))
        <select class="form-control" name="permissions[]" id="permissions" multiple>
            @foreach ($permissions as $name => $label)
                <option value="{{ $name }}" @selected(in_array($name, $selectedPermissions))>{{ $label }}</option>
            @endforeach
        </select>
        {!! $errors->first('label', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText ?? 'Create' }}">
    </div>
</div>
