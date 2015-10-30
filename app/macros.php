<?php

Form::macro('selectFilter', function($name, $categories, $default)
{
  # initialisation of select
  $ret = '<div>' .
    '<select id="' . $name .
    '" class="form-control" name="' . $name .
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
  $ret = '<select id="' . $name . '" name="' . $name . '" ';
  if (isset($options['attr'])) {
    foreach ($options['attr'] as $key => $value)
    {
      $ret .= $key . '="' . $value . '" ';
    }
  }
  $ret .= '>';
  if (! isset($options['noall']))
    $ret .= '<option value="00">' . Lang::get($display . 's.all') . '</option>';
  else
    unset($options['noall']);
  $all = Config::get('constants.' . $display . 's');
  foreach ($all as $key => $value)
  {
    if (isset($options['avail']['data']))
    {
      if (isset($options['avail']['data'][$key]))
        $all[$key] = Lang::get($display . 's.' . $key);
      else
        unset($all[$key]);
    }
    else
      $all[$key] = Lang::get($display . 's.' . $key);
  }
  asort($all);
  foreach ($all as $key => $value)
  {
    $ret .= '<option value="' . $key;
    if (isset($options['avail']['default']) && $key == $options['avail']['default'])
      $ret .= '" selected="selected';
    $ret .= '">' . $value . '</option>';
  }
  $ret .= "</select>";
  return $ret;
});

Form::macro('nature', function($name, array $options, $all_option)
{
  $ret = '<select id="' . $name . '" name="' . $name . '" ';
  if (isset($options['attr']))
  {
    foreach ($options['attr'] as $key => $value)
    {
      $ret .= $key . '="' . $value . '" ';
    }
  }
  $ret .= '>';
  if ($all_option)
    $ret .= '<option value="all">' . Lang::get('filters.all') . '</option>';
  $all = Config::get('constants.natures');
  foreach ($all as $key => $value)
  {
    $ret .= '<option value="' . $key;
    if (isset($options['default']) && $key == $options['default'])
      $ret .= '" selected="selected';
    $ret .= '">' . Lang::get('filters.natures.' . $value) . '</option>';
  }
  $ret .= "</select>";
  return $ret;
});

Form::macro('inputDate', function($name, $range, $input)
{
  $ret = '<div class="input-group">' .
    '<span class="input-group-addon">' .
    Lang::get('filters.date_format') .
    '</span>' .
    '<input type="text" class="form-control" id="' .
    $name . '" name="' .
    $name . '" onchange="requestData()"';
  $ret .= (Input::has('date')) ? ' value="' + $input['date'] + '"' : "";
  $ret .= '>';
  if ($range)
  {
    $ret .= '<span class="input-group-addon">' .
      Lang::get('filters.to') . '</span>' .
      '<input type="text" class="form-control" id="' .
      $name . '_2" name="' .
      $name . '_2" onchange="requestData()"';
    $ret .= (Input::has('date_2')) ? ' value="' + $input['date_2'] + '"' : "";
    $ret .= '>';
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

Form::macro('only_my_lang', function($name, $label, $tooltip, $value)
{
  $ret = '<div class="col-md-12 form-group form-inline">' .
    '<input type="checkbox"';
  $ret .= ($value == "true") ? "checked=checked" : "";
  $ret .= '" name="' . $name .
    '" id="' . $name .
    '" class="form-control" onchange="requestData()">' .
    ' <label class="control-label" for="' . $name .
    '">' . $label;
  if ($tooltip) {
    $ret .= '<span href="#" class="myTooltip"> (?)<span>' .
    '<img class="callout" src="assets/tooltip/img/callout.gif" />' .
    $tooltip . '</span></span>';
  }
  $ret .= '</label>' .
    '</div>';
  return $ret;
});

Form::macro('tabs_upper_part', function($name, $class, $tooltip)
{
  $ret = '<li role="presentation" class="' . $class . '">' .
    '<a href="#tab_' . $name . '" role="tab" data-toggle="tab">' . Lang::get('filters.' . $name);
  if ($tooltip) {
    $ret .= '<span href="#" class="myTooltip"> (?)<span>' .
    '<img class="callout" src="assets/tooltip/img/callout.gif" />' .
    $tooltip . '</span></span>';
  }
  $ret .= '</a></li>';
  return $ret;
});

Form::macro('label_tooltip', function($for, $text, $tooltip, $options)
{
  $ret = '<label';
  foreach ($options as $key => $value)
  {
    $ret .= ' ' . $key . '="' . $value . '"';
  }
  $ret .= ' for="' . $for . '">' . $text .
    '<span href="#" class="myTooltip"> (?)<span>' .
    '<img class="callout" src="assets/tooltip/img/callout.gif" />' .
    $tooltip . '</span></span></label>';
  return $ret;
});
