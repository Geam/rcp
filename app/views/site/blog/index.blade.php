@extends('site.layouts.default')

{{-- Style --}}
@section('styles')
<style>
.tab-content {
  padding-top: 1em;
}

#s2id_r_lang,
#s2id_r_state {
  padding-left: 0px;
  padding-right: 0px;
}

p.affair {
  background: #fff;
  padding: 4px 8px;
}

p.affair a {
  color: #333;
}

p.affair a:hover {
  color: #333;
  text-decoration: none;
}

p.affair:hover {
  background: #eee;
}

p.affair hr {
  margin-top: 0px;
  margin-bottom: 0px;
  border-color: #aaa;
}

p.affair h4 {
  margin-bottom: 2px;
  margin-top: 0px;
}
</style>

<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/select2/select2.min.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/datepicker/css/bootstrap-datepicker.min.css') }}">
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/css/dataTables.bootstrap.css') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ asset('assets/jstree/css/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/tooltip/css/tooltip.css') }}">
@stop

{{-- Title --}}
@section('title')
{{ Lang::get('site.title') }}
@stop

{{-- Content --}}
@section('content')
<div id="alerts" class="alert alert-warning hide" role="alert"></div>
<div class="jumbotron">
{{ Form::token() }}

  <ul class="nav nav-tabs" role="tablist">
    {{ Form::tabs_upper_part('adv_search', 'active', ''); }}
    {{ Form::tabs_upper_part('categories', '', Lang::get('tooltips.main_keywords')); }}
  </ul>
  <div class="tab-content">
    <div class="tab-pane active form-horizontal" id="tab_adv_search">

      <div class="form-group">
        <!-- Post Content -->
        <div class="col-md-12">
          {{ Form::label_tooltip(
            'r_content',
            Lang::get('filters.content'),
            Lang::get('tooltips.main_content'),
            [ 'class' => 'control-label' ]
            ) }}
          {{ Form::text(
            'r_content',
            (Input::has('content')) ? $input['content'] : null,
            [
              'class'   => 'form-control',
              'onkeyup' => 'checkEnter(this, event)',
              'id'      => 'r_content',
              ]
            ) }}
        </div>
        <!-- ./ post content -->
      </div>

      <div class="form-group">
        <!-- Post Title -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_title',
            Lang::get('filters.title'),
            Lang::get('tooltips.main_title'),
            [ 'class' => 'control-label' ])
            }}
          {{ Form::text(
            'r_title',
            (Input::has('title')) ? $input['title'] : null,
            [
              'class'   => 'form-control',
              'id'      => 'r_title',
              'onkeyup' => 'checkEnter(this, event)'
              ]
            ) }}
        </div>
        <!-- ./ post title -->

        <!-- Post state -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_state',
            Lang::get('filters.state'),
            Lang::get('tooltips.main_state'),
            [
              'class' => "control-label"
              ]
            ) }}
          {{ Form::selectStateOrLang(
            'r_state',
            'state',
            [
              'attr'  => [
                'class'    => 'form-control',
                'onchange' => 'requestData(true)',
                ],
              'avail' => [
                'default'  => (Input::has('state')) ? $input['state'] : '00'
                ]
              ]
            ) }}
        </div>
        <!-- ./ post state -->
      </div>

      <div class="form-group">
        <!-- Post affair_id -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_affair_id',
            Lang::get('filters.affair_id'),
            Lang::get('tooltips.main_affair_id'),
            [
              'class' => 'control-label'
              ]
            ) }}
          {{
            Form::text('r_affair_id',
            (Input::has('affair_id')) ? $input['affair_id'] : null,
            [
              'class'   => 'form-control',
              'onkeyup' => 'checkEnter(this, event)',
              'id'      => "r_affair_id"
              ]
            ) }}
        </div>
        <!-- ./ post affair_id -->

        <!-- Post date -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_date',
            Lang::get('filters.date'),
            Lang::get('tooltips.main_date'),
            [
              'class' => 'control-label'
              ]
            ) }}
          {{ Form::inputDate('r_date', True, $input) }}
        </div>
        <!-- ./ post date -->
      </div>

      <div class="form-group">
        <!-- Post post_lang -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_lang',
            Lang::get('filters.lang'),
            Lang::get('tooltips.main_lang'),
            [
              'class' => 'control-label'
              ]
            ) }}
          {{ Form::selectStateOrLang(
            'r_lang',
            'lang',
            [
              'attr' => [
                'class'    => 'form-control',
                'onchange' => 'requestData(true)',
                ],
              'avail' => [
                'default'  => (Input::has('lang')) ? $input['lang'] : null,
                'data' => array_flip(Config::get('app.available_language'))
                ]
              ]
            ) }}
        </div>
        <!-- ./ post post_lang -->

        <!-- post nature -->
        <div class="col-md-6">
          {{ Form::label_tooltip(
            'r_nature',
            Lang::get('filters.nature'),
            Lang::get('tooltips.main_nature'),
            [
              'class' => "control-label"
              ]
            ) }}
          {{ Form::nature(
            'r_nature',
            [
              'attr' => [
                'class'    => 'form-control',
                'onchange' => 'requestData(true)',
              ],
              'default'  => (Input::has('nature')) ? $input['nature'] : null
            ],
            true
            ) }}
        </div>
        <!-- ./ post nature -->
      </div>

      <div class="form-group">
        <!-- Post importance -->
        <div class="col-md-12">
          {{ Form::label_tooltip(
            'r_importance',
            Lang::get('filters.importance'),
            Lang::get('tooltips.main_importance'),
            [
              'class' => "control-label"
              ]
            ) }}
          {{ Form::select(
            'r_importance',
            [
              0 => Lang::get('filters.all'),
              1 => 1,
              2 => 2,
              3 => 3,
              4 => 'CR'
              ],
            (Input::has('importance')) ? $input['importance'] : 0,
            [
              'class'    => "form-control",
              'id'       => "r_importance",
              'onchange' => 'requestData(true)'
              ]
          ) }}
        </div>
        <!-- ./ post importance -->
      </div>

      <div class="form-group">
        <div class="col-md-12">
          {{  Form::only_my_lang(
            'r_oml',
            Lang::get('filters.oml_extend'),
            Lang::get('tooltips.main_oml'),
            (Input::has('oml')) ? $input['oml'] : "false"
            ) }}
        </div>
      </div>
    </div>

    <div class="tab-pane" id="tab_categories">
    {{ Form::jsTreeSearch('tree') }}
    </div>
  </div>
</div>

<div class="well">
  <div id="resultHeader">
  </div>
  <div id="results"></div>
  {{ Form::button(Lang::get('button.next'), [
    'class'   => 'btn btn-default',
    'id'      => 'searchNext',
    'value'   => 1,
    'onClick' => 'requestData(false)',
  ]) }}
</div>
@stop

{{-- Scripts --}}
@section('scripts')

  <script src="{{ asset('assets/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/jstree/js/jstree.min.js') }}"></script>
<script type="text/javascript">

// var for categories filters
//var gTable = {};

// select to transform in select2
$( document ).ready(function() {
  // add the reset
  $('.nav-tabs').append('<li class="navbar-right" id="reset" onclick="reset()"><a>{{ Lang::get('filters.reset') }}</a></li>');

  // initiate datepicker
  $('input[id^="r_date"]').datepicker({
    startView: 1,
    orientation: "top auto",
    language: "{{ App::getLocale() }}",
    autoclose: true,
    format: "dd-mm-yyyy",
      });


  // init the categorie tree
  $('#tree').jstree({
    core: {
    animation: 0,
    check_callback: true,
    theme: { stripes: true },
    data: {
      url: "{{ URL::to('cattree') }}",
      dataType: "json"
      },
    },
    plugins: [
      "checkbox", // allow multi selecting
      "search", // search in the tree (need additional code)
      "wholerow", // click everywhere on the row to select
    ]
  })
  .bind("changed.jstree", function (e, data) {
    requestData(true);
    })
  .bind("hover_node.jstree", function (e, data) {
    //console.log(data.node.original.long);
    })
  .bind("loaded.jstree", function (e, data) {
    // get categories from url if url is recall
    var temp = decodeURIComponent(window.location.href);
    var pos = temp.search('category=');
    if (pos != -1) {
      var cat = temp.substring(pos + 9);
      if (cat != "") {
        cats = cat.split(",");
        var ref = $(this).jstree(true);
        cats.map( function(item) {
          ref.check_node(item);
          });
        }
      }
    requestData(true);
    });

  // highlight tree node based on search
  var to = false;
  $('#tree_q').keyup(function () {
    if(to) { clearTimeout(to); }
      to = setTimeout(function () {
        var v = $('#tree_q').val();
        $('#tree').jstree(true).search(v);
      }, 250);
    });

  document.querySelector('#r_oml').setAttribute('onChange', 'requestData(true)');


  addContent('#resultHeader',
    newEl('p', { class: "affair"},
      newEl('a', { href: '#' }, [
        newEl('h4', {}, "{{ Lang::get('filters.title') }}"),
        newEl('hr', {}, ""),
        newEl('div', { class: "row"}, [
          newEl('div', { class: "col-sm-2" }, "{{ Lang::get('filters.affair_id') }}"),
          newEl('div', { class: "col-sm-2" }, "{{ Lang::get('filters.state') }}"),
          newEl('div', { class: "col-sm-2" }, "{{ Lang::get('filters.date') }}"),
          newEl('div', { class: "col-sm-2" }, "{{ Lang::get('filters.lang') }}"),
          newEl('div', { class: "col-sm-2" }, "{{ Lang::get('filters.nature') }}"),
          newEl('div', { class: "col-sm-1" }, "{{ Lang::get('filters.lang_avail') }}"),
          newEl('div', { class: "col-sm-1" }, "{{ Lang::get('filters.importance') }}"),
        ]),
      ])
    )
  );
});

function reset() {
  $('#r_title')[0].value = '';
  $('#r_importance')[0].value = '0';
  $('#r_nature')[0].value = 'all';
  $('#r_affair_id')[0].value = '';
  $('#r_date')[0].value = '';
  $('#r_date_2')[0].value = '';
  $('#r_lang')[0].value = '00';
  $('#r_state')[0].value = '00';
  $('#r_content')[0].value = '';
  $('#r_oml').prop( "checked", false );
  if (! $( '#alerts' )[0].className.match('hide')) {
    $( '#alerts' )[0].className += 'hide';
    $( '#alerts' ).empty();
  }
  requestData(true);
}

function checkEnter(elem,e) {
  var code = e.keyCode || e.which;
  if(code == 13) { //Enter keycode
    requestData(true);
    }
}

function serialiseData() {
  var data = {};
  data['r_title'] = document.querySelector('#r_title').value;
  data['r_importance'] = document.querySelector('#r_importance').value;
  data['r_nature'] = document.querySelector('#r_nature').value;
  data['r_affair_id'] = document.querySelector('#r_affair_id').value;
  data['r_date'] = document.querySelector('#r_date').value;
  data['r_date_2'] = document.querySelector('#r_date_2').value;
  data['r_lang'] = document.querySelector('#r_lang').value;
  data['r_state'] = document.querySelector('#r_state').value;
  data['r_oml'] = document.querySelector('#r_oml').checked;
  data['r_content'] = document.querySelector('#r_content').value;
  data['r_tree'] = $('#tree').jstree(true).get_selected();
  return JSON.stringify(data);
}

function generateUrl() {
  var page = document.querySelector('#searchNext');
  var url = "";
  url += "search?_token=" + encodeURIComponent($('input[name=_token]')[0].value);
  url += "&page=" + encodeURIComponent(page.value);
  url += "&page_len=10";
  url += "&title=" + encodeURIComponent($('#r_title')[0].value);
  url += "&importance=" + encodeURIComponent($('#r_importance')[0].value);
  url += "&nature=" + encodeURIComponent($('#r_nature')[0].value);
  url += "&affair_id=" + encodeURIComponent($('#r_affair_id')[0].value);
  url += "&date=" + encodeURIComponent($('#r_date')[0].value);
  url += "&date_2=" + encodeURIComponent($('#r_date_2')[0].value);
  url += "&lang=" + encodeURIComponent($('#r_lang')[0].value);
  url += "&state=" + encodeURIComponent($('#r_state')[0].value);
  url += "&oml=" + encodeURIComponent($('#r_oml').is(':checked'));
  url += "&content=" + encodeURIComponent($('#r_content')[0].value);
  url += "&category=" + encodeURIComponent($('#tree').jstree(true).get_selected());

  document.querySelector('#searchNext').value = parseInt(page.value) + 1;
  return url;
}

function addContent(el, content) {
  if (typeof el === "string")
    el = document.querySelector(el);
  if (!(el instanceof Element)) { return }
  if (typeof content === "string") {
    el.appendChild(document.createTextNode(content));
  } else if (Array.isArray(content)) {
    content.forEach( function (subContent) {
      addContent(el, subContent);
    });
  } else if (content instanceof Element) {
    el.appendChild(content);
  }
}

function newEl(tag, attrs, content) {
  var el = document.createElement(tag);
  Object.keys(attrs).forEach( function (key) {
    el.setAttribute(key, attrs[key]);
  });
  addContent(el, content);
  return el;
}


function requestData(reset) {
  if (reset) {
    $('#results').empty();
    document.querySelector('#searchNext').value = "1";
    $('#searchNext').removeClass('hide');
  } else {
    if (document.querySelector('#searchNext').value == "-1")
      return ;
  }
  var url = generateUrl();
  var args = url.substring(url.search("title="))
  window.history.pushState(serialiseData(), "test", "?" + args)
  $.getJSON(url, function() {
  })
    .done(function(json) {
      $( '#alerts' ).addClass('hide').empty();
      if (json.success) {
        var children = json.data.map(function (item) {
          return newEl('p', { class: "affair"},
            newEl('a', { href: item.url, target:"_blank" }, [
              newEl('h4', {}, item.title),
              newEl('hr', {}, ""),
              newEl('div', { class: "row"}, [
                newEl('div', { class: "col-sm-2" }, item.affair_id),
                newEl('div', { class: "col-sm-2" }, item.state),
                newEl('div', { class: "col-sm-2" }, item.date),
                newEl('div', { class: "col-sm-2" }, item.lang),
                newEl('div', { class: "col-sm-2" }, item.nature),
                newEl('div', { class: "col-sm-1" }, item.lang_avail),
                newEl('div', { class: "col-sm-1" }, item.importance),
              ]),
            ])
          );
        });
        addContent('#results', children);
        if (parseInt(json.page) == json.links) {
          $('#searchNext').addClass('hide');
          document.querySelector('#searchNext').value = "-1";
        }
      } else {
        var children = newEl('ul', {}, json.msgs.map(function (item) {
            return newEl('li', {}, item);
          })
        );
        addContent('#alerts', children);
        $('#alerts').removeClass('hide');
      }
    })
    .fail(function() {
      $( '#alerts' ).empty();
      addContent('#alerts', {}, "{{ Lang::get('messages.error') }}");
      $('#alerts').removeClass('hide');
    });
}

window.onpopstate = function(event) {
  var data = JSON.parse(event.state);
  document.querySelector('#r_title').value = data['r_title'];
  document.querySelector('#r_importance').value = data['r_importance'];
  document.querySelector('#r_nature').value = data['r_nature'];
  document.querySelector('#r_affair_id').value = data['r_affair_id'];
  document.querySelector('#r_date').value = data['r_date'];
  document.querySelector('#r_date_2').value = data['r_date_2'];
  document.querySelector('#r_lang').value = data['r_lang'];
  document.querySelector('#r_state').value = data['r_state'];
  document.querySelector('#r_content').value = data['r_content'];
  document.querySelector('#r_oml').checked = data['r_oml'];
  requestData(true);
}

window.onscroll = function(ev) {
  if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
    requestData(false);
  }
};
</script>
@stop
