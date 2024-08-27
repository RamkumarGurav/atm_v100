<?php
use Aws\Rekognition\RekognitionClient;

class Aws_rekognition
{

  protected $ci;
  protected $rekognition;

  public function __construct()
  {
    $this->ci =& get_instance();
    $this->ci->load->config('aws_sdk');

    $this->rekognition = new RekognitionClient([
      'region' => $this->ci->config->item('aws_region'),
      'version' => 'latest',
      'credentials' => [
        'key' => $this->ci->config->item('aws_access_key'),
        'secret' => $this->ci->config->item('aws_secret_key'),
      ]
    ]);
  }

  public function detect_faces($imageContent)
  {
    $result = $this->rekognition->detectFaces([
      'Image' => [
        'Bytes' => $imageContent,
      ],
      'Attributes' => ['ALL'],
    ]);

    return $result['FaceDetails'];
  }

  // Additional methods for face comparison, indexing, etc., can be added here.
}
