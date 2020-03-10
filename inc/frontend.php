<?php

/**
 * @author Hoarau Nicolas
 * @brief Show anime data
 *
 * @param array $data
 * 
 * @version 1.0
 */
function ShowAnimeNotLogged(array $data)
{
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col col-sm-auto"><img src="data:image/jpeg;base64,' . $data['cover'] . '" alt="anime cover" height="200" width="150">';
  echo '</div><div class="col col-lg-10"><br>' . $data['description'] . '</div></div><br>';
  echo '<table><tr><th>My Score</th></tr><tr><td>' . $data['avgNote'] != null ? $data['avgNote'] : 'No score given' . '</td></tr></table></div>';
}


function ShowAnimeLogged(array $data)
{
  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col col-sm-auto"><img src="data:image/jpeg;base64,' . $data['cover'] . '" alt="anime cover" height="200" width="150">';
  echo '</div><div class="col col-lg-10"><br>' . $data['description'] . '</div></div><br>';
  echo '<table><tr><th>My Score</th><th>Score Average</th></tr><tr><td>' . $data['userScore'] != null ? $data['userScore'] : 'No score given' . '</td>';
  echo '<td>' . $data['avgNote'] != null ? $data['avgNote'] : 'No score given' . '</td></tr></table></div>';
}
