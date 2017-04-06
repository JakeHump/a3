<?php

class removeVowels {
    public function __construct($array) {
      echo "The result is " .$this->consume($array) .".";

    }

    private function consume($array) {
      $vowels =
      [
          'a' => 0, 'b' => 1, 'c' => 1, 'd' => 1,
          'e' => 0, 'f' => 1, 'g' => 1, 'h' => 1,
          'i' => 0, 'j' => 1, 'k' => 1, 'l' => 1,
          'm' => 1, 'n' => 1, 'o' => 0, 'p' => 1,
          'q' => 1, 'r' => 1, 's' => 1, 't' => 1,
          'u' => 0, 'v' => 1, 'w' => 1, 'x' => 1,
          'y' => 1, 'z' => 1,
      ];


      foreach(str_split($array) as $character) {
          if  ($vowels[$character] == 1)
          {
            $results = $results .$character ","
          }
      }

}
?>
