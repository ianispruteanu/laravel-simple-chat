<?php

return [

    /*
     * Defines if project uses uuid
     */
    'use_uuid' => false,
    
    /*
     * Define user foreign key column.
     * If you set use_uuid to "true" - change this to column's name
     * that stores the user's uuid
     */
    'user_table_identified' => 'id'
];
