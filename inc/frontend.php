<?php

/**
 * @author Hoarau Nicolas
 * @brief Show anime data for user not logged
 *
 * @param array $data
 * 
 * @version 1.0
 */
function ShowAnimeNotLogged(array $data)
{
  $cover = $data['cover'];
  $description = $data['description'];
  $avgNote = $data['avgNote'] != null ? $data['avgNote'] : 'No score given';

  echo '<div class="container">';
  echo '<div class="row">';
  echo '<div class="col col-sm-auto"><img src="data:image/jpeg;base64,' . $cover . '" alt="anime cover" height="200" width="150">';
  echo '</div><div class="col col-lg-10"><br>' . $description . '</div></div><br>';
  echo '<table><tr><th>Average Score</th></tr><tr><td>' . $avgNote . '</td></tr></table></div>';
}

/**
 * @author Hoarau Nicolas
 * @brief Show anime data for user logged
 *
 * @param array $data
 * 
 * @version 1.0
 */
function ShowAnimeLogged(array $data)
{
  $cover = $data['cover'];
  $description = $data['description'];
  $userScore = $data['userScore'] != null ? $data['userScore'] : 'No score given';
  $avgNote = $data['avgNote'] != null ? $data['avgNote'] : 'No score given';

  echo '<div class="container"><div class="row">';
  echo '<div class="col col-sm-auto"><img src="data:image/jpeg;base64,' . $cover . '" alt="anime cover" height="200" width="150"></div>';
  echo '<div class="col col-lg-8"><br>' . $description . '</div>';
  echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Completed</button>';
  echo '<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">';
  echo '<div class="modal-dialog modal-lg"><div class="modal-content"><form>';
  echo '<div class="form-group">';
  echo '<label class="col-form-label" for="score">Your score:</label>';
  echo '<select id="score" class="form-control">';
  echo '<option value="1">1</option>';
  echo '<option value="2">2</option>';
  echo '<option value="3">3</option>';
  echo '<option value="4">4</option>';
  echo '<option value="5">5</option>';
  echo '<option value="6">6</option>';
  echo '<option value="7">7</option>';
  echo '<option value="8">8</option>';
  echo '<option value="9">9</option>';
  echo '<option value="10">10</option>';
  echo '</select></div>';
  echo '<input type="date" id="dateWatched">';
  echo '<div class="modal-footer">';
  echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
  echo '<button type="button" class="btn btn-primary" onclick="SendNote($(\'#score option:selected\').text())">Validate</button>';
  echo '</div></form></div></div></div></div><br>';
  echo '<table><tr>';
  echo '<th>My Score</th>';
  echo '<th>Score Average</th>';
  echo '</tr><tr>';
  echo '<td>' . $userScore . '</td>';
  echo '<td>' . $avgNote . '</td>';
  echo '</tr></table></div>';
}
