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

	"accepted" => ":attribute muss akzeptiert werden",
	"active_url" => ":attribute ist kein gültige URL",
	"after" => ":attribute muss ein Datum nach :date sein",
	"alpha" => ":attribute soll nur Buchstaben enthalten",
	"alpha_dash" => ":attribute kann nur Buchstaben, Ziffern und Striche enthalten.",
	"alpha_num" => ":attribute kann nur Buchstaben und Ziffern enthalten.",
	"before" => ":attribute muss ein Datum vor :date sein",
  "between"          => array(
	"numeric" => ":attribute muss zwischen :min - :max  sein",
	"file" => ":attribute muss zwischen :min - :max kilobytes sein",
	"string" => ":attribute muss zwischen :min - :max Zeichen sein",
  ),
	"confirmed" => ":attribute Bestätigung stimmt nicht überein",
	"date" => ":attribute is kein gültiges Datum",
	"date_format" => ":attribute stimmt mit dem :format nicht überein",
	"different" => ":attribute und :or müssen unterschiedlich sein",
	"digits" => ":attribute muss :digits digits sein",
	"digits_between" => ":attribute muss zwischen :min and :max digits sein",
	"email" => ":attribute Format ist ungültig",
	"exists" => "ausgewählte :attribute ist ungültig",
	"image" => ":attribute muss ein Bild sein",
	"in" => "ausgewählte :attribute ist ungültig",
	"integer" => ":attribute muss ganzzahlig sein",
	"ip" => ":attribute muss ein gültige IP Adresse sein",
  "max"              => array(
	"numeric" => ":attribute darf nicht größer sein als :max",
	"file" => ":attribute darf nicht größer sein als :max kilobytes",
	"string" => ":attribute darf nicht größer sein als :max Zeichen",
  ),
	"mimes" => ":attribute muss folgende Sorte von File: :values  sein",
  "min"              => array(
	"numeric" => ":attribute muss mindestens  :min sein",
	"file" => ":attribute muss mindestens :min kilobytes sein",
	"string" => ":attribute muss mindestens :min Zeichen sein",
  ),
	"not_in" => "ausgewählte :attribute ist ungültig",
	"numeric" => ":attribute muss ein Ziffer sein",
	"regex" => ":attribute Format ist ungültig",
	"required" => ":attribute Feld ist verlangt",
	"required_if" => ":attribute Feld ist verlangt wenn :or ist :value",
	"required_with" => ":attribute Feld ist verlangt wenn :values ist vorhanden",
	"required_without" => ":attribute Feld ist verlangt wenn :values ist nicht vorhanden",
	"same" => ":attribute und :or müssen übereinstimmen",
  "size"             => array(
	"numeric" => ":attribute muss :size sein",
	"file" => ":attribute muss :size kilobytes sein",
	"string" => ":attribute muss :size Zeichen sein",
  ),
	"unique" => ":attribute ist schon vergeben",
	"url" => ":attribute Format ist ungültig",

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
