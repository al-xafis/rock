<?php

class Crypto {
  private $secretKey;
  private $hmac;

  public function generateKey() {
    $key = bin2hex(random_bytes(32));
    $this->setSecretKey($key);
    return $key;
  }

  function generateHmac($computerMoveName) {

    $hmac = hash_hmac('sha3-256', $computerMoveName, $this->secretKey);
    $this->setHmac($hmac);
    return $hmac;
  }

  function getSecretKey() {
    return $this->secretKey;
  }

  function getHmac(){
    return $this->hmac;
  }

  private function setSecretKey($secretKey) {
    $this->secretKey = $secretKey;
  }

  private function setHmac($hmac) {
    $this->hmac = $hmac;
  }


}
