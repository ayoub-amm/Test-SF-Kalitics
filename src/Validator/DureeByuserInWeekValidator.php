<?php

namespace App\Validator;

use App\Services\DureeByuserInWeekService;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class DureeByuserInWeekValidator extends ConstraintValidator
{
    private $dureeByuserInWeekService;
    
    public function __construct(DureeByuserInWeekService $dureeByuserInWeekService)
    {
        $this->dureeByuserInWeekService = $dureeByuserInWeekService;
    }

    public function validate($pointages, Constraint $constraint)
    {

        if ($this->dureeByuserInWeekService->getDureeByuserInWeek($pointages) > 35) {
                $this->context->buildViolation($constraint->message)
                    ->atPath('duree')
                    ->addViolation();
        }
    }

}
