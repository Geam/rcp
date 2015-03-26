@extends('admin.layouts.modal')

{{-- Style --}}
@section('styles')
@if (isset($post))
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
<link rel="stylesheet" href="{{ asset('datepicker/css/bootstrap-datepicker.min.css') }}">
@endif
@stop

{{-- Content --}}
@section('content')
	<!-- Tabs -->
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab-general" data-toggle="tab">{{ Lang::get('admin/blogs/create_edit.general') }}</a></li>
      @if (isset($post))
      <li><a href="#tab-tree" data-toggle="tab">{{ Lang::get('admin/blogs/create_edit.categories') }}</a></li>
      @endif
			<li><a href="#tab-meta-data" data-toggle="tab">{{ Lang::get('admin/blogs/create_edit.meta') }}</a></li>
		</ul>
	<!-- ./ tabs -->

	{{-- Edit Blog Form --}}
	<form id="form" class="form-horizontal" method="post" action="@if (isset($post)){{ URL::to('admin/affairs/manage/' . $post->id . '/edit') }}@endif" autocomplete="off">
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
            {{ Form::text('title', Input::old('title', isset($post) ? $post->title('en') : null), array('class' => 'form-control')) }}
						{{ $errors->first('title', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ post title -->

				<div class="form-group {{{ $errors->has('importance') ? 'error' : '' }}}">
          <!-- Post importance -->
          <div class="col-md-6">
            <label class="control-label" for="importance">{{ Lang::get('admin/blogs/create_edit.importance') }}</label>
						<input class="form-control" type="number" name="importance" id="importance" value="{{{ Input::old('importance', isset($post) ? $post->importance : null) }}}" min=0 max=3 />
						{{ $errors->first('importance', '<span class="help-block">:message</span>') }}
					</div>
          <!-- ./ post importance -->
          <!-- post nature -->
          <div class="col-md-6">
            <label class="control-label" for="nature">{{ Lang::get('admin/blogs/create_edit.nature') }}</label>
            {{ Form::nature('nature', [
              'attr' => [
                'class' => 'form-control'
              ],
              'default' => isset($post) ? $post->nature : null
            ]) }}
						{{ $errors->first('nature', '<span class="help-block">:message</span>') }}
					</div>
          <!-- ./ post nature -->
				</div>

        <!-- Post slug -->
				<div class="form-group {{{ $errors->has('slug') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="slug">{{ Lang::get('admin/blogs/create_edit.slug') }}</label>
						<input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($post) ? $post->slug : null) }}}"/>
						{{ $errors->first('slug', '<span class="help-block">:message</span>') }}
					</div>
				</div>
        <!-- ./ post slug -->

				<div class="form-group {{{ $errors->has('affair_id') ? 'error' : '' }}}">
          <!-- Post affair_id -->
          <div class="col-md-6">
            <label class="control-label" for="affair_id">{{ Lang::get('admin/blogs/create_edit.affair_id') }}</label>
						<input class="form-control" type="text" name="affair_id" id="affair_id" value="{{{ Input::old('affair_id', isset($post) ? $post->affair_id : null) }}}" />
						{{ $errors->first('affair_id', '<span class="help-block">:message</span>') }}
					</div>
          <!-- ./ post affair_id -->
          <!-- Post date -->
          <div class="col-md-6">
            <label class="control-label" for="p_date">{{ Lang::get('admin/blogs/create_edit.post_date') }}</label>
            <input id="p_date" name="p_date" type="text" value="{{{ Input::old('p_date', isset($post) ? date('d/m/Y', strtotime($post->p_date)) : null) }}}" class="form-control">
            {{ $errors->first('p_date', '<span class="help-block">:message</span>') }}
          </div>
          <!-- ./ post date -->
				</div>

				<div class="form-group {{{ $errors->has('post_lang') ? 'error' : '' }}}">
          <!-- Post post_lang -->
          <div class="col-md-6">
            <label class="control-label" for="post_lang">{{ Lang::get('admin/blogs/create_edit.post_lang') }}</label>
            {{ Form::selectStateOrLang('post_lang', 'lang', [
              'attr' => ['class' => 'form-control'],
              'noall' => 'noall',
              'avail' => ['default' => isset($post) ? $post->lang : null]
              ]) }}
						{{ $errors->first('post_lang', '<span class="help-block">:message</span>') }}
					</div>
          <!-- ./ post post_lang -->
          <!-- Post state -->
          <div class="col-md-6">
            <label class="control-label" for="state">{{ Lang::get('admin/blogs/create_edit.state') }}</label>
            {{ Form::selectStateOrLang('state', 'state', [
              'attr' => ['class' => 'form-control'],
              'noall' => 'noall',
              'avail' => ['default' => isset($post) ? $post->state : null]
              ]) }}
						{{ $errors->first('state', '<span class="help-block">:message</span>') }}
					</div>
          <!-- ./ post state -->
				</div>

				<!-- Content -->
				<div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
					<div class="col-md-12">
            <label class="control-label" for="content">{{ Lang::get('admin/blogs/create_edit.content') }}</label>
						<textarea class="form-control full-width wysihtml5" name="content" value="content" rows="10">{{{ Input::old('content', isset($post) ? $post->content('en') : null) }}}</textarea>
						{{ $errors->first('content', '<span class="help-block">:message</span>') }}
					</div>
				</div>
				<!-- ./ content -->
			</div>
			<!-- ./ general tab -->

      @if (isset($post))
      <!-- Categories tab -->
      <div class="tab-pane" id="tab-tree">
        <div id="tree"></div>
      </div>
      <!-- ./ categories tab -->
      @endif

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

{{-- Scripts --}}
@section('scripts')
@if (isset($post))
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
<script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
  $(document).ready(function() {
    $('#tree').jstree({
      core: {
        animation: 0,
        check_callback: true,
        theme: { stripes: true },
        data: {
          url: "{{ URL::to('cattree/') }}",
          dataType: "json"
        },
      },
      plugins: [
        "checkbox", // allow multi selecting
        "search", // search in the tree (need additional code)
        "wholerow",
      ]
    })
    .bind('loaded.jstree', function (e, data) {
      var ref = $(this).jstree(true);
      @foreach ($post->categories()->get() as $cat)
        ref.check_node("{{ $cat->id }}");
      @endforeach
        console.log(ref.get_selected());
    });

    $('#form').submit( function (e) {
      e.preventDefault();
      var form = this;
      $.ajax({
        url: "{{ URL::to('admin/affairs/manage/' . $post->id . '/category') }}",
        method: "POST",
        data: {
          _token: $('input[name=_token]')[0].value,
          _id: $('#affair_id')[0].value,
          _cat: $('#tree').jstree(true).get_selected()
        }
      })
        .done( function (ret) {
          if (ret.success)
            form.submit();
          else
            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
        })
        .fail( function (ret) {
            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
        });
    });

    $('#p_date').datepicker({
      startView: 1,
      orientation: "top auto",
      language: "{{ App::getLocale() }}",
      autoclose: true
    });
  });
</script>
@endif
@stop
