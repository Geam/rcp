@extends('site.layouts.default')

{{-- Title --}}
@section('title')
{{ Lang::get('site.title') }}
@stop

{{-- Result --}}
@section('result')
@foreach ($posts as $post)
<div class="row">
  <div class="col-md-8">
    <!-- Post Title -->
    <div class="row">
      <div class="col-md-8">
        <h4><strong><a href="{{{ $post->url() }}}">{{ String::title($post->title()) }}</a></strong></h4>
      </div>
    </div>
    <!-- ./ post title -->

    <!-- Post Content -->
    <div class="row">
      <div class="col-md-2">
        <a href="{{{ $post->url() }}}" class="thumbnail"><img src="http://placehold.it/260x180" alt="">{{ String::title($post->title()) }}</a>
      </div>
      <div class="col-md-6">
        <p>
          {{ String::tidy(Str::limit($post->content(), 200)) }}
        </p>
        <p><a class="btn btn-mini btn-default" href="{{{ $post->url() }}}">Read more</a></p>
      </div>
    </div>
    <!-- ./ post content -->

    <!-- Post Footer -->
    <div class="row">
      <div class="col-md-8">
        <p></p>
        <p>
          <span class="glyphicon glyphicon-user"></span> by <span class="muted">{{{ $post->author->username }}}</span>
          | <span class="glyphicon glyphicon-calendar"></span> <!--Sept 16th, 2012-->{{{ $post->date() }}}
          | <span class="glyphicon glyphicon-comment"></span> <a href="{{{ $post->url() }}}#comments">{{$post->comments()->count()}} {{ \Illuminate\Support\Pluralizer::plural('Comment', $post->comments()->count()) }}</a>
        </p>
      </div>
    </div>
    <!-- ./ post footer -->
  </div>
</div>

<hr />
@endforeach

{{ $posts->links() }}

@stop

{{-- Content --}}
@section('content')
{{ Form::open(array('url' => 'search', 'class' => 'form-horizontal')) }}
{{ Tabbable::withContents([
  [
    'title' => Lang::get('filters.category'),
    'content' => Form::selectFilter('category1', Category::getOptionsFromParent($tree, 0), 'Select a category')
  ],
  [
    'title' => Lang::get('filters.affair_id'),
    'content' => "<p>affair_id</p>"
  ],
  [
    'title' => Lang::get('filters.nature'),
    'content' => "<p>nature</p>"
  ],
  [
    'title' => Lang::get('filters.importance'),
    'content' => "<p>importance</p>"
  ],
  [
    'title' => Lang::get('filters.lang'),
    'content' => "<p>lang</p>"
  ],
  [
    'title' => Lang::get('filters.state'),
    'content' => "<p>state</p>"
  ],
  [
    'title' => Lang::get('filters.date'),
    'content' => "<p>date</p>"
  ],
]) }}
{{ Form::close() }}
<div id="results">
</div>
@stop

{{-- Scripts --}}
@section('scripts')
  <script type="text/javascript">
    var catTree = {{ json_encode($tree) }};

    function addFilter(elem, e_parent) {
      var childs = catTree[elem.value].childs;
      var arrayLength = childs.length;

      if (arrayLength > 0) {
        // create new div
        var newDiv = document.createElement('div');
        newDiv.className = "col-md-12";

        // create new select element
        var newSelect = document.createElement('select');
        var extract = elem.name.match(/^([a-z-A-Z]*)([0-9]*)$/);
        newSelect.name = extract[1] + (extract[2] * 1 + 1);
        newSelect.id = newSelect.name;
        newSelect.setAttribute('onchange', 'updateFilter(this);requestData(this)');
        newSelect.className = "col-md-12";
        newDiv.appendChild(newSelect);

        // create the default input
        var newOption = document.createElement('option');
        newOption.value = 0;
        newOption.innerHTML = e_parent.getElementsByTagName('option')[0].innerHTML;
        newSelect.appendChild(newOption);

        // list all available options
        for (var i = 0; i < arrayLength; i++) {
          var  newOption = document.createElement('option');
          newOption.value = childs[i];
          newOption.innerHTML = catTree[childs[i]].short_name;
          newSelect.appendChild(newOption);
        }

        // add the new select to dom
        e_parent.appendChild(newDiv);
      }
    }

    function updateFilter(elem) {
      var e_div = elem.parentElement;
      var e_parent = e_div.parentElement;

      // delete all filter underneath the <bt> after the current on
      while (toDelete = e_div.nextSibling) {
        e_parent.removeChild(toDelete);
      }

      // if the select is not on default value, add select
      if (elem.value != 0) {
        addFilter(elem, e_parent);
      }
    }

    function fillWithChilds(r_json, id) {
      // if cat = 0, return just 0 so the server ignore this parameter
      if (id == 0) {
        r_json['category'] = 0;
        return ;
      }

      // call this function for all childs
      catTree[id].childs.forEach( function (arrayItem) {
        fillWithChilds(r_json, arrayItem);
      });

      if (!('category' in r_json)) {
        // if the key 'category' doesn't exist, create it with just the current id
        r_json['category'] = id;
      } else {
        // if the key already exist, append ',<new_id>'
        r_json['category'] += ',' + id;
      }
    }

    function requestData(elem) {
      // create object for request
      var r_json = {};
      var lastSelect = 0;

      // search for the last select with usefull data (ie, not 0)
      var allSelect = document.querySelectorAll('select');
      for (i = 0; i < allSelect.length; i++) {
        if (allSelect[i].name.match(/^category[0-9]*$/)) {
          lastSelect = allSelect[i].value;
          if (lastSelect == 0 && i > 0)
            lastSelect = allSelect[i - 1].value;
        }
      }
      fillWithChilds(r_json, lastSelect);

      // add the token or the server hung up
      r_json['_token'] = $('input[name=_token]')[0].value;

      if ( true ) // for form checking but the category, I don't know how to check..
      {
        $.ajax({
          url: "search",
          type: "POST",
          data: (r_json),
          success: function(data) {
//            console.log(data);
            $( '#results').empty();
            if (data) {
              data.forEach( function (arrayItem) {
                $( '#results').append('<a href="' + arrayItem.url + '">' + arrayItem.title + "</a><br>");
              });
            }
          }
        });
      }
    }

  </script>
@stop
