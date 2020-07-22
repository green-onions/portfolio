<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('green-onions');
        $user->setFirstname('Marien');
        $user->setLastname('Regnault');
        $user->setJobTitle('Développeur web full-stack');
        $user->setDescription('Après plusieurs années à travailler comme journaliste, 
        je me suis reconverti dans le développement web. Curieux et rigoureux, passionné du numérique, 
        j\'ai suivi une formation en PHP - Symfony et suis à la recherche d\'opportunités pour mettre 
        à l\'épreuve cette nouvelle qualification. Vous retrouverez sur ce site toutes les réalisations 
        auxquelles j\'ai participé.');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'coucou'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $this->addReference('user', $user);
        $manager->flush();
    }
}
