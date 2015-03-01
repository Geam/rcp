@extends('site.layouts.default')

{{-- Style --}}
@section('styles')
.tab-content {
  padding-top: 1em;
}

#s2id_r_lang,
#s2id_r_state {
  padding-left: 0px;
  padding-right: 0px;
}

@stop

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
{{ Form::token() }}
{{ Tabbable::withContents([
  [
    'title' => Lang::get('filters.category'),
    'content' => Form::selectFilter('category1', Category::getOptionsFromParent($tree, 0), 'Select a category')
  ],
  [
    'title' => Lang::get('filters.affair_id'),
    'content' => Form::text('affair_id', null, ['class' => 'col-md-12 form-control', 'onkeyup' => 'checkEnter(this, event)', 'id' => 'affair_id'])
  ],
  [
    'title' => Lang::get('filters.nature'),
    'content' => "<p>nature</p>"
  ],
  [
    'title' => Lang::get('filters.importance'),
    'content' => Form::number('importance', null, ['class' => 'col-md-12 form-control', 'min' => 0, 'max' => 3, 'id' => 'r_importance', 'onChange' => 'requestData(this)'])
  ],
  [
    'title' => Lang::get('filters.lang'),
    'content' => Form::selectStateOrLang('r_lang', 'lang', ['class' => 'col-md-12', 'onChange' => 'requestData(this)'])
  ],
  [
    'title' => Lang::get('filters.state'),
    'content' => Form::selectStateOrLang('r_state', 'state', ['class' => 'col-md-12', 'onChange' => 'requestData(this)'])
  ],
  [
    'title' => Lang::get('filters.date'),
    'content' => Form::inputDate('r_date', True)
  ],
]) }}
<div id="results">
</div>
@stop

{{-- Scripts --}}
@section('scripts')

  <!-- Select2 script -->
  <script src="{{ asset('select2/select2.min.js') }}"></script>
  <script src="{{ asset('datepicker/js/bootstrap-datepicker.min.js') }}"></script>

  <script type="text/javascript">

    // var for categories filters
    var catTree = {{ json_encode($tree) }};

    // select to transform in select2
    $( document ).ready(function() {
      $('#r_lang').select2();
      $('#r_state').select2();
      $('.nav-tabs').append('<li class="navbar-right" id="reset" onclick="reset()"><a>{{ Lang::get('filters.reset') }}</a></li>');
      $('input[id^="r_date"]').datepicker({
        startView: 1,
        orientation: "top auto",
        language: "{{ App::getLocale() }}",
        autoclose: true
      });
    });

    function datepickerToggle(e) {
      var r_to = e.parentNode.childNodes[2];
      var r_d2 = e.parentNode.childNodes[3];

      console.log(e.style['background-color']);
      if (! e.style['background-color']) {
        e.style['background-color'] = '#3e3';
        r_to.className = r_to.className.replace(/hidden/, '');
        r_d2.className = r_d2.className.replace(/hidden/, '');
        r_d2.setAttribute('onchange', 'requestData(this)');
        $('#r_date')[0].removeAttribute('onchange');
      } else {
        e.style = "";
        r_to.className += " hidden";
        r_d2.className += " hidden";
        r_d2.removeAttribute('onchange');
        $('#r_date')[0].setAttribute('onchange', 'requestData(this)');
      }
    }

    function reset() {
      $('#category1')[0].value="0";
      updateFilter($('#category1')[0]);
      $('#affair_id')[0].value = "";
      $('#r_importance')[0].value = "";
      $('#r_lang').select2('val', '00');
      $('#r_state').select2('val', '00');
      $('#r_date')[0].value = '';
      $('#r_date_2')[0].value = '';
      $('#results').empty();
    }

    function addFilter(elem, e_parent) {
      var childs = catTree[elem.value].childs;
      var arrayLength = childs.length;

      if (arrayLength > 0) {
        // create new div
        var newDiv = document.createElement('div');

        // create new select element
        var newSelect = document.createElement('select');
        var extract = elem.name.match(/^([a-z-A-Z]*)([0-9]*)$/);
        newSelect.name = extract[1] + (extract[2] * 1 + 1);
        newSelect.id = newSelect.name;
        newSelect.setAttribute('onchange', 'updateFilter(this);requestData(this)');
        newSelect.className = "col-md-12 form-control";
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

    function checkEnter(elem,e) {
      var code = e.keyCode || e.which;
       if(code == 13) { //Enter keycode
         requestData(elem);
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

      r_json['affair_id'] = $('#affair_id')[0].value;
      r_json['importance'] = $('#r_importance')[0].value;
      r_json['lang'] = $('#r_lang')[0].value;
      r_json['state'] = $('#r_state')[0].value;
      r_json['date'] = $('#r_date')[0].value;
      if (! $('#r_date_2')[0].className.match('hidden'))
        r_json['date_2'] = $('#r_date_2')[0].value;

      // add the token or the server hung up
      r_json['_token'] = $('input[name=_token]')[0].value;


      if ( r_json['importance'] >= 0 && r_json['importance'] <= 3 )
      {
        $.ajax({
          url: "search",
          type: "POST",
          data: (r_json),
          success: function(data) {
            $( '#results' ).empty();
            console.log(data);
            if (!('empty' in data)) {
              data.forEach( function (arrayItem) {
                $( '#results' ).append('<a href="' + arrayItem.url + '">' + arrayItem.title + "</a><br>");
              });
            }
          }
        });
      } else {
        $( '#results').empty();
      }
    }

  </script>
@stop
