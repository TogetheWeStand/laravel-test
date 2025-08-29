<?php

namespace App\Interfaces;

interface IBearerAuthenticableModel
{
    public function getBearerTokenFieldName(): string;
}
