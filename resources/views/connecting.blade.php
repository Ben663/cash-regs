 <?php
    if (DB::connection()->getPdo()) {
        echo "successfully connected to db , name is" . DB::connection()->getDatabaseName();
   }
   ?>