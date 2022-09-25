<?php 

namespace App\Security;

use App\Entity\User as AppUser;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserChecker implements UserCheckerInterface{

public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if ($user->isIsActive() === false ) {
            // the message passed to this exception is meant to be displayed to the user
            throw new CustomUserMessageAccountStatusException("Vous n'êtes pas autorisé à vous connecter.");
        }
    }

public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if ($user->isIsActive() === false) {
            throw new CustomUserMessageAccountStatusException('Votre connexion n\'est pas autorisée.');
        }
    }

}