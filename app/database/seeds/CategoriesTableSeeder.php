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
			array(
				'parent_id'		=> 1,
				'name'				=> 'required characteristics of the procedure before the body',
				'short_name'	=> 'required characteristics of the procedure before the body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'speediness (rapid collection of evidence in case of investigation, suspensive character, urgent procedure, speedy decision on the merits required…)',
				'short_name'	=> 'speediness',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'requirement of regular or frequent reviews',
				'short_name'	=> 'requirement of regular or frequent reviews',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'fact finding',
				'short_name'	=> 'fact finding',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 22,
				'name'				=> 'acts to be performed in the investigation',
				'short_name'	=> 'acts to be performed in the investigation',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 22,
				'name'				=> 'burden of proof and forms of evidence collection (distribution of the burden of proof; indication of formal requirements of fact finding: expertises, independent reports, detailed and accurate description/witness statements by fellow inmates, necessity of a medical report …)',
				'short_name'	=> 'burden of proof and forms of evidence collection',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 22,
				'name'				=> 'obtaining the attendance of witnesses',
				'short_name'	=> 'obtaining the attendance of witnesses',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 22,
				'name'				=> 'conditions of assessing character and conduct',
				'short_name'	=> 'conditions of assessing character and conduct',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'facilities for the preparation of one’s defence /defence of one’s interests (adequate time, possibility to communicate with one’s lawyer…)',
				'short_name'	=> 'facilities for the preparation of one’s defence',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'choice of legal assistance',
				'short_name'	=> 'choice of legal assistance',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'access to an interpreter',
				'short_name'	=> 'access to an interpreter',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'adversarial proceeding before the competent body',
				'short_name'	=> 'adversarial proceeding before the competent body',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 31,
				'name'				=> 'necessary possibility to discuss the elements of the case file (access to case file, examination of witnesses, possibility to discuss the other party’s allegations)',
				'short_name'	=> 'necessary possibility to discuss the elements of the case file',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 31,
				'name'				=> 'participation in the hearing (personal attendance)',
				'short_name'	=> 'participation in the hearing (personal attendance)',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'required reasoning of decisions',
				'short_name'	=> 'required reasoning of decisions',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'public scrutiny',
				'short_name'	=> 'public scrutiny',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 35,
				'name'				=> 'public hearing',
				'short_name'	=> 'public hearing',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 35,
				'name'				=> 'forms of public scrutiny of the investigation',
				'short_name'	=> 'forms of public scrutiny of the investigation',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 18,
				'name'				=> 'protection against retaliation',
				'short_name'	=> 'protection against retaliation',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 1,
				'name'				=> 'specific regime of conventional protection',
				'short_name'	=> 'specific regime of conventional protection',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 39,
				'name'				=> 'applicability of article 5 of the ECHR',
				'short_name'	=> 'applicability of article 5 of the ECHR',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 39,
				'name'				=> 'applicability of article 6 of the ECHR',
				'short_name'	=> 'applicability of article 6 of the ECHR',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 41,
				'name'				=> 'applicable criminal limb',
				'short_name'	=> 'applicable criminal limb',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 41,
				'name'				=> 'applicable civil limb',
				'short_name'	=> 'applicable civil limb',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 41,
				'name'				=> 'article 6 declared inapplicable',
				'short_name'	=> 'article 6 declared inapplicable',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 0,
				'name'				=> 'stage of hearing by the ECHR',
				'short_name'	=> 'stage of hearing by the ECHR',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'burden of proving the effectiveness of the remedy',
				'short_name'	=> 'burden of proving the effectiveness of the remedy',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'effective remedies',
				'short_name'	=> 'effective remedies',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'unavailable remedies',
				'short_name'	=> 'unavailable remedies',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'remedies ineffective in practice',
				'short_name'	=> 'remedies ineffective in practice',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'newly introduced remedies',
				'short_name'	=> 'newly introduced remedies',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'structural problem',
				'short_name'	=> 'structural problem',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
			array(
				'parent_id'		=> 45,
				'name'				=> 'plurality of remedies',
				'short_name'	=> 'plurality of remedies',
				'created_at'	=> new DateTime,
				'updated_at'	=> new DateTime,
			),
		));
	}
}
