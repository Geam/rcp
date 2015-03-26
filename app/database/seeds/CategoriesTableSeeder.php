<?php

class CategoriesTableSeeder extends Seeder {

  public function run()
  {
    DB::table('categories')->delete();
    DB::table('cats_texts')->delete();

    DB::table('categories')->insert( array(
      array(
        'parent_id'   => 0,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 1,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 1,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 3,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 3,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 1,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 6,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 6,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 8,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 8,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 8,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 11,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 11,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 6,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 14,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 14,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 14,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 1,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 21,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 21,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 21,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 21,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 29,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 29,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 33,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 33,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 18,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 1,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 37,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 37,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 39,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 39,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 39,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 0,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
      array(
        'parent_id'   => 43,
        'created_at'  => new DateTime,
        'updated_at'  => new DateTime,
      ),
    ));

    DB::table('cats_texts')->insert( array(
      array(
        'cat_id'     => 1,
        'lang'        => 'en',
        'long_name'   => 'Effective remedy /effective investigation/review',
        'short_name'  => 'Effective remedy /effective investigation/review',
      ),
      array(
        'cat_id'     => 2,
        'lang'        => 'en',
        'long_name'   => 'Initiation of the review (ex officio/complaint to lodge in compliance with internal procedural rules)',
        'short_name'  => 'Initiation of the review',
      ),
      array(
        'cat_id'     => 3,
        'lang'        => 'en',
        'long_name'   => 'Nature of the complaints body',
        'short_name'  => 'Nature of the complaints body',
      ),
      array(
        'cat_id'     => 4,
        'lang'        => 'en',
        'long_name'   => 'Judicial body required',
        'short_name'  => 'Judicial body required',
      ),
      array(
        'cat_id'     => 5,
        'lang'        => 'en',
        'long_name'   => 'Non-judicial or combined remedies allowed',
        'short_name'  => 'Non-judicial or combined remedies allowed',
      ),
      array(
        'cat_id'     => 6,
        'lang'        => 'en',
        'long_name'   => 'Required characteristics of the complaints body',
        'short_name'  => 'Required characteristics of the complaints body',
      ),
      array(
        'cat_id'     => 7,
        'lang'        => 'en',
        'long_name'   => 'Independence/impartiality (investigation service/complaints body)',
        'short_name'  => 'Independence/impartiality (investigation service/complaints body)',
      ),
      array(
        'cat_id'     => 8,
        'lang'        => 'en',
        'long_name'   => 'Required decision-making power of the competent body',
        'short_name'  => 'Required decision-making power of the competent body',
      ),
      array(
        'cat_id'     => 9,
        'lang'        => 'en',
        'long_name'   => 'Requirement of binding force',
        'short_name'  => 'Requirement of binding force',
      ),
      array(
        'cat_id'     => 10,
        'lang'        => 'en',
        'long_name'   => 'In the context of remedies meant to obtain the cessation of the alleged violation (‘preventive’ remedy) : (injunction power, power to suspend / reverse decisions, to order the release of concerned persons, to order the review of a situation, to tackle the underlying structural problem…)',
        'short_name'  => 'Remedies meant to obtain the cessation of the alleged violation',
      ),
      array(
        'cat_id'     => 11,
        'lang'        => 'en',
        'long_name'   => 'In the context of ‘compensatory’ remedies',
        'short_name'  => 'In the context of ‘compensatory’ remedies',
      ),
      array(
        'cat_id'     => 12,
        'lang'        => 'en',
        'long_name'   => 'Adequate compensation required',
        'short_name'  => 'Adequate compensation required',
      ),
      array(
        'cat_id'     => 13,
        'lang'        => 'en',
        'long_name'   => 'Other authorised forms of compensation (mitigation of sentence…)',
        'short_name'  => 'Other authorised forms of compensation (mitigation of sentence…)',
      ),
      array(
        'cat_id'     => 14,
        'lang'        => 'en',
        'long_name'   => 'Accessibility of the body',
        'short_name'  => 'Accessibility of the body',
      ),
      array(
        'cat_id'     => 15,
        'lang'        => 'en',
        'long_name'   => 'Procedural obstacles (complexity of the procedure…)',
        'short_name'  => 'Procedural obstacles (complexity of the procedure…)',
      ),
      array(
        'cat_id'     => 16,
        'lang'        => 'en',
        'long_name'   => 'Free legal aid (required/non-required)',
        'short_name'  => 'Free legal aid (required/non-required)',
      ),
      array(
        'cat_id'     => 17,
        'lang'        => 'en',
        'long_name'   => 'Access to applicable rules /quality of the procedural law',
        'short_name'  => 'Access to applicable rules /quality of the procedural law',
      ),
      array(
        'cat_id'     => 18,
        'lang'        => 'en',
        'long_name'   => 'Required characteristics of the procedure before the body',
        'short_name'  => 'Required characteristics of the procedure before the body',
      ),
      array(
        'cat_id'     => 19,
        'lang'        => 'en',
        'long_name'   => 'Speediness (rapid collection of evidence in case of investigation, suspensive character, urgent procedure, speedy decision on the merits required…)',
        'short_name'  => 'Speediness',
      ),
      array(
        'cat_id'     => 20,
        'lang'        => 'en',
        'long_name'   => 'Requirement of regular or frequent reviews',
        'short_name'  => 'Requirement of regular or frequent reviews',
      ),
      array(
        'cat_id'     => 21,
        'lang'        => 'en',
        'long_name'   => 'Fact finding',
        'short_name'  => 'Fact finding',
      ),
      array(
        'cat_id'     => 22,
        'lang'        => 'en',
        'long_name'   => 'Acts to be performed in the investigation',
        'short_name'  => 'Acts to be performed in the investigation',
      ),
      array(
        'cat_id'     => 23,
        'lang'        => 'en',
        'long_name'   => 'Burden of proof and forms of evidence collection (distribution of the burden of proof; indication of formal requirements of fact finding: expertises, independent reports, detailed and accurate description/witness statements by fellow inmates, necessity of a medical report …)',
        'short_name'  => 'Burden of proof and forms of evidence collection',
      ),
      array(
        'cat_id'     => 24,
        'lang'        => 'en',
        'long_name'   => 'Obtaining the attendance of witnesses',
        'short_name'  => 'Obtaining the attendance of witnesses',
      ),
      array(
        'cat_id'     => 25,
        'lang'        => 'en',
        'long_name'   => 'Conditions of assessing character and conduct',
        'short_name'  => 'Conditions of assessing character and conduct',
      ),
      array(
        'cat_id'     => 26,
        'lang'        => 'en',
        'long_name'   => 'Facilities for the preparation of one’s defence /defence of one’s interests (adequate time, possibility to communicate with one’s lawyer…)',
        'short_name'  => 'Facilities for the preparation of one’s defence',
      ),
      array(
        'cat_id'     => 27,
        'lang'        => 'en',
        'long_name'   => 'Choice of legal assistance',
        'short_name'  => 'Choice of legal assistance',
      ),
      array(
        'cat_id'     => 28,
        'lang'        => 'en',
        'long_name'   => 'Access to an interpreter',
        'short_name'  => 'Access to an interpreter',
      ),
      array(
        'cat_id'     => 29,
        'lang'        => 'en',
        'long_name'   => 'Adversarial proceeding before the competent body',
        'short_name'  => 'Adversarial proceeding before the competent body',
      ),
      array(
        'cat_id'     => 30,
        'lang'        => 'en',
        'long_name'   => 'Necessary possibility to discuss the elements of the case file (access to case file, examination of witnesses, possibility to discuss the other party’s allegations)',
        'short_name'  => 'Necessary possibility to discuss the elements of the case file',
      ),
      array(
        'cat_id'     => 31,
        'lang'        => 'en',
        'long_name'   => 'Participation in the hearing (personal attendance)',
        'short_name'  => 'Participation in the hearing (personal attendance)',
      ),
      array(
        'cat_id'     => 32,
        'lang'        => 'en',
        'long_name'   => 'Required reasoning of decisions',
        'short_name'  => 'Required reasoning of decisions',
      ),
      array(
        'cat_id'     => 33,
        'lang'        => 'en',
        'long_name'   => 'Public scrutiny',
        'short_name'  => 'Public scrutiny',
      ),
      array(
        'cat_id'     => 34,
        'lang'        => 'en',
        'long_name'   => 'Public hearing',
        'short_name'  => 'Public hearing',
      ),
      array(
        'cat_id'     => 35,
        'lang'        => 'en',
        'long_name'   => 'Forms of public scrutiny of the investigation',
        'short_name'  => 'Forms of public scrutiny of the investigation',
      ),
      array(
        'cat_id'     => 36,
        'lang'        => 'en',
        'long_name'   => 'Protection against retaliation',
        'short_name'  => 'Protection against retaliation',
      ),
      array(
        'cat_id'     => 37,
        'lang'        => 'en',
        'long_name'   => 'specific regime of conventional protection',
        'short_name'  => 'specific regime of conventional protection',
      ),
      array(
        'cat_id'     => 38,
        'lang'        => 'en',
        'long_name'   => 'applicability of article 5 of the ECHR',
        'short_name'  => 'applicability of article 5 of the ECHR',
      ),
      array(
        'cat_id'     => 39,
        'lang'        => 'en',
        'long_name'   => 'applicability of article 6 of the ECHR',
        'short_name'  => 'applicability of article 6 of the ECHR',
      ),
      array(
        'cat_id'     => 40,
        'lang'        => 'en',
        'long_name'   => 'applicable criminal limb',
        'short_name'  => 'applicable criminal limb',
      ),
      array(
        'cat_id'     => 41,
        'lang'        => 'en',
        'long_name'   => 'applicable civil limb',
        'short_name'  => 'applicable civil limb',
      ),
      array(
        'cat_id'     => 42,
        'lang'        => 'en',
        'long_name'   => 'article 6 declared inapplicable',
        'short_name'  => 'article 6 declared inapplicable',
      ),
      array(
        'cat_id'     => 43,
        'lang'        => 'en',
        'long_name'   => 'stage of hearing by the ECHR',
        'short_name'  => 'stage of hearing by the ECHR',
      ),
      array(
        'cat_id'     => 44,
        'lang'        => 'en',
        'long_name'   => 'burden of proving the effectiveness of the remedy',
        'short_name'  => 'burden of proving the effectiveness of the remedy',
      ),
      array(
        'cat_id'     => 45,
        'lang'        => 'en',
        'long_name'   => 'effective remedies',
        'short_name'  => 'effective remedies',
      ),
      array(
        'cat_id'     => 46,
        'lang'        => 'en',
        'long_name'   => 'unavailable remedies',
        'short_name'  => 'unavailable remedies',
      ),
      array(
        'cat_id'     => 47,
        'lang'        => 'en',
        'long_name'   => 'remedies ineffective in practice',
        'short_name'  => 'remedies ineffective in practice',
      ),
      array(
        'cat_id'     => 48,
        'lang'        => 'en',
        'long_name'   => 'newly introduced remedies',
        'short_name'  => 'newly introduced remedies',
      ),
      array(
        'cat_id'     => 49,
        'lang'        => 'en',
        'long_name'   => 'structural problem',
        'short_name'  => 'structural problem',
      ),
      array(
        'cat_id'     => 50,
        'lang'        => 'en',
        'long_name'   => 'plurality of remedies',
        'short_name'  => 'plurality of remedies',
      ),
    ));
  }
}
