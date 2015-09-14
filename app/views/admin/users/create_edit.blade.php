@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
  {{-- Create User Form --}}
  <form class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/edit') }}@endif" autocomplete="off">
    <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <!-- ./ csrf token -->

    <!-- username -->
    <div class="form-group {{{ $errors->has('username') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="username">{{ Lang::get('admin/users/create_edit.username') }}</label>
      <div class="col-md-10">
        <input class="form-control" type="text" name="username" id="username" value="{{{ Input::old('username', isset($user) ? $user->username : null) }}}" />
        {{ $errors->first('username', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ username -->

    <!-- Email -->
    <div class="form-group {{{ $errors->has('email') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="email">{{ Lang::get('admin/users/create_edit.email') }}</label>
      <div class="col-md-10">
        <input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
        {{ $errors->first('email', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ email -->

    <!-- Password -->
    <div class="form-group {{{ $errors->has('password') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="password">{{ Lang::get('admin/users/create_edit.password') }}</label>
      <div class="col-md-10">
        <input class="form-control" type="password" name="password" id="password" value="" />
        {{ $errors->first('password', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ password -->

    <!-- Password Confirm -->
    <div class="form-group {{{ $errors->has('password_confirmation') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="password_confirmation">{{ Lang::get('admin/users/create_edit.password_conf') }}</label>
      <div class="col-md-10">
        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" value="" />
        {{ $errors->first('password_confirmation', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ password confirm -->

    <!-- Activation Status -->
    <div class="form-group {{{ $errors->has('activated') || $errors->has('confirm') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="confirm">{{ Lang::get('admin/users/create_edit.user_activation') }}</label>
      <div class="col-md-6">
        @if ($mode == 'create')
          <select class="form-control" name="confirm" id="confirm">
            <option value="1"{{{ (Input::old('confirm', 0) === 1 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
            <option value="0"{{{ (Input::old('confirm', 0) === 0 ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
          </select>
        @else
          <select class="form-control" {{{ ($user->id === Confide::user()->id ? ' disabled="disabled"' : '') }}} name="confirm" id="confirm">
            <option value="1"{{{ ($user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.yes') }}}</option>
            <option value="0"{{{ ( ! $user->confirmed ? ' selected="selected"' : '') }}}>{{{ Lang::get('general.no') }}}</option>
          </select>
        @endif
        {{ $errors->first('confirm', '<span class="help-inline">:message</span>') }}
      </div>
    </div>
    <!-- ./ activation status -->

    <!-- Groups -->
    <div class="form-group {{{ $errors->has('roles') ? 'error' : '' }}}">
      <label class="col-md-2 control-label" for="roles">{{ Lang::get('admin/users/create_edit.roles') }}</label>
      <div class="col-md-6">
        <select class="form-control" name="roles[]" id="roles[]" multiple>
          @foreach ($roles as $role)
            @if ($mode == 'create')
              <option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
            @else
              <option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
            @endif
          @endforeach
        </select>

        <span class="help-block">
          {{ Lang::get('admin/users/create_edit.roles_helper') }}
        </span>
      </div>
    </div>
    <!-- ./ groups -->

    <!-- Form Actions -->
    <div class="form-group">
      <div class="col-md-offset-2 col-md-10">
        <element class="btn btn-default close_popup">{{ Lang::get('button.cancel') }}</element>
        <button type="reset" class="btn btn-default">{{ Lang::get('button.reset') }}</button>
        <button type="submit" class="btn btn-success">{{ (isset($user)) ? Lang::get('button.update') : Lang::get('button.create') }}</button>
      </div>
    </div>
    <!-- ./ form actions -->
  </form>
@stop
