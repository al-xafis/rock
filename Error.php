<?php

class MyError {

  protected function __construct(private string $message) {

    $this->message = $message;
    echo $this->message;
  }

  public function __toString()
    {
        return implode("\n", [
            "Argument error.",
            $this->message,
            "Example: Rock Paper Scissors."
        ]);
    }

}

class InvalidLength extends MyError {

  public function __construct(private string $message) {
    parent::__construct($message);

  }

}

class InvalidArguments extends MyError {
  public function __construct(private string $message) {
    parent::__construct($message);

  }

}

class InvalidArgumentsNumber extends MyError {
  public function __construct(private string $message) {
    parent::__construct($message);
  }

}
