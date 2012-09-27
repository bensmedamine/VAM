<?php

function parseHTML($HTML, $expression) {
  $result = array();
  preg_match_all('/' . $expression . '/im', $HTML, $result);
  return $result;
}

function parseHTML_si($HTML, $expression) {
  $result = array();
  preg_match_all('/' . $expression . '/si', $HTML, $result);
  return $result;
}