@extends('admin.layouts.modal')

{{-- Style --}}
@section('styles')
@if (isset($post))
<link rel="stylesheet" type="text/css" href="{{ asset('assets/jstree/css/style.min.css') }}">
@endif
<link rel="stylesheet" type="text/css" href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}">
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
          {{ Form::select(
            'importance',
            [ 0 => Lang::get('filters.all'), 1 => 1, 2 => 2, 3 => 3, 4 => 'CR' ],
            Input::old('importance', isset($post) ? $post->importance : null),
            [ 'class' => "form-control", 'id' => "importance" ]
            ) }}
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
            ], false) }}
            {{ $errors->first('nature', '<span class="help-block">:message</span>') }}
          </div>
          <!-- ./ post nature -->
        </div>

        <!-- Post slug --><!--
        <div class="form-group {{{ $errors->has('slug') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="slug">{{ Lang::get('admin/blogs/create_edit.slug') }}</label>
            <input class="form-control" type="text" name="slug" id="slug" value="{{{ Input::old('slug', isset($post) ? $post->slug : null) }}}"/>
            {{ $errors->first('slug', '<span class="help-block">:message</span>') }}
          </div>
        </div>
        --><!-- ./ post slug -->

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
            <input id="p_date" name="p_date" type="text" value="{{{ Input::old('p_date', isset($post) ? date('d-m-Y', strtotime($post->p_date)) : null) }}}" class="form-control">
            {{ $errors->first('p_date', '<span class="help-block">:message</span>') }}
          </div>
          <!-- ./ post date -->
        </div>

        <div class="form-group {{{ $errors->has('post_lang') ? 'error' : '' }}}">
          <!-- Post post_lang -->
          <div class="col-md-6">
            <label class="control-label" for="post_lang">{{ Lang::get('admin/blogs/create_edit.post_lang') }}</label>
            {{ Form::selectStateOrLang('post_lang', 'lang', [
              'attr' => [
                'class' => 'form-control',
                'multiple' => ''
                ],
              'noall' => 'noall',
              'avail' => [
                'default' => Input::old('post_lang', isset($post) ? $post->lang : null),
                'data' => array_flip(Config::get('app.available_language'))
                ]
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
              'avail' => [
                'default' => Input::old('state', isset($post) ? $post->state : null)
                ]
              ]) }}
            {{ $errors->first('state', '<span class="help-block">:message</span>') }}
          </div>
          <!-- ./ post state -->
        </div>

        <!-- Content -->
        <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="content">{{ Lang::get('admin/blogs/create_edit.content') }}</label>
            <textarea class="form-control" name="content" id="content" value="content" rows="10">{{{ Input::old('content', isset($post) ? $post->content('en') : null) }}}</textarea>
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
        <div class="form-group {{{ $errors->has('meta_title') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="meta_title">{{ Lang::get('admin/blogs/create_edit.meta_title') }}</label>
            <input class="form-control" type="text" name="meta_title" id="meta_title" value="{{{ Input::old('meta_title', isset($post) ? $post->meta_title : null) }}}" />
            {{ $errors->first('meta_title', '<span class="help-block">:message</span>') }}
          </div>
        </div>
        <!-- ./ meta title -->

        <!-- Meta Description -->
        <div class="form-group {{{ $errors->has('meta_description') ? 'error' : '' }}}">
          <div class="col-md-12 controls">
            <label class="control-label" for="meta_description">{{ Lang::get('admin/blogs/create_edit.meta_description') }}</label>
            <input class="form-control" type="text" name="meta_description" id="meta_description" value="{{{ Input::old('meta_description', isset($post) ? $post->meta_description : null) }}}" />
            {{ $errors->first('meta_description', '<span class="help-block">:message</span>') }}
          </div>
        </div>
        <!-- ./ meta description -->

        <!-- Meta Keywords -->
        <div class="form-group {{{ $errors->has('meta_keywords') ? 'error' : '' }}}">
          <div class="col-md-12">
            <label class="control-label" for="meta_keywords">{{ Lang::get('admin/blogs/create_edit.meta_keywords') }}</label>
            <input class="form-control" type="text" name="meta_keywords" id="meta_keywords" value="{{{ Input::old('meta_keywords', isset($post) ? $post->meta_keywords : null) }}}" />
            {{ $errors->first('meta_keywords', '<span class="help-block">:message</span>') }}
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
        <element class="btn btn-default close_popup">{{ Lang::get('button.cancel') }}</element>
        <button type="reset" class="btn btn-default">{{ Lang::get('button.reset') }}</button>
        <button type="submit" class="btn btn-success">{{ (isset($post)) ? Lang::get('button.update') : Lang::get('button.create') }}</button>
      </div>
    </div>
    <!-- ./ form actions -->
  </form>
@stop

{{-- Scripts --}}
@section('scripts')
@if (isset($post))
<script src="{{ asset('assets/jstree/js/jstree.min.js') }}"></script>
@endif
<script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
$(document).ready(function() {
  @if (isset($post))
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
        "sort",
        "wholerow",
      ]
    })
    .bind('loaded.jstree', function (e, data) {
      var ref = $(this).jstree(true);
      @foreach ($post->categories()->get() as $cat)
        ref.check_node("{{ $cat->id }}");
      @endforeach
    });

    $('#form').submit( function (e) {
      e.preventDefault();
      var form = this;

      // categories form
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
            //;
          else
            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
        })
        .fail( function (ret) {
            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
        });

      // main form
//      $.ajax({
//        url: "{{ URL::to('admin/affairs/manage/' . $post->id . '/edit') }}",
//        method: "POST",
//        data: {
//          _token: $('input[name=_token]')[0].value,
//          affair_id: $('#affair_id')[0].value,
//          title: $('#title')[0].value,
//          importance: $('#importance')[0].value,
//          nature: $('#nature')[0].value,
//          p_date: $('#p_date')[0].value,
//          post_lang: $('#post_lang')[0].value,
//          state: $('#state')[0].value,
//          content: CKEDITOR.instances.content.getData(),
//          meta_title: $('#meta_title')[0].value,
//          meta_description: $('#meta_description')[0].value,
//          meta_keywords: $('#meta_keywords')[0].value
//        }
//      })
//        .done( function (ret) {
//          if (ret.success)
//            //form.submit();
//            ;
//          else
//            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
//        })
//        .fail( function (ret) {
//            alert("{{ Lang::get('admin/blogs/messages.update.error') }}");
//        });
    });

    @endif

      $('#p_date').datepicker({
        startView: 1,
        orientation: "top auto",
        language: "{{ App::getLocale() }}",
        autoclose: true,
        format: "dd-mm-yyyy",
    });
  });
</script>
@stop
