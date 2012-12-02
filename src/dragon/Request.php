<?php

namespace Dragon;

interface Request {
    function path();

    function method();
}