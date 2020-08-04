<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class TaskRemoveVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    protected function supports($attribute, $subject)
    {
        return $attribute === 'REMOVE'
            && $subject instanceof \App\Entity\Task;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface) {
            return false;
        }
        // To restrict tasks removal to only their creator
        if ($user === $subject->getUser()) {
            return true;
        }
        // To allow admins to remove anonymous tasks
        if (null === $subject->getUser() && $this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return false;
    }
}
