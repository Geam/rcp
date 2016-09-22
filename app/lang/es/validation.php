<?php

return array(
  /*
  |--------------------------------------------------------------------------
  | Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | The following language lines contain the default error messages used by
  | the validator class. Some of these rules have multiple versions such
  | such as the size rules. Feel free to tweak each of these messages.
  |
   */

	'accepted' => ':attribute debe ser aceptado',
	'active_url' => ':attribute no es una URL válida',
	'after' => ':attribute debe ser una fecha posterior a :date',
	'alpha' => ':attribute puede contener sólo letras',
	'alpha_dash' => ':attribute puede contener sólo letras, números y guiones',
	'alpha_num' => ':attribute puede contener sólo letras y números',
	'before' => ':attribute debe ser una fecha anterior a :date',
  "between"          => array(
    "numeric" => "The :attribute must be between :min - :max.",
    "file"    => "The :attribute must be between :min - :max kilobytes.",
    "string"  => "The :attribute must be between :min - :max characters.",
	'numeric' => ':attribute debe estar entre :min - :max',
	'file' => ':attribute debe estar entre :min - :max kb',
	'string' => ':attribute debe tener entre :min - :max caracteres',
  ),
	'confirmed' => 'la confirmación del :attribute no coincide',
	'date' => ':attribute no es una fecha válida',
	'date_format' => ':attribute no coincide con el formato :format',
	'different' => ':attribute y :otro deben ser diferentes',
	'digits' => ':attribute debe ser :digits dígitos',
	'digits_between' => ':attribute debe comprender un :min y un :max de dígitos',
	'email' => 'El format del :attribute no es válido',
	'exists' => ':attribute seleccionado no es válido',
	'image' => ':attribute debe ser una imagen',
	'in' => ':attribute seleccionado no es válido',
	'integer' => ':attribute debe ser un número entero',
	'ip' => ':attribute debe ser una dirección de IP válida',
  "max"              => array(
	'numeric' => ':attribute no puede ser mayor de :max',
	'file' => ':attribute no puede ser mayor de :max kb',
	'string' => ':attribute no puede contener más de :max caracteres',
  ),
	'mimes' => ':attribute debe ser un archivo de tipo :values',
  "min"              => array(
	'numeric' => ':attribute debe ser al menos :min',
	'file' => ':attribute debe ser al menos :min kb',
	'string' => ':attribute debe contener al menos :min caracteres',
  ),
	'not_in' => ':attribute seleccionado no es válido',
	'numeric' => ':attribute debe ser un número',
	'regex' => 'El formato :attribute no es válido',
	'required' => 'El campo :attribute es necesario',
	'required_if' => 'El campo :attribute es necesario cuando :other es :value',
	'required_with' => 'El campo :attribute es necesario cuando :values están presentes',
	'required_without' => 'El campo :attribute es necesario cuando no están presentes :values',
	'same' => ':attribute y :other deben coincidir',
  "size"             => array(
	'numeric' => ':attribute debe ser :size',
	'file' => 'attribute debe ser :size kb',
	'string' => ':attribute debe ser :size caracteres',
  ),
	'unique' => ':attribute ya ha sido asignado',
	'url' => 'El formato del :attribute no es válido',

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Language Lines
  |--------------------------------------------------------------------------
  |
  | Here you may specify custom validation messages for attributes using the
  | convention "attribute.rule" to name the lines. This makes it quick to
  | specify a specific custom language line for a given attribute rule.
  |
   */

  'custom' => array(),

  /*
  |--------------------------------------------------------------------------
  | Custom Validation Attributes
  |--------------------------------------------------------------------------
  |
  | The following language lines are used to swap attribute place-holders
  | with something more reader friendly such as E-Mail Address instead
  | of "email". This simply helps us make messages a little cleaner.
  |
   */

  'attributes' => array(),

);
