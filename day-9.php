<?php
$players = 468;
$marbles = 71010;

function play($players, $marbles) {
  $circle = [];
  $player = 0;
  $scores = [];
  $currentMarble = 0;

  for ($marble=0; $marble <= $marbles; $marble++) {
    if (!$marble) {
      $circle[0]['prev'] = 0;
      $circle[0]['next'] = 0;
    } else if ($marble % 23) {
      $newPrev = $circle[$currentMarble]['next'];
      $newNext = $circle[$newPrev]['next'];
      $circle[$newPrev]['next'] = $marble;
      $circle[$newNext]['prev'] = $marble;
      $circle[$marble] = ['prev' => $newPrev, 'next' => $newNext];

      $currentMarble = $marble;
    } else {
      $currScore = !empty($scores[$player]) ? $scores[$player] : 0;

      $taken = $currentMarble;
      for ($i=0; $i < 7; $i++) {
        $taken = $circle[$taken]['prev'];
      }

      $currentMarble = $circle[$taken]['next'];
      $leftMarble = $circle[$taken]['prev'];
      $circle[$currentMarble]['prev'] = $leftMarble;
      $circle[$leftMarble]['next'] = $currentMarble;

      $scores[$player] = $currScore + $marble + $taken;
      $i++;
    }
    $player = ++$player % $players;
  }

  return max($scores);
}


echo "Answer to Part 1: " . play($players, $marbles) . "\n";
echo "Answer to Part 2: " . play($players, $marbles * 100) . "\n";
?>
