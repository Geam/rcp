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

	"accepted"         => "L' :attribute doit être accepté",
	"active_url"       => "L' :attribute n'est pas un URL valide",
	"after"            => "L' :attribute doit être une date après :date.",
	"alpha"            => "L' :attribute ne devrait contenir que des lettres.",
	"alpha_dash"       => "L' :attribute ne devrait contenir que des lettres, chiffres, et tirets.",
	"alpha_num"        => "L' :attribute ne devrait contenir que des lettres et chiffres.",
	"before"           => "L' :attribute doit être une date avant :date.",
	"between"          => array(
		"numeric" => "L' :attribute doit faire entre :min - :max.",
		"file"    => "L' :attribute doit faire entre :min - :max kilooctets.",
		"string"  => "L' :attribute doit faire entre :min - :max charactères.",
	),
	"confirmed"        => "L' :attribute confirmation ne correspondent pas.",
	"date"             => "L' :attribute n'est pas une date valide.",
	"date_format"      => "L' :attribute ne correspond pas au format :format.",
	"different"        => "L' :attribute et :other doivent être différents.",
	"digits"           => "L' :attribute doivent faire :digits chiffres.",
	"digits_between"   => "L' :attribute doivent faire entre :min et :max chiffres.",
	"email"            => "L' :attribute format n'est pas valide.",
	"exists"           => "L' :attribute sélectionné est invalide.",
	"image"            => "L' :attribute doit être une image.",
	"in"               => "L' :attribute sélectionné est invalide.",
	"integer"          => "L' :attribute doit être un entier.",
	"ip"               => "L' :attribute doit être une adresse ip valide.",
	"max"              => array(
		"numeric" => "L' :attribute doit être plus grand que :max.",
		"file"    => "L' :attribute doit être plus grand que :max kilooctets.",
		"string"  => "L' :attribute doit être plus grand que :max charactères.",
	),
  "mimes"            => "L' :attribute doit être un fichier de type: :values.",
	"min"              => array(
		"numeric" => "L' :attribute doit faire au moins :min.",
		"file"    => "L' :attribute doit faire au moins :min kilooctets.",
		"string"  => "L' :attribute doit faire au moins :min charactères.",
	),
	"not_in"           => "L' :attribute selectionné est invalide.",
	"numeric"          => "L' :attribute doit être un nombre.",
	"regex"            => "L' :attribute format est invalide.",
	"required"         => "L' :attribute champ est requis.",
	"required_if"      => "L' :attribute champ est requis quand :other est :value.",
	"required_with"    => "L' :attribute champ est requis quand :values est préseent.",
	"required_without" => "L' :attribute champ est requis quand :values n'est pas prèsent.",
	"same"             => "L' :attribute et :other doivent correspondre.",
	"size"             => array(
		"numeric" => "L' :attribute doit faire :size.",
		"file"    => "L' :attribute doit faire :size kilooctest.",
		"string"  => "L' :attribute doit faire :size charactères.",
	),
	"unique"           => "L' :attribute a déjà été utilisé.",
	"url"              => "L' :attribute format n'est pas valide.",

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
