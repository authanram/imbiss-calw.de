<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">Name: </label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', $user->name ?? '') }}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    <label for="email" class="col-md-4 control-label">Email: </label>
    <div class="col-md-6">
        <input class="form-control" name="email" type="email" id="email" value="{{ old('email', $user->email ?? '') }}" required>
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    <label for="password" class="col-md-4 control-label">Password: </label>
    <div class="col-md-6">
        <input class="form-control" name="password" type="password" id="password" required>
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('roles') ? ' has-error' : ''}}">
    <label for="roles" class="col-md-4 control-label">Role: </label>
    <div class="col-md-6">
        @php($selectedRoles = old('roles', $user_roles ?? []))
        <select class="form-control" name="roles[]" id="roles" multiple>
            @foreach ($roles as $name => $label)
                <option value="{{ $name }}" @selected(in_array($name, $selectedRoles))>{{ $label }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText ?? 'Create' }}">
    </div>
</div>
