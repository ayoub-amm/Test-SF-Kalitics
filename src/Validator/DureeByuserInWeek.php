<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class DureeByuserInWeek extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La somme des durées des pointages d’un utilisateur pour une semaine ne pourra pas dépasser 35
    heures.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
