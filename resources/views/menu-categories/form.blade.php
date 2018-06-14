<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $menucategory->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
    <label for="order" class="col-md-4 control-label">{{ 'Order' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="order" type="number" id="order" value="{{ $menucategory->order or ''}}" required>
        {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1"{{ isset($menucategory) && $menucategory->status === 1 ? ' selected' : '' }}>Visible</option>
            <option value="0"{{ isset($menucategory) && $menucategory->status === 0 ? ' selected' : '' }}>Hidden</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
