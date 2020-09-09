<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture implements DependentFixtureInterface
{
    const LANGUAGES = [
        'PHP'        => 'https://image.flaticon.com/icons/svg/2306/2306154.svg',
        'JavaScript' => 'https://image.flaticon.com/icons/svg/2306/2306122.svg',
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::LANGUAGES as $name => $image) {
            $language = new Language();
            $language->setName($name);
            $language->setImage($image);
            $language->setUser($this->getReference('user'));
            $manager->persist($language);
            $this->addReference('language_' . $i, $language);
            $i++;
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}

