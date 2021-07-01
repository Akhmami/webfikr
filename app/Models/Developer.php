<?php

namespace App\Models;

use Parental\HasParent;

// The "child"
class Developer extends User
{
    use HasParent;
}
