<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateUserCommand;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class UserController extends AbstractController
{

    public function __construct(private MessageBusInterface $bus){}

    public function createUser(Request $request):JsonResponse
    {

        try{
            $data = json_decode($request->getContent(),true);

            $userCommand = new CreateUserCommand(
                $data['email'],
                $data['name'],
                $data['surname'],
                $data['password']
            );

            $this->bus->dispatch($userCommand);
        }catch(Exception $e){

            $respondeData = json_encode([
                'status' => 'failed',
                'message' => $e->getMessage()
            ]);
            return new JsonResponse($respondeData,JsonResponse::HTTP_BAD_REQUEST,[],JSON_UNESCAPED_UNICODE);
        }

        $respondeData = json_encode([
            'status' => 'ok',
            'message' => 'User created'
        ]);
        
        
        return new JsonResponse($respondeData, JsonResponse::HTTP_CREATED,[],JSON_UNESCAPED_UNICODE);
    }
}