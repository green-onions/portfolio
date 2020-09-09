<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $project = new Project();
        $project->setTitle('Joshua');
        $project->setDescription('Développement de Joshua, plateforme de concours 
        de type \'capture the flag\' pour les besoins de la Wild Code School. J\' ai participé à 
        son développement avec trois autres développeurs à l\'époque en en formation à l\'antenne 
        de Bordeaux. Joshua est depuis utilisé par l\'organisme de formation pour organiser 
        des concours à l\'échelle européenne, avec plus d\'une centaine de joueurs en simultané.');
        $project->setImage('https://zupimages.net/up/20/30/putq.png');
        $project->setClient('Wild Code School');
        $project->setLink('https://joshua-wcs.herokuapp.com/');
        for ($i = 0; $i < 2; $i++) {
            $project->addLanguage($this->getReference('language_' . $i));
        }
        $manager->persist($project);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LanguageFixtures::class];
    }
}

