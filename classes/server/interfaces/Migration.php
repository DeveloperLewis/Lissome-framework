<?php

namespace classes\server\interfaces;

interface Migration
{
    public function runMigrations(): void;
}