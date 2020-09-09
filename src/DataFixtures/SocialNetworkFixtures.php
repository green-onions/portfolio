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
            'linkedin-5f283a88bbbf8589116049.png',
            'https://www.linkedin.com/in/marienregnault/',
            ],
        'GitHub'   => [
            'github-5f283a95e19fd927226038.png',
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
            $socialNetwork->setRandNum(rand(0, 999));
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
