@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ String::title($post->title(App::getLocale())) }}} ::
@parent
@stop

{{-- Update the Meta Title --}}
@section('meta_title')
@parent

@stop

{{-- Update the Meta Description --}}
@section('meta_description')
<meta name="description" content="{{{ $post->meta_description }}}" />

@stop

{{-- Update the Meta Keywords --}}
@section('meta_keywords')
<meta name="keywords" content="{{{ $post->meta_keywords }}}" />

@stop

@section('meta_author')
<meta name="author" content="{{{ $post->author->username }}}" />
@stop

{{-- Styles --}}
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/themes/default/style.min.css">
<style>
.jstree-default .jstree-disabled.jstree-clicked {
  background: none repeat scroll 0% 0% #BEEBFF;
}
</style>
@stop

{{-- Content --}}
@section('content')
<h3>{{ Lang::get('filters.affair') . ' ' . $post->title(App::getLocale()) }}</h3>
<div class="table-responsive">
  <table class="table table-bordered">
    <tr>
      <th>{{ Lang::get('filters.importance') }}</th>
      <th>{{ Lang::get('filters.nature') }}</th>
      <th>{{ Lang::get('filters.affair_id') }}</th>
      <th>{{ Lang::get('filters.lang') }}</th>
      <th>{{ Lang::get('filters.state') }}</th>
      <th>{{ Lang::get('filters.date') }}</th>
    </tr>
    <tr>
      <td>{{ $post->importance }}</td>
      <td>{{ Lang::get('filters.natures.' . $post->nature) }}</td>
      <td>{{ $post->affair_id }}</td>
      <td>{{ Lang::get('langs.' . $post->lang) }}</td>
      <td>{{ Lang::get('states.' . $post->state) }}</td>
      <td>{{ date('d/m/Y', strtotime($post->p_date)) }}</td>
    </tr>
  </table>
</div>
<div>
  <h4 onclick="hideShow(this)">{{ Lang::get('filters.show_cat') }}</h4>
  <div id="tree" class="hide"></div>
</div>
<div class="well">
  <div class="pull-right">
    <label for="langSelect">{{ Lang::get('filters.lang') }}</label>
    {{ Form::selectStateOrLang("langSelect", "lang", ['noall' => true, 'avail' => $post->availableLang()]) }}
  </div>
  @foreach ($post->content(null) as $text)
    @if ($text->lang == $post->availableLang()['default'])
      <div id="{{ $text->lang }}" >
    @else
      <div id="{{ $text->lang }}" style="display: none">
    @endif
      <p>{{ nl2br($text->content) }}</p>
    </div>
  @endforeach
</div>
<hr />
@stop

{{-- Scripts --}}
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.0.9/jstree.min.js"></script>
<script>
$( document ).ready(function() {
  var langSelect = $('#langSelect')
    .on('change', function() {
      $('.well div').each( function(id) {
        if (id > 0) {
          if (this.id == langSelect.val()) {
            $(this).show();
            } else {
              $(this).hide();
            }
          }
        });
      });
    langSelect.val('{{ $post->availableLang()["default"] }}');

    $('#tree').jstree({
    core: {
    animation: 0,
      theme: { stripes: true },
      data: {
      url: "{{ URL::to('cattree') }}",
        datatype: "json"
        },
      },
      types: {
      disabled: {
      "check_node": false,
        "uncheck_node": false
        },
        "default": {
        "check_node": false,
          "uncheck_node": false
        }
      },
        plugins: [
          "checkbox",
        ],
    })
    .bind('loaded.jstree', function (e, data) {
      var ref = $(this).jstree(true);
      @foreach ($post->categories()->get() as $cat)
        ref.check_node("{{ $cat->id }}");
      @endforeach
        for ( key in ref._model.data) {
          ref.disable_node(key);
      }
      ref.hide_checkboxes();
    });
  });

  function hideShow(e) {
    if ( $('#tree').hasClass('hide') ) {
      $('#tree').removeClass('hide');
      e.innerHTML = "{{ Lang::get('filters.hide_cat') }}";
    } else {
      $('#tree').addClass('hide');
      e.innerHTML = "{{ Lang::get('filters.show_cat') }}";
    }
  }
</script>
@stop
