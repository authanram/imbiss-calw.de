<div class="form-group {{ $errors->has('menu_category_id') ? 'has-error' : ''}}">
    <label for="menu_category_id" class="col-md-4 control-label">{{ 'Menu Category Id' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="menu_category_id" id="menu_category_id" required>
            <option>--</option>
            @foreach($menucategories as $category)
                <option value="{{ $category->id }}"{{ isset($menu) && $menu->menu_category_id === $category->id ? ' selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        {!! $errors->first('menu_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('number') ? 'has-error' : ''}}">
    <label for="number" class="col-md-4 control-label">{{ 'Number' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="number" name="number" type="number" id="number" value="{{ $menu->number or ''}}" required>
        {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $menu->name or ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('note') ? 'has-error' : ''}}">
    <label for="note" class="col-md-4 control-label">{{ 'Note' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="note" type="text" id="note" value="{{ $menu->note or ''}}" >
        {!! $errors->first('note', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" type="number" step="any" name="price" type="text" id="price" value="{{ $menu->price or ''}}" required>
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1"{{ isset($menu) && $menu->status === 1 ? ' selected' : '' }}>Visible</option>
            <option value="0"{{ isset($menu) && $menu->status === 0 ? ' selected' : '' }}>Hidden</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary btn-sm" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
