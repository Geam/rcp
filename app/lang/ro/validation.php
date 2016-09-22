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

	'accepted' => ':attribute trebuie să fie acceptat',
	'active_url' => ':attribute nu este un URL valid',
	'after' => ':attribute trebuie să fie o dată după :date',
	'alpha' => ':attribute trebuie să conțină numai litere',
	'alpha_dash' => ':attribute poate să conțină litere, cifre și linii.',
	'alpha_num' => ':attribute poate să conțină litere și numere. ',
	'before' => ':attribute trebuie să fie o dată înainte :date',
  "between"          => array(
	'numeric' => ':attribute trebuie să fie între :min - :max',
	'file' => ':attribute trebuie să fie între :min - :max kilobytes',
	'string' => ':attribute trebuie să fie între :min - :max caractere',
  ),
	'confirmed' => 'Confirmarea :attribute nu se potrivește',
	'date' => ':attribute nu este o dată validă',
	'date_format' => ':attribute nu se potrivește cu formatul :format',
	'different' => ':attribute și :other trebuie să fie diferite',
	'digits' => 'The :attribute must be :digits digits',
	'digits_between' => ':attribute trebuie să fie între :min și :max cifre',
	'email' => 'Formatul :attribute este invalid',
	'exists' => ':attribute selectat este invalid',
	'image' => ':attribute trebuie să fie o imagine',
	'in' => ':attribute selectat este invalid',
	'integer' => ':attribute trebuie să fie un număr întreg',
	'ip' => ':attribute trebuie să fie o adresă de IP validă',
  "max"              => array(
	'numeric' => ':attribute nu poate fi mai mare decât :max',
	'file' => ':attribute nu poate fi mai mare decât :max kilobytes',
	'string' => ':attribute nu poate fi mai mare decât :max caractere',
  ),
	'mimes' => ':attribute trebuie să fie un fișier de tipul: :values',
  "min"              => array(
	'numeric' => ':attribute trebuie să fie cel puțin :min',
	'file' => ':attribute trebuie să fie cel puțin :min kilobytes',
	'string' => ':attribute trebuie să fie cel puțin :min caractere',
  ),
	'not_in' => ':attribute selectat este invalid',
	'numeric' => ':attribute trebuie să fie un număr',
	'regex' => 'Formatul :attribute este invalid',
	'required' => 'Formatul :attribute este obligatoriu',
	'required_if' => 'Câmpul :attribute este obligatoriu când :other este :value',
	'required_with' => 'Câmpul :attribute este obligatoriu când există :values',
	'required_without' => 'Câmpul :attribute este obligatoriu când nu există :values',
	'same' => ':attribute și :other trebuie să se potrivească',
  "size"             => array(
	'numeric' => ':attribute trebuie să fie :size',
	'file' => ':attribute trebuie să fie :size kilobytes',
	'string' => ':attribute trebuie să fie :size characters',
  ),
	'unique' => ':attribute este deja folosit',
	'url' => 'Formatul :attribute este invalid',

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
