<?php
require('../myb4g-connect.php');
class Compute{
  public $connection;
  public $week_id;
  public $begin;
  public $previous;
  public $current;

  public function __construct($connection){
    $this->connection = $connection;
  }

  public function get_week_ending($week_id){
    $this->week_id  = $week_id;

  }

  public function weekly_weight_loss_competition($week_id){
    $this->week_id  = $week_id;
    $this->get_weight_in_data_competition($this->week_id);
    return $this->previous - $this->current;
  }

  public function overall_weight_loss_competition($week_id){
    $this->week_id  = $week_id;
    $this->get_weight_in_data_competition($this->week_id);
    return $this->begin - $this->current;
  }

  public function get_teams(){}
  public function get_weekly_indiv_weight_loss($week_id){
    $this->week_id  = $week_id;
  }
  public function get_overall_indiv_weight_loss($week_id){
    $this->week_id  = $week_id;
  }
  public function get_weekly_team_weight_loss($week_id){
    $this->week_id  = $week_id;
  }
  public function get_overall_team_weight_loss($week_id){
    $this->week_id  = $week_id;
  }
  public function get_biggest_loser($week_id){
    $this->week_id  = $week_id;
  }
  public function get_most_raw_pounds($week_id){
    $this->week_id  = $week_id;
  }
  public function get_top_ten($week_id){
    $this->week_id  = $week_id;
  }

  public function get_weight_in_data_competition($week_id){
    $this->week_id = $week_id;
    $sql = "SELECT * FROM weigh_ins WHERE wi_week_id='$this->week_id';";
    $result = mysqli_query($this->connection, $sql);
    return $data = $this->get_weigh_in_results_competition($result);
  }

  public function get_weigh_in_results_competition($result){
    if($result){

      $this->begin     = 0;
      $this->previous  = 0;
      $this->current   = 0;

      while($row = mysqli_fetch_assoc($result)){

        $this->begin     += $row['wi_begin'];
        $this->previous  += $row['wi_previous'];
        $this->current   += $row['wi_current'];

      }

      $wi_results_comp = array(
        'begin'       =>    $this->begin,
        'previous'    =>    $this->previous,
        'current'     =>    $this->current
      );

      return $wi_results_comp;

    }else{echo(' ***** ERROR ***** | Retrieving Weigh_in Results');}
  }

}

$compute = new Compute($connection);
echo('<pre>');
print_r($compute);
echo('<pre>');
$week_id = 3;
$wwl_comp = $compute->weekly_weight_loss_competition($week_id);
$owl_comp = $compute->overall_weight_loss_competition($week_id);

echo('Our Total Weight Loss For Last Week Is: '.$wwl_comp.'<br>');
echo('Our Overall Total Weight Loss For The Competition Is: '.$owl_comp.'<br>');

echo('<pre>');
print_r($compute);
echo('<pre>');
 ?>
