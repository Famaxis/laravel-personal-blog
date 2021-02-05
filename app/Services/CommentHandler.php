<?php


namespace App\Services;


class CommentHandler
{
    public function setDefaultNickname($name) {
        if ($name) {
            return $name;
        } else {
            return 'Anonymous';
        }
    }
}