<?php
/*
 * This just some long running job consuming lots of memory
 */
set_time_limit(10);
ini_set('memory_limit', '2G');

$job = isset($argv[1]) ? $argv[1] : 0;

$limit = 7000000 * $job^3;

$ar = [];

for ($i=1; $i<=$limit; ++$i) {
  $ar[] = $i*$i;
}

echo "DONE $job!";
exit((int)$job);
