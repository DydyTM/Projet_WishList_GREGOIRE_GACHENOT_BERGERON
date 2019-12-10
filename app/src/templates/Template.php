<?php

namespace wishlist\templates;

abstract class Template {
    public static $CSS_BASE_DIR    = "/css";
    public static $JS_BASE_DIR     = "/js";
    public static $VENDOR_BASE_DIR = "/vendor";

    public abstract static function generate();
}

?>