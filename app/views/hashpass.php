<?php
DB::table('utilisateur')
            ->where('util_id', 1)
            ->update(array('util_password' => Hash::make('1234')));
DB::table('utilisateur')
            ->where('util_id', 2)
            ->update(array('util_password' => Hash::make('1234')));
DB::table('utilisateur')
            ->where('util_id', 3)
            ->update(array('util_password' => Hash::make('1234')));
DB::table('utilisateur')
            ->where('util_id', 4)
            ->update(array('util_password' => Hash::make('1234')));
DB::table('utilisateur')
            ->where('util_id', 5)
            ->update(array('util_password' => Hash::make('1234')));