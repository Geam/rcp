<?php

Form::macro('selectFilter', function($name, $categories, $default)
{
  # initialisation of select
  $ret = '<div class="form-group"><div class="col-md-12">' .
    '<select id="' .
    $name .
    '" class="col-md-12" name="' .
    $name .
    '" onChange="updateFilter(this);requestData(this)">';

  # append default entry
  $ret .= '<option value="0">' . $default . '</option>';

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
  $ret .= '</select></div></div>';
  return $ret;
});
