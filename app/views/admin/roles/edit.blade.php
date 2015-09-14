@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
  {{-- Edit Role Form --}}
  <form class="form-horizontal" method="post" action="" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->

    <!-- Name -->
    <div class="form-group {{{ $errors->has('name') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="name">{{ Lang::get('admin/roles/create_edit.name') }}</label>
      <div class="col-md-10">
        <input class="form-control" type="text" name="name" id="name" value="{{{ Input::old('name', $role->name) }}}" />
        {{ $errors->first('name', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ name -->

    @foreach ($permissions as $permission)
      <div class="form-group">
        <label class="col-md-2 control-label" for="permissions[{{{ $permission['id'] }}}]">{{{ $permission['display_name'] }}}</label>
        <div class="col-md-1">
          <input class="form-control" type="checkbox" id="permissions[{{{ $permission['id'] }}}]" name="permissions[{{{ $permission['id'] }}}]" value="1"{{{ (isset($permission['checked']) && $permission['checked'] == true ? ' checked="checked"' : '')}}} />
        </div>
      </div>
    @endforeach

    <!-- Form Actions -->
    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <element class="btn btn-default close_popup">{{ Lang::get('button.cancel') }}</element>
        <button type="reset" class="btn btn-default">{{ Lang::get('button.reset') }}</button>
        <button type="submit" class="btn btn-success">{{ Lang::get('button.create') }}</button>
      </div>
    </div>
    <!-- ./ form actions -->
  </form>
@stop
