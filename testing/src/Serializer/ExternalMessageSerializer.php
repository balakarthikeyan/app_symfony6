<?php

namespace App\Serializer;
 
use App\Message\MyMessageNotification;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\MessageDecodingFailedException;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface as MessageSerializerInterface;
use Symfony\Component\Serializer\SerializerInterface;
 
class ExternalMessageSerializer implements MessageSerializerInterface
{
    
    public function __construct(private SerializerInterface $serializer)
    {}
     
    public function decode(array $encodedEnvelope): Envelope
    {
        $body    = $encodedEnvelope['body'];
        $headers = $encodedEnvelope['headers'];
         
        try {
            $message = $this->serializer->deserialize($body, MyMessageNotification::class, 'json');
        } catch (\Throwable $throwable) {
            throw new MessageDecodingFailedException($throwable->getMessage());
        }
         
        $stamps = [];
        if (!empty($headers['stamps'])) {
            $stamps = unserialize($headers['stamps']);
        }
         
        return new Envelope($message, $stamps);
    }
 
 
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $stamps  = $envelope->all();
         
        if ($message instanceof MyMessageNotification) {
            $data = [
                'content' => $message->getContent()
            ];
        } else {
            throw new \Exception(sprintf('Serializer does not support message of type %d.', $message::class));
        }

        return [
            'body' => json_encode($data),
            'headers' => [
                'stamps' => serialize($stamps)
            ]
        ];
    }
}