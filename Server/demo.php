<?php

include_once "wxBizDataCrypt.php";

ini_set("display_errors","On");
error_reporting(E_ALL);

$appid = 'wxb8dbf6bbd4047e36';
$sessionKey = 'MA9l5yjzXhZq3sLweb2RVg==';

$encryptedData="OeVwRlgOS1TPBBknOB+fNhLGq+wjNzs1rb9N/GlpBhHi0nCh+nU6+jFiXIsie4ZjIwua3723vFEFWN2JMrMW7OfpX7CkL1EWEuHAxSJhy/MTBDwlxrFGAz9xNTW4Lui5t513slkdEx8S+33rbnSlHxb71xLVL7GtbAiiCuLJKdgmQiT7PBT7wCWNZHIHPPR9NGZkj4WupZp4cMwUN0Q31NhoMEaFZAYqQAqmyUgItEt8XniAy2Aj+5qHXDaVnebOfSNid2LfzAbYXI5FS7pKkxxz0TM614fEpCtANbBVmo5gUA1meK4VN4O/O5U+4iacnYULkSb3iImqnb+cUkOKI0yPF/YbV89AC6R6Hqsdx6+kI8szZLUhnJimxeI5v+XC16Bid7vWVnrd0FJGAHzTOP8QISZ4djBrePQUeBCzhNhb2kShWv47nY6hHDqHpaPDhOdizO6xuNarE4qokqOOmutCRg26i2tuqjQn6q+nrZ8qVQpIu9MLk3ERjgAU3OAluZtgGDFo2SNqKL4gGil6T5GsG9cXYuUM7COioAhpCxE7pMX//jqwfwCNSw2EPb8tmoCKxK6cO+fFnrrVwC+gD9VxgZagUFqrVKfAHL1/MZxJqe+pg1KGJfr1tcaNR3hRNc5sucOgPN2VFBVUVZ1ZfMExPb/NnzjbPy/X4po05SVX4PgW5Q4RLVyclZXtsllRwrVpHIgn+aWa6pGE5M9kLCH7dnZ0dkvQ+i0lirBKiZjS6o53rII96EZeVCmxDN3loRX+2w2+8H0HxYgmIwHErKhTemjOBa0YCaMPNX/dmgHFg8tl7m2rvA/SeaXJOdNcHypWoQ8fj7BWCOxGFCtAJNJNe2klFN4PypVCqw+ifSlMlS/O5Q+UFtXEI4o6/BfHyAGudpXqx9rRWomvR9vlSkv38J6Hg5r3HE3Sw+Zk0gpzEatkrRiA266GfPy6vnz4G6cxp4x1yRIT49tRb3vXYPQjeKtscknvG3BCOJ3Ci5AwBPYgePzoRFGKBoTWpL3JoC/ismYRgiUMb8keUlMX9T232KkipQITtPI0EJpdsg/amcB/zpesYoSLze1jSI/CEszbhc7M/7lkRRa8z6v74aQ5UKvte9hXNDAHcI9eTiMh8opK7l6DIsz751qGZSz6/BYXo+A151sdto8N3yOm8QuFKNjfOuNeMfKAmTSAqI5XxS2hOEq9kSC26JpMDAoORdqz0sGs97RMOyfVFObL8wQD5GFYR7aMyBnsXou5rAzfZtk1ThvYo5Rdg4IwjP9mB1jVDx6bddPnaPx7862x7nRQ9k8lhuhyKK3RzevNM0w2nTKLUCcou6wNWcQvcModdbUyYb7lN161YUyk5O6zqOHxFoJhGnbe5VwxvIBO/zkvRxhGihBewEVKwwfS+vD5+cq5zqJzioErmNO0OZmKkYZOnrqYJ1DynawhiKbN+str+xElAdFNROS0Ct2pN2Iil9SICeuBSoReD0zH0fJO7T3sYSJRpaa1HxBVSKKzMzpWQpyGYlsS0q1nHL8LT3KB4guH9tOks0a9qZKOTi1MRUfQ/QvL8yDethP7KEwnKUqyRw3WopsHd4lY9YVBRXc9Yi8dR2uvZnWuMkaT1YStfoAGkwhB/f6pla4AmXPoRt4fp3KblRj7DwNJggoEVnHP";

$iv = 'd/hAtezdpYUFXpwJfTZWWw==';

$pc = new WXBizDataCrypt($appid, $sessionKey);
$errCode = $pc->decryptData($encryptedData, $iv, $data );

if ($errCode == 0) {
    print($data . "\n");
} else {
    print($errCode . "\n");
}

$obj = json_decode($data);
var_dump($obj);
echo"\n";
$i = count($obj->stepInfoList);
echo $obj->stepInfoList[$i-1]->step;