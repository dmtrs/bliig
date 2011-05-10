#!/bin/bash
cp -v ./protected/data/_blog.db ./protected/data/blog.db
cp -v ./protected/config/_main.php ./protected/config/main.php
cp -v ./protected/config/_params.php ./protected/config/params.php
cp -v ./_index.php ./index.php
cp -v ./_index-test.php ./index-test.php
chmod -R 777 ./protected/data/
