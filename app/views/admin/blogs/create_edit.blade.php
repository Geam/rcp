@extends('admin.layouts.modal')

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">{{ Lang::get('admin/blogs/create_edit.general') }}</a></li>
			<li><a href="#tab-meta-data" data-toggle="tab">{{ Lang::get('admin/blogs/create_edit.meta') }}</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form class="form-horizontal" method="post" action="@if (isset($post)){{ URL::to('admin/blogs/' . $post->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">

				<!-- Post Title -->
				<div class="form-group {{{ $errors->has('title') ? 'error' : '' }}}">
          <div class="col-md-12">
            {{ Form::label('title', Lang::get('admin/blogs/create_edit.title'), array('class' => 'control-label')) }}
            {{ Form::text('title', Input::old('title', isset($post) ? $post->title() : null), array('class' => 'form-control')) }}
						{{ $errors->first('title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ post title -->

        <!-- Post importance -->
				<div class="form-group {{{ $errors->has('importance') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="importance">{{ Lang::get('admin/blogs/create_edit.importance') }}</label>
						<input class="form-control" type="number" name="importance" id="importance" value="{{{ Input::old('importance', isset($post) ? $post->importance : null) }}}" min=0 max=3 />
						{{ $errors->first('importance', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post importance -->

        <!-- Post slug -->
				<div class="form-group {{{ $errors->has('slug') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="slug">{{ Lang::get('admin/blogs/create_edit.slug') }}</label>
						<input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($post) ? $post->slug : null) }}}"/>
						{{ $errors->first('slug', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post slug -->

        <!-- Post nature -->
				<div class="form-group {{{ $errors->has('nature') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="nature">{{ Lang::get('admin/blogs/create_edit.nature') }}</label>
						<input class="form-control" type="text" name="nature" id="nature" value="{{{ Input::old('nature', isset($post) ? $post->nature : null) }}}" />
						{{ $errors->first('nature', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post nature -->

        <!-- Post affair_id -->
				<div class="form-group {{{ $errors->has('affair_id') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="affair_id">{{ Lang::get('admin/blogs/create_edit.affair_id') }}</label>
						<input class="form-control" type="text" name="affair_id" id="affair_id" value="{{{ Input::old('affair_id', isset($post) ? $post->affair_id : null) }}}" />
						{{ $errors->first('affair_id', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post affair_id -->

        <!-- Post post_lang -->
				<div class="form-group {{{ $errors->has('post_lang') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="post_lang">{{ Lang::get('admin/blogs/create_edit.post_lang') }}</label>
						<input class="form-control" type="text" name="post_lang" id="post_lang" value="{{{ Input::old('post_lang', isset($post) ? $post->lang : null) }}}" />
						{{ $errors->first('post_lang', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post post_lang -->

        <!-- Post state -->
				<div class="form-group {{{ $errors->has('state') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="state">{{ Lang::get('admin/blogs/create_edit.state') }}</label>
						<input class="form-control" type="text" name="state" id="state" value="{{{ Input::old('title', isset($post) ? $post->state : null) }}}" />
						{{ $errors->first('state', '<span class="help-block">:message</span>') }}
					</div>
        </div>
        <!-- ./ post state -->

				<!-- Content -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
                        <label class="control-label" for="content">{{ Lang::get('admin/blogs/create_edit.content') }}</label>
						<textarea class="form-control full-width wysihtml5" name="content" value="content" rows="10">{{{ Input::old('content', isset($post) ? $post->content() : null) }}}</textarea>
						{{ $errors->first('content', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

			<!-- Meta Data tab -->
			<div class="tab-pane" id="tab-meta-data">
				<!-- Meta Title -->
				<div class="form-group {{{ $errors->has('meta-title') ? 'error' : '' }}}">
					<div class="col-md-12">
            <label class="control-label" for="meta-title">{{ Lang::get('admin/blogs/create_edit.meta_title') }}</label>
						<input class="form-control" type="text" name="meta-title" id="meta-title" value="{{{ Input::old('meta-title', isset($post) ? $post->meta_title : null) }}}" />
						{{ $errors->first('meta-title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta title -->

				<!-- Meta Description -->
				<div class="form-group {{{ $errors->has('meta-description') ? 'error' : '' }}}">
					<div class="col-md-12 controls">
            <label class="control-label" for="meta-description">{{ Lang::get('admin/blogs/create_edit.meta_description') }}</label>
						<input class="form-control" type="text" name="meta-description" id="meta-description" value="{{{ Input::old('meta-description', isset($post) ? $post->meta_description : null) }}}" />
						{{ $errors->first('meta-description', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta description -->

				<!-- Meta Keywords -->
				<div class="form-group {{{ $errors->has('meta-keywords') ? 'error' : '' }}}">
					<div class="col-md-12">
            <label class="control-label" for="meta-keywords">{{ Lang::get('admin/blogs/create_edit.meta_keywords') }}</label>
						<input class="form-control" type="text" name="meta-keywords" id="meta-keywords" value="{{{ Input::old('meta-keywords', isset($post) ? $post->meta_keywords : null) }}}" />
						{{ $errors->first('meta-keywords', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ meta keywords -->
			</div>
			<!-- ./ meta data tab -->
		</div>
		<!-- ./ tabs content -->

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
