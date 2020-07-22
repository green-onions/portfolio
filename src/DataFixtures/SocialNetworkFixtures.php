<?php

namespace App\DataFixtures;

use App\Entity\SocialNetwork;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SocialNetworkFixtures extends Fixture implements DependentFixtureInterface
{
    const SOCIAL_NETWORKS = [
        'LinkedIn' => 'https://image.flaticon.com/icons/svg/174/174857.svg',
        'GitHub'   => 'https://image.flaticon.com/icons/svg/2111/2111432.svg',
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::SOCIAL_NETWORKS as $name => $image) {
            $socialNetwork = new SocialNetwork();
            $socialNetwork->setName($name);
            $socialNetwork->setImage($image);
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
