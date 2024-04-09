<?php

namespace DiviTorque;

use DiviTorque\DB\Forms;

class Database
{
    public static function migrate()
    {
        Forms::migrate();
    }
}
