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

	'accepted' => ':attribute deve essere accettato',
	'active_url' => ':attribute non è un URL valido',
	'after' => ':attribute deve essere una data successiva a :date',
	'alpha' => ':attribute può contenere solo lettere',
	'alpha_dash' => ':attribute può contenere solo lettere, numeri e trattini bassi ("_")',
	'alpha_num' => ':attribute può contenere solo lettere e numeri',
	'before' => ':attribute deve essere una data precedente a :date',
  "between"          => array(
	'numeric' => 'Il :attribute deve essere compreso tra :min e :max',
	'file' => 'La dimensione del :attribute deve essere compresa tra :min e :max kb',
	'string' => 'La :attribute deve contenere minimo :min e massimo :max caratteri',
  ),
	'confirmed' => 'The :attribute confirmation does not match',
	'date' => ':attribute non è una data valida',
	'date_format' => ':attribute non corrisponde al formato :format',
	'different' => ':attribute e :other devono essere diversi',
	'digits' => ':attribute deve essere di :digits cifre',
	'digits_between' => ':attribute deve avere un numero di cifre compreso fra:min e :max',
	'email' => 'Il formato del :attribute non è valido',
	'exists' => ':attribute selezionato non è valido',
	'image' => ':attribute deve essere un\'immagine',
	'in' => 'The selected :attribute is invalid',
	'integer' => ':attribute deve essere un numero intero',
	'ip' => ':attribute deve essere un indirizzo IP valido',
  "max"              => array(
	'numeric' => 'Il :attribute non può essere maggiore di :max',
	'file' => 'Il :attribute non può essere più grande di :max kb',
	'string' => 'La :attribute non può contenere più di :max caratteri',
  ),
	'mimes' => ':attribute deve essere un file dei seguenti tipi: :values',
  "min"              => array(
	'numeric' => 'Il :attribute non può essere minore di :min',
	'file' => 'La dimensione del :attribute deve essere di almeno :min kb',
	'string' => 'La :attribute deve contenere almeno :min caratteri',
  ),
	'not_in' => ':attribute selezionato non è valido',
	'numeric' => ':attribute deve essere un numero',
	'regex' => 'Il formato della :attribute non è valido',
	'required' => 'Il campo :attribute è obbligatorio',
	'required_if' => 'Il campo :attribute è obbligatorio se :other è :value',
	'required_with' => 'Il campo :attribute è obbligatorio se sono presenti :values',
	'required_without' => 'Il campo :attribute è obbligatorio se non sono presenti :values',
	'same' => ':attribute e :other devono corrispondere',
  "size"             => array(
	'numeric' => 'Il :attribute deve essere :size',
	'file' => 'Il :attribute deve essere di :size kb',
	'string' => 'La :attribute deve essere di :size caratteri',
  ),
	'unique' => 'Il valore di :attribute è già stato indicato',
	'url' => 'Il formato di :attribute non è valido',

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
