<?php

/**
 * Created by PhpStorm.
 * User: adnan
 * Date: 4/20/17
 * Time: 12:56 PM
 */
class UploadFile extends CI_Model
{

    function upload()
    {
        $config['upload_path'] = './images/original/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|jpg|jpe';


        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('school_image', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $this->load->view('upload_success', $data);
        }
    }



    public function uploadImage($fileName){

        $time = date('Y/m/d H:i:s');
        $timestamp = strtotime($time);

        $extension = explode(".", $_FILES[$fileName]['name']);
        $count = count($extension);
        $dot_extension = $extension[$count - 1];
        $dot_extension=strtolower($dot_extension);
        $data1 = array(

            'image_path' => $fileName.'_'.$timestamp . '.' . $dot_extension,
            'thumb_path' => $fileName.'_'.$timestamp . '_' . 'thumb' . '.' . $dot_extension,
            'upload_time' => date('Y-m-d H:i:s')
        );

        $destinationOriginal='./images/original/';
        $destinationLarge='./images/large/';
        $destinationMedium='./images/medium/';
        $destinationThumbnail='./images/thumbnail/';
        $image_value=$this->uploadImagesOnDrive($data1['image_path'],$fileName,$destinationOriginal,$destinationLarge,$destinationMedium,$destinationThumbnail);

        if($image_value['result']){
            $data['result']=true;
            $data['image_path']=$data1['image_path'];
            $data['thumb_path']=$data1['thumb_path'];
        }else{
            $data['result']=false;
            $data['message']=$image_value['message'];
        }

        return $data;
    }


    public function uploadImagesOnDrive($fileName,$file,$destinationOriginal,$destinationLarge,$destinationMedium,$destinationThumbnail){

        $config['upload_path'] = $destinationOriginal;
//        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|jpg|jpe';
        $config['max_size'] = 5*1024*1024;
        $config['max_width'] = '';
        $config['max_height'] = '';
        $config['file_name'] = $fileName;
        $thumb_img = $config['file_name'];
        $config['overwrite'] = false;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($file)) {
            $resultData['result']=false;
            $resultData['message']=$this->upload->display_errors();
        } else {
            $data = array('upload_data' => $this->upload->data());
            $data['img'] = base_url() . $destinationOriginal . $data['upload_data']['file_name'];
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $destinationOriginal . $thumb_img;
            $config['create_thumb'] = TRUE;
            $config['new_image'] = $destinationThumbnail;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 150;
            $config['height'] =150;
            $this->load->library('image_lib', $config);
            $this->image_lib->initialize($config);
            if (!$this->image_lib->resize()) {
                $resultData['result']=false;
                $resultData['message']=$this->upload->display_errors();
            }else {
                $this->load->library('image_lib');
                $source= $destinationOriginal.$thumb_img;
                $size= getimagesize(($source));
                $width_large=680;
                $width=400;
                if($size[0] > $width_large){
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destinationOriginal . $thumb_img;
                    $config['create_thumb'] = TRUE;
                    $config['new_image'] = $destinationLarge;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 600;
                    $config['height'] =400;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->resize()){
                        $resultData['result']=false;
                        $resultData['message']=$this->upload->display_errors();
                    }
                    else{
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $destinationOriginal . $thumb_img;
                        $config['create_thumb'] = TRUE;
                        $config['new_image'] = $destinationMedium;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = 300;
                        $config['height'] =300;
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        if (!$this->image_lib->resize()){
                            $resultData['result']=false;
                            $resultData['message']=$this->upload->display_errors();
                        }
                        else{
                            $resultData['result']=true;
                        }
                    }

                }
                elseif ($size[0] < $width_large && $size[0] > $width){
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destinationOriginal . $thumb_img;
                    $config['create_thumb'] = TRUE;
                    $config['new_image'] = $destinationMedium;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 300;
                    $config['height'] =300;
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->resize()){
                        $resultData['result']=false;
                        $resultData['message']=$this->upload->display_errors();
                    }
                    else{
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $destinationOriginal . $thumb_img;
                        $config['create_thumb'] = TRUE;
                        $config['new_image'] = $destinationLarge;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $size[0];
                        $config['height'] =$size[1];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        if (!$this->image_lib->resize()){
                            $resultData['result']=false;
                            $resultData['message']=$this->upload->display_errors();
                        }
                        else{
                            $resultData['result']=true;
                        }
                    }

                }else{
                    $this->load->library('image_lib');
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = $destinationOriginal . $thumb_img;
                    $config['create_thumb'] = TRUE;
                    $config['new_image'] = $destinationMedium;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = $size[0];
                    $config['height'] =$size[1];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    if (!$this->image_lib->resize()){
                        $resultData['result']=false;
                        $resultData['message']=$this->upload->display_errors();
                    }
                    else{
                        $this->load->library('image_lib');
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = $destinationOriginal . $thumb_img;
                        $config['create_thumb'] = TRUE;
                        $config['new_image'] = $destinationLarge;
                        $config['maintain_ratio'] = TRUE;
                        $config['width'] = $size[0];
                        $config['height'] =$size[1];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->initialize($config);
                        if (!$this->image_lib->resize()){
                            $resultData['result']=false;
                            $resultData['message']=$this->upload->display_errors();
                        }
                        else{
                            $resultData['result']=true;
                        }
                    }
                }
            }
        }
        return $resultData;
    }

}