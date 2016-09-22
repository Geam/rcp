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

	"accepted" => " :attribute doit être accepté",
	"active_url" => "attribute n'est pas une URL valide",
	"after" => ":attribute doit être une date postérieure à :date",
	"alpha" => ":attribute ne doit contenir que des lettres",
	"alpha_dash" => ":attribute ne doit contenir que des lettres, des chiffres tirets.",
	"alpha_num" => ":attribute ne doit contenir que des lettres et des chiffres.",
	"before" => ":attribute doit être une date antérieure à :date",
  "between"          => array(
	"numeric" => ":attribute doit être compris entre :min - :max",
	"file" => ":attribute doit être compris entre :min - :max kb",
	"string" => ":attribute doit être compris entre :min - :max caractères",
  ),
	"confirmed" => "la confirmation de :attribute ne correspond pas",
	"date" => ":attribute n'est pas une date valide",
	"date_format" => ":attribute ne correspond pas au :format",
	"different" => ":attribute et :other doivent être différents",
	"digits" => ":attribute doit être en :digits chiffres",
	"digits_between" => ":attribute doit être un nombre de chiffres compris entre :min et :max ",
	"email" => "Le format de :attribute n'est pas valide",
	"exists" => ":attribute choisi n'est pas valide",
	"image" => ":attribute doit être une image",
	"in" => ":attribute choisi n'est pas valide",
	"integer" => ":attribute doit être un nombre entier",
	"ip" => ":attribute doit être une adresse IP valide",
  "max"              => array(
	"numeric" => ":attribute ne doit pas être plus grand que :max",
	"file" => ":attribute ne doit pas être plus grand que :max kb",
	"string" => ":attribute ne doit pas être plus grand que :max caractères",
  ),
	"mimes" => ":attribute doit être un fichier de type suivant: :values",
  "min"              => array(
	"numeric" => ":attribute doit être au moins de :min",
	"file" => ":attribute doit être au moins de :min kb",
	"string" => ":attribute doit être au moins de :min caractères",
  ),
	"not_in" => ":attribute n'est pas valable",
	"numeric" => ":attribute doit être un nombre",
	"regex" => "Le format de :attribute n'est pas valide",
	"required" => "Le champ :attribute est obligatoire",
	"required_if" => "Le champ :attribute est obligatoire quand :other est :value",
	"required_with" => "Le champ :attribute est obligatoire quand :values est présent",
	"required_without" => "Le champ :attribute est obligatoire quand :values n'est pas présent",
	"same" => ":attribute et :other doivent correspondre",
  "size"             => array(
	"numeric" => ":attribute doit être de :size",
	"file" => ":attribute doit être de :size kb",
	"string" => ":attribute doit être de :size caractères",
  ),
	"unique" => ":attribute a déjà été saisi",
	"url" => "Le format de :attribute n'est pas valide",

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
