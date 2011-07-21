<?php
function startsWith($haystack, $needle, $case=true) {
  if ($case)
    return strncmp($haystack, $needle, strlen($needle)) == 0;
  else
    return strncasecmp($haystack, $needle, strlen($needle)) == 0;
}

function endsWith($haystack, $needle, $case=true) {
  return startsWith(strrev($haystack),strrev($needle),$case);
}
