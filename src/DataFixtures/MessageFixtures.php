<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    const MESSAGES = [
        'toto@net.fr' => 'Je trouve votre site super, serait-il possible de se rencontrer 
        mardi pour discuter d\'un éventuel stage dans mon entreprise ?',
        'perceval@gmail.com' => 'C\'est pas faux',
        'angledroit@gmail.com' => 'Quand tu regardes le plafond qu\'est-ce que tu finis par voir ?
        Un angle droit.'
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::MESSAGES as $mail => $text) {
            $message = new Message();
            $message->setMail($mail);
            $message->setMessage($text);
            $manager->persist($message);
        }

        $manager->flush();
    }
}
