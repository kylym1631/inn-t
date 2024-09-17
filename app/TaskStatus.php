<?php

namespace App;

enum TaskStatus: string
{
    case TODO = 'todo';
    case DOING = 'doing';
    case DONE = 'done';

    public function description(): string
    {
        return match($this) {
            self::TODO => 'Нужно сделать',
            self::DOING => 'В процессе',
            self::DONE => 'Сделано',
        };
    }
}
