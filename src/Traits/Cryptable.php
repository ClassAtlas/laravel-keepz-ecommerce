<?php

namespace ClassAtlas\KeepzEcommerce\Traits;

use function base64_decode;
use function base64_encode;
use function config;
use function json_decode;
use function json_encode;
use function openssl_private_decrypt;
use function openssl_public_encrypt;

trait Cryptable
{
    /**
     * @return array<string, int|string>
     */
    public function decryptData(string $data): array
    {
        $encryptedData = base64_decode($data);

        if (openssl_private_decrypt(
            $encryptedData,
            $decryptedData,
            (string) file_get_contents(config('keepz-ecommerce.private_key')))
        ) {
            return json_decode($decryptedData, true);
        }

        return [];
    }

    /**
     * @param  array<string, int|string>  $data
     */
    public function encryptData(array $data): ?string
    {
        $jsonData = json_encode($data);

        if (openssl_public_encrypt(
            (string) $jsonData,
            $encrypted,
            (string) file_get_contents(config('keepz-ecommerce.public_key')))
        ) {
            return base64_encode($encrypted);
        }

        return null;
    }
}
