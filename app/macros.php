<?php

Form::macro('selectFilter', function($name, $categories, $default)
{
  # initialisation of select
  $ret = '<div>' .
    '<select id="' .  $name .
    '" class="form-control" name="' .  $name .
    '" onChange="updateFilter(this);requestData()">';

  # append default entry
  $ret .= '<option value="0" selected="selected">' . $default . '</option>';

  # append all availaible options
  foreach ($categories as $cat)
  {
    $ret .= '<option value="' .
      $cat['id'] .
      '" title="' .
      $cat['long_name'] .
      '">' .
      $cat['short_name'] .
      '</option>';
  }

  # close select
  $ret .= '</select></div>';
  return $ret;
});

Form::macro('selectStateOrLang', function($name, $display, array $options)
{
  if ($display != 'lang' && $display != 'state')
    return Null;
  $ret = '<select id="' .
    $name .
    '" ' .
    'name="' .
    $name .
    '" ';
  foreach ($options as $key => $value)
  {
    $ret .= $key . '="' . $value . '" ';
  }
  $ret .= '><option value="00">' . Lang::get($display . 's.all') . '</option>';
  $all = Config::get('constants.' . $display . 's');
  foreach ($all as $key => $value)
  {
    $all[$key] = Lang::get($display . 's.' . $key);
  }
  asort($all);
  foreach ($all as $key => $value)
  {
    $ret .= '<option value="' . $key . '">' . $value . '</option>';
  }
  $ret .= "</select>";
  return $ret;
});

Form::macro('inputDate', function($name, $range)
{
  $ret = '<div class="input-group">' .
    '<span class="input-group-addon">' .
    Lang::get('filters.date_format') .
    '</span>' .
    '<input type="text" class="form-control" id="' .
    $name . '" name="' .
    $name . '"';
  if (!$range)
  {
    $ret = 'onchange="requestData()">';
  }
  else
  {
      $ret .= '><span class="input-group-addon">' .
      Lang::get('filters.to') . '</span>' .
      '<input type="text" class="form-control" id="' .
      $name . '_2" name="' .
      $name . '_2" onchange="requestData()">';
  }
  $ret .= '</div>';
  return $ret;
});

Form::macro('jsTreeSearch', function($name)
{
  $ret = '<div class="col-md-2 col-sm-4 col-xs-4 pull-right">' .
    '<input type="text" value="" class="form-control" id="' .
    $name .
    '_q" placeholder="' .
    Lang::get('filters.search') .
    '" /></div>' .
    '<div id="' .
    $name .
    '"></div>';
  return $ret;
});
