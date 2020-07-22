<?php

namespace App\DataFixtures;

use App\Entity\SocialNetwork;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SocialNetworkFixtures extends Fixture implements DependentFixtureInterface
{
    const SOCIAL_NETWORKS = [
        'LinkedIn' => [
            'https://image.flaticon.com/icons/svg/174/174857.svg',
            'https://www.linkedin.com/in/marienregnault/',
            ],
        'GitHub'   => [
            'https://image.flaticon.com/icons/svg/2111/2111432.svg',
            'https://github.com/green-onions',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::SOCIAL_NETWORKS as $name => $data) {
            $socialNetwork = new SocialNetwork();
            $socialNetwork->setName($name);
            $socialNetwork->setImage($data[0]);
            $socialNetwork->setLink($data[1]);
            $socialNetwork->setUser($this->getReference('user'));
            $manager->persist($socialNetwork);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
