<?php

namespace App\Patterns;

class SocialUrlParser
{
    public function getType(string $url): string
    {
        if (preg_match('/(?:(?:http|https):\/\/)?(?:www.)?facebook.com/', $url)) {
            $type = 'facebook';
        } elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www.)?linkedin.com/', $url)) {
            $type = 'linkedin';
        } elseif (preg_match('/(?:(?:http|https):\/\/)?(?:www.)?twitter.com/', $url)) {
            $type = 'twitter';
        } else {
            throw new \RuntimeException('invalid_social_network_url');
        }

        return $type;
    }
}