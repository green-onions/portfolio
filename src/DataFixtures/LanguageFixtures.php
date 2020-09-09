<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture implements DependentFixtureInterface
{
    const LANGUAGES = [
        'PHP'        => 'php-5f2834ba6fa23989436404.png',
        'JavaScript' => 'js-5f28351d207ae572967224.png',
    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::LANGUAGES as $name => $image) {
            $language = new Language();
            $language->setName($name);
            $language->setImage($image);
            $language->setRandNum(rand(0, 999));
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
