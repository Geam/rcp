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

	'accepted' => 'трябва да бъде приет',
	'active_url' => 'не е валиден URL',
	'after' => 'трябва да бъде дата след :',
	'alpha' => 'може да съдържа само букви',
	'alpha_dash' => 'може да съдържа само букви, числа и тирета',
	'alpha_num' => 'може да съдържа само букви и числа',
	'before' => 'трябва да е с дата преди :',
  "between"          => array(
	'numeric' => 'трябва да е между :min - :max',
	'file' => 'трябва да е между килобайта',
	'string' => 'трябва да е между знака',
  ),
	'confirmed' => 'потвърждението не съвпада',
	'date' => 'не е валидна дата',
	'date_format' => 'не съвпада с формата :format.',
	'different' => 'other не трябва да съвпадат.',
	'digits' => 'трябва да бъде :цифри',
	'digits_between' => 'трябва да е между :min и цифри',
	'email' => 'форматът не е валиден',
	'exists' => 'Избранияте невалиден',
	'image' => 'трябва да е изображение',
	'in' => 'Избраният е невалиден',
	'integer' => 'трябва да бъде цяло число',
	'ip' => 'трябва да е валиден IP адрес',
  "max"              => array(
	'numeric' => 'не може да е повече от :max',
	'file' => 'не може да е повече от килобайта',
	'string' => 'не може да е повече от знака',
  ),
	'mimes' => 'трябва да е файл или вид ',
  "min"              => array(
	'numeric' => 'трябва да е поне ',
	'file' => 'трябва да е поне килобайта',
	'string' => 'трябва да е поне знака',
  ),
	'not_in' => 'Избраният е невалиден',
	'numeric' => 'трябва да е число',
	'regex' => 'формат е невалиден',
	'required' => 'поле се изисква',
	'required_if' => 'поле се изисква, когато е ',
	'required_with' => 'поле се изисква, когато е представен',
	'required_without' => 'поле се изисква когато не е представен',
	'same' => 'и трябва да съвпадат',
  "size"             => array(
	'size.numeric' => 'трябва да е ',
	'size.file' => 'трябва да е :килобайта',
	'size.string' => 'трябва да е символа',
  ),
	'unique' => 'е вече зает',
	'url' => 'формат е невалиден',

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
