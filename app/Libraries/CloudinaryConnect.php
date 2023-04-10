<?php

namespace App\Libraries;

use Cloudinary\Cloudinary;


class CloudinaryConnect
{

  protected $cloudinary;

  public function __construct()
  {
    $this->cloudinary = new Cloudinary([
      'cloud' => [
        'cloud_name' => 'dp0ann1ok',
        'api_key'  => '213812199414156',
        'api_secret' => 'k1SpTdNaQHYDVFhDl5r7M5jdwCk',
        'url' => [
          'secure' => true
        ]
      ]
    ]);
  }

  public function Upload(string $file, $option = array())
  {
    return $this->cloudinary->uploadApi()->upload($file, $option);
  }

  public function getFolderRoot()
  {
    return $this->cloudinary->adminApi()->rootFolders();
  }

  public function getResource()
  {
    $options = [
      "direction" => 1
    ];
    $dataResource = $this->cloudinary->adminApi()->assets($options);

    return json_encode($dataResource);
  }

  public function getResourceVideo()
  {
    $options = [
      "direction" => 1,
      "resource_type" => "video"
    ];

    $dataResourceVideo = $this->cloudinary->adminApi()->assets($options);

    return json_encode($dataResourceVideo);
  }

  public function deleteAssetsSingleImage($id)
  {
    $messageRes = $this->cloudinary->uploadApi()->destroy($id);

    return json_encode($messageRes);
  }

  public function deleteAssetsSingleVideo($id)
  {
    $options = [
      "resource_type" => "video"
    ];
    $messageRes = $this->cloudinary->uploadApi()->destroy($id, $options);

    return json_encode($messageRes);
  }
}
