@extends('admin.layouts.modal')

{{-- Style --}}
@section('styles')
@stop

{{-- Content --}}
@section('content')
<form id="form" class="form-horizontal" method="post" action="{{ URL::to('admin/affairs/translate/' . $post->id . '/edit/' . $lang) }}" autocomplete="off">
  {{ Form::token() }}

  <!-- Post Title -->
  <div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
    <div class="col-md-12">
      {{ Form::label('title', Lang::get('admin/blogs/create_edit.title'), array('class' => 'control-label')) }}
      {{ Form::text('title', Input::old('title', $post->title($lang)), array('class' => 'form-control')) }}
      {{ $errors->first('title', '<span class="help-block">:message</span>') }}
    </div>
  </div>
  <!-- ./ post title -->

  <!-- Post Content -->
  <div class="form-group {{{ $errors->has('content') ? 'error' : '' }}}">
    <div class="col-md-12">
      {{ Form::label('content', Lang::get('admin/blogs/create_edit.content'), array('class' => 'control-label')) }}
      <textarea class="form-control full-width wysihtml5" name="content" value="content" rows="10">{{{ Input::old('content', $post->content($lang)) }}}</textarea>
    {{ $errors->first('content', '<span class="help-block">:message</span>') }}
    </div>
  </div>
  <!-- ./ post content -->

	<!-- Form Actions -->
	<div class="form-group">
		<div class="col-md-12">
			<element class="btn-cancel close_popup">{{ Lang::get('admin/blogs/create_edit.cancel') }}</element>
			<button type="reset" class="btn btn-default">{{ Lang::get('admin/blogs/create_edit.reset') }}</button>
			<button type="submit" class="btn btn-success">{{ Lang::get('admin/blogs/create_edit.submit') }}</button>
		</div>
	</div>
	<!-- ./ form actions -->

</form>
@stop
