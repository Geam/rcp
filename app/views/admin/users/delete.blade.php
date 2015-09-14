@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
    {{-- Delete User Form --}}
    <form id="deleteForm" class="form-horizontal" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/delete') }}@endif" autocomplete="off">
      <!-- CSRF Token -->
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      <input type="hidden" name="id" value="{{ $user->id }}" />
      <!-- ./ csrf token -->

      <!-- Form Actions -->
      <div class="form-group">
        <div class="controls">
          <h4>{{ Lang::get('button.delete') . ' ' . $user->username }} </h4>
          <element class="btn btn-default close_popup">{{ Lang::get('button.cancel') }}</element>
          <button type="submit" class="btn btn-danger">{{ Lang::get('button.delete') }}</button>
        </div>
      </div>
      <!-- ./ form actions -->
    </form>
@stop
