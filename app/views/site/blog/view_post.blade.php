@extends('site.layouts.default')

{{-- Web site Title --}}
@section('title')
{{{ String::title($post->title()) }}} ::
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

{{-- Content --}}
@section('content')
<h3>Affair {{ $post->title() }}</h3>
<p>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>{{ Lang::get('filters.importance') }}</th>
        <th>{{ Lang::get('filters.nature') }}</th>
        <th>{{ Lang::get('filters.affair_id') }}</th>
        <th>{{ Lang::get('filters.lang') }}</th>
        <th>{{ Lang::get('filters.state') }}</th>
        <th>{{Lang::get('filters.date') }}</th>
      </tr>
      <tr>
        <td>{{ $post->importance }}</td>
        <td>{{ ucfirst($post->nature) }}</td>
        <td>{{ $post->affair_id }}</td>
        <td>{{ Lang::get('langs.' . $post->lang) }}</td>
        <td>{{ Lang::get('states.' . $post->state) }}</td>
        <td>{{ date('d/m/Y', strtotime($post->p_date)) }}</td>
      </tr>
    </table>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th>{{ Lang::get('filters.categories') }}</th>
      </tr>
      @foreach ($post->posts_cats()->get() as $cat)
      <tr><td>{{ $cat->getParentName() }}</td></tr>
      @endforeach
    </table>
  </div>
</p>
<div class="well">
<p>{{ $post->content() }}</p>
</div>
<hr />
@stop

{{-- Scripts --}}
@section('scripts')

@stop
