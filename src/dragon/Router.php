<?php

namespace Dragon;

interface Router {
    function parent();

    function length();

    function parameters();

    function route(Request $request, $path);
}
