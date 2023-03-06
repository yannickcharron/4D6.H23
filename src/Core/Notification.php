<?php
namespace App\Core;

class Notification {

    private $tag;
    private $content;
    private $color;

    public function __construct($tag, $content, $color = NotificationColor::PRIMARY)
    {
        $this->tag = $tag;
        $this->content = $content;
        $this->color = $color;
    }

    public function getTag() 
    {
        return $this->tag;
    }

    public function getContent() 
    {
        return $this->content;
    }

    public function getColor() 
    {
        return $this->color;
    }

}

abstract class NotificationColor {
    public const PRIMARY = "alert-primary";
    public const SECONDARY = "alert-secondary";
    public const SUCCESS = "alert-success";
    public const DANGER = "alert-danger";
    public const WARNING = "alert-warning";
    public const INFO = "alert-info";
    public const LIGHT = "alert-light";
    public const DARK = "alert-dark"; 
}