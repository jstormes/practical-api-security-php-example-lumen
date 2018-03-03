<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Jose\Component\Core\AlgorithmManager;
use Jose\Component\Core\Converter\StandardConverter;
use Jose\Component\Encryption\Algorithm\ContentEncryption\A256CBCHS512;
use Jose\Component\Encryption\Algorithm\KeyEncryption\A256KW;
use Jose\Component\Encryption\Compression\CompressionMethodManager;
use Jose\Component\Encryption\Compression\Deflate;
use Jose\Component\Encryption\JWEBuilder;

class JWEBuilderServiceProvider extends ServiceProvider
{
    public function register() {
        $this->app->singleton(JWEBuilder::class, function ($app) {
            return new JWEBuilder(
                new StandardConverter(),
                AlgorithmManager::create([new A256KW()]),
                AlgorithmManager::create([new A256CBCHS512()]),
                CompressionMethodManager::create([new Deflate()])
            );
        });
    }
}