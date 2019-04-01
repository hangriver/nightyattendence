<?php
$response['status'] = 666;
echo json_encode($response)."<br />";

$data = json_decode('{
    "stepInfoList": [
      {
        "timestamp": 1445866601,
        "step": 100
      },
      {
        "timestamp": 1445876601,
        "step": 120
      }
    ]
  }');

  var_dump($data);
  echo "<br />";
  var_dump($data->stepInfoList[0]->step);