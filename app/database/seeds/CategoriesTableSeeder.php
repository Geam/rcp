<?php

class CategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('categories')->delete();

		$user_id = User::first()->id;

		DB::table('categories')->insert( array(
			array(
				'parent_id'		=> 0,
				'name'				=> 'Effective remedy /effective investigation/review',
				'short_name'	=> 'Effective remedy /effective investigation/review',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 1,
				'name'				=> 'Initiation of the review (ex officio/complaint to lodge in compliance with internal procedural rules)',
				'short_name'	=> 'Initiation of the review',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 1,
				'name'				=> 'Nature of the complaints body',
				'short_name'	=> 'Nature of the complaints body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 3,
				'name'				=> 'Judicial body required',
				'short_name'	=> 'Judicial body required',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 3,
				'name'				=> 'Non-judicial or combined remedies allowed',
				'short_name'	=> 'Non-judicial or combined remedies allowed',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 1,
				'name'				=> 'Required characteristics of the complaints body',
				'short_name'	=> 'Required characteristics of the complaints body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 6,
				'name'				=> 'Independence/impartiality (investigation service/complaints body)',
				'short_name'	=> 'Independence/impartiality (investigation service/complaints body)',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 6,
				'name'				=> 'Required decision-making power of the competent body',
				'short_name'	=> 'Required decision-making power of the competent body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 8,
				'name'				=> 'Requirement of binding force',
				'short_name'	=> 'Requirement of binding force',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 8,
				'name'				=> 'In the context of remedies meant to obtain the cessation of the alleged violation (‘preventive’ remedy) : (injunction power, power to suspend / reverse decisions, to order the release of concerned persons, to order the review of a situation, to tackle the underlying structural problem…)',
				'short_name'	=> 'Remedies meant to obtain the cessation of the alleged violation',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 8,
				'name'				=> 'In the context of ‘compensatory’ remedies',
				'short_name'	=> 'In the context of ‘compensatory’ remedies',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 11,
				'name'				=> 'Adequate compensation required',
				'short_name'	=> 'Adequate compensation required',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 11,
				'name'				=> 'Other authorised forms of compensation (mitigation of sentence…)',
				'short_name'	=> 'Other authorised forms of compensation (mitigation of sentence…)',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 6,
				'name'				=> 'Accessibility of the body',
				'short_name'	=> 'Accessibility of the body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 14,
				'name'				=> 'Procedural obstacles (complexity of the procedure…)',
				'short_name'	=> 'Procedural obstacles (complexity of the procedure…)',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 14,
				'name'				=> 'Free legal aid (required/non-required)',
				'short_name'	=> 'Free legal aid (required/non-required)',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 14,
				'name'				=> 'Access to applicable rules /quality of the procedural law',
				'short_name'	=> 'Access to applicable rules /quality of the procedural law',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
		));
	}

}
