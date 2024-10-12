<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateUserCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class UserController extends AbstractController
{

    public function __construct(private MessageBusInterface $bus){}

    public function createUser(Request $request):JsonResponse
    {

        $data = json_decode($request->getContent(),true);
        $userCommand = new CreateUserCommand(
            Uuid::uuid4()->toString(),
            $data['email'],
            $data['name'],
            $data['surname'],
            $data['password']
        );
        
        $this->bus->dispatch($userCommand);
        
        return new JsonResponse($data);
    }
}