<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Company;
use App\Entity\Sales;
;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $company1 = new Company();
        $company1->setCompanyName('Company 1');
        $manager->persist($company1);

        $sales1 = new Sales();
        $sales1->setCompanyId($company1->getId());
        $sales1->setAmount(5000.00);

        $manager->flush();
    }
}
