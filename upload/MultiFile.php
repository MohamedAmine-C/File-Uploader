<?php
namespace upload;

class MultiFile
{
  public $Files = array();
  public $Errors = array();

  function __construct($key)
  {
    for ($i=0; $i < count($_FILES[$key]['name']); $i++) {
      $data = array(
        'name' => $_FILES[$key]['name'][$i],
        'tmp_name' => $_FILES[$key]['tmp_name'][$i]
        );
      if ($data['name']) {
        $this->Files[] = new File($key, $data);
      }
    }
  }

  public function Upload($newPath)
  {
    if (empty($this->errors)) {
      foreach ($this->Files as $File ) {
        $returns[] = $File->Upload($newPath);
      }
      return $returns;
    } else {
      return false;
    }
  }

  public function Size($size)
  {
    foreach ($this->Files as $File ) {
      $File->Size($size);
    }
    return $this;
  }

  public function Extension($AllowedExtensions)
  {
    foreach ($this->Files as $File ) {
      $File->Extension($AllowedExtensions);
    }
    return $this;
  }

  public function Exist()
  {
	  foreach($this->Files as $File) {
		  $File->Exist();
	  }
	  return $this;
  }

  public function getErrors()
  {
    foreach ($this->Files as $File ) {
      $this->Errors = array_merge($this->Errors, $File->errors);
    }
    $this->Errors = array_unique($this->Errors);
    return $this->Errors;
  }

}
