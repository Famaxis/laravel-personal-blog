<?php


namespace App\Services;


class CommentHandler
{
    public function setDefaultNickname($name) {
        if ($name) {
            return strip_tags($name);
        } else {
            return 'Anonymous';
        }
    }
}